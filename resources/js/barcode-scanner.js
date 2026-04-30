import {
    BrowserMultiFormatReader,
    BarcodeFormat,
    DecodeHintType
} from '@zxing/library';

function isValidCode(code) {
    return /^\d{6}$/.test(code);
}

class BarcodeScanner {
    constructor(options = {}) {
        this.videoElement = options.videoElement;
        this.onDetected = options.onDetected || (() => {});
        this.onError = options.onError || (() => {});

        const hints = new Map();
        hints.set(DecodeHintType.POSSIBLE_FORMATS, [BarcodeFormat.CODE_128]);

        this.reader = new BrowserMultiFormatReader(hints);
        this.controls = null;
        this.active = false;
        this.hasDetected = false;
    }

    async start() {
        try {
            if (!this.hasGetUserMedia()) {
                throw new Error('MEDIA_UNAVAILABLE');
            }

            const deviceId = await this.pickCamera();
            this.active = true;
            this.hasDetected = false;

            this.controls = await this.reader.decodeFromVideoDevice(
                deviceId,
                this.videoElement,
                (result, error) => {
                    if (!this.active || this.hasDetected) return;

                    if (result?.getText()) {
                        const text = result.getText().trim();

                        if (isValidCode(text)) {
                            this.hasDetected = true;
                            this.onDetected(text);
                            this.stop();
                        }
                    } else if (error && error.name !== 'NotFoundException') {
                        this.onError(this.humanizeError(error));
                    }
                }
            );

            if (this.videoElement) {
                this.videoElement.play().catch(() => {});
            }
        } catch (error) {
            this.onError(this.humanizeError(error));
        }
    }

    stop() {
        this.active = false;
        if (this.controls) {
            this.controls.stop();
            this.controls = null;
        }
        this.reader.reset();
    }

    async pickCamera() {
        const devices = await this.reader.listVideoInputDevices();
        if (!devices?.length) {
            throw new Error('NO_CAMERA');
        }
        const back = devices.find(d =>
            /back|traseira|rear|environment/i.test(d.label)
        );
        return back?.deviceId || devices[0].deviceId;
    }

    hasGetUserMedia() {
        return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
    }

    humanizeError(error) {
        const code = error?.message || error?.name || 'UNKNOWN';
        if (code === 'MEDIA_UNAVAILABLE') {
            return 'Camera not available.';
        }
        if (code === 'NO_CAMERA' || code === 'NotFoundError') {
            return 'No camera found.';
        }
        if (code === 'NotAllowedError' || code === 'PermissionDeniedError') {
            return 'Camera permission denied.';
        }
        return 'Camera error. Enter code manually.';
    }
}

function initBarcodeScannerUI() {
    const modal = document.getElementById('barcode-scanner-modal');
    if (!modal) return;

    const video = document.getElementById('barcode-video');
    const status = document.getElementById('barcode-status');
    const closeBtn = document.getElementById('barcode-close');
    const buttons = document.querySelectorAll('[data-open-scanner]');
    let currentInput = null;
    let scanner = null;

    const setStatus = (msg, kind = 'neutral') => {
        status.textContent = msg;
        status.className = 'text-sm text-slate-600';
        if (kind === 'error') status.className = 'text-sm text-red-700';
        if (kind === 'success') status.className = 'text-sm text-emerald-700';
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        scanner?.stop();
        scanner = null;
    };

    closeBtn?.addEventListener('click', closeModal);
    modal?.addEventListener('click', (e) => {
        if (e.target.id === 'barcode-scanner-modal') closeModal();
    });

    buttons.forEach((btn) => {
        btn.addEventListener('click', async () => {
            const inputId = btn.getAttribute('data-target-input');
            currentInput = inputId ? document.getElementById(inputId) : null;
            modal.classList.remove('hidden');
            setStatus('Point camera at barcode...');

            scanner = new BarcodeScanner({
                videoElement: video,
                onDetected: (value) => {
                    if (currentInput) {
                        currentInput.value = value;
                        currentInput.dispatchEvent(new Event('blur', { bubbles: true }));
                    }
                    setStatus(`Read: ${value}`, 'success');
                    setTimeout(closeModal, 1000);
                },
                onError: (msg) => setStatus(msg, 'error'),
            });

            await scanner.start();
        });
    });
}

export { BarcodeScanner, initBarcodeScannerUI, isValidCode };
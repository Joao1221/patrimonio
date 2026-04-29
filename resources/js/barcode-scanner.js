import { BrowserMultiFormatReader } from '@zxing/browser';

class BarcodeScanner {
    constructor(options = {}) {
        this.videoElement = options.videoElement;
        this.onDetected = options.onDetected || (() => {});
        this.onError = options.onError || (() => {});
        this.reader = new BrowserMultiFormatReader();
        this.controls = null;
        this.stream = null;
        this.active = false;
    }

    async start() {
        try {
            this.assertSecureContext();
            const deviceId = await this.pickBackCamera();
            this.active = true;
            this.controls = await this.reader.decodeFromVideoDevice(deviceId, this.videoElement, (result, error) => {
                if (!this.active) return;
                if (result?.getText()) {
                    this.onDetected(result.getText());
                    this.stop();
                } else if (error && error.name !== 'NotFoundException') {
                    this.onError(this.humanizeError(error));
                }
            });
            this.stream = this.videoElement?.srcObject || null;
        } catch (error) {
            this.onError(this.humanizeError(error));
        }
    }

    stop() {
        this.active = false;
        if (this.controls?.stop) {
            this.controls.stop();
        }
        if (this.stream?.getTracks) {
            this.stream.getTracks().forEach((track) => track.stop());
        }
        this.reader.reset();
        if (this.videoElement) {
            this.videoElement.srcObject = null;
        }
        this.controls = null;
        this.stream = null;
    }

    async pickBackCamera() {
        const devices = await BrowserMultiFormatReader.listVideoInputDevices();
        if (!devices?.length) {
            throw new Error('NO_CAMERA');
        }
        const back = devices.find((d) => /back|traseira|rear|environment/i.test(d.label));
        return back ? back.deviceId : devices[0].deviceId;
    }

    assertSecureContext() {
        const host = window.location.hostname;
        const isLocalhost = host === 'localhost' || host === '127.0.0.1';
        if (!(window.isSecureContext || isLocalhost)) {
            throw new Error('INSECURE_CONTEXT');
        }
        if (!navigator.mediaDevices?.getUserMedia) {
            throw new Error('MEDIA_UNAVAILABLE');
        }
    }

    humanizeError(error) {
        const code = error?.message || error?.name || 'UNKNOWN';
        if (code === 'INSECURE_CONTEXT') {
            return 'A camera so funciona em ambiente seguro. Use HTTPS ou localhost para testes.';
        }
        if (code === 'NO_CAMERA' || code === 'NotFoundError') {
            return 'Nenhuma camera foi encontrada neste dispositivo.';
        }
        if (code === 'NotAllowedError' || code === 'PermissionDeniedError') {
            return 'Permissao da camera negada. Libere o acesso nas configuracoes do navegador ou digite o codigo manualmente.';
        }
        return 'Nao foi possivel iniciar a camera. Digite o codigo manualmente ou tente novamente.';
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

    const setStatus = (message, kind = 'neutral') => {
        status.textContent = message;
        status.className = 'text-sm';
        if (kind === 'error') status.classList.add('text-red-700');
        if (kind === 'success') status.classList.add('text-emerald-700');
        if (kind === 'neutral') status.classList.add('text-slate-600');
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
            setStatus('Aponte a camera para o codigo de barras.');

            scanner = new BarcodeScanner({
                videoElement: video,
                onDetected: async (value) => {
                    if (currentInput) {
                        currentInput.value = value;
                        currentInput.dispatchEvent(new Event('blur', { bubbles: true }));
                    }
                    setStatus(`Codigo lido: ${value}`, 'success');
                    setTimeout(closeModal, 600);
                },
                onError: (msg) => setStatus(msg, 'error'),
            });

            await scanner.start();
        });
    });
}

export { BarcodeScanner, initBarcodeScannerUI };

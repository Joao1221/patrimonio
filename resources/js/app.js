import './bootstrap';
import { initBarcodeScannerUI } from './barcode-scanner';

document.addEventListener('DOMContentLoaded', () => {
    initBarcodeScannerUI();

    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuButton && mobileMenu) {
        const closeMenu = () => {
            mobileMenu.classList.add('hidden');
            menuButton.setAttribute('aria-expanded', 'false');
        };

        menuButton.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            menuButton.setAttribute('aria-expanded', String(!isHidden));
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeMenu();
            }
        });

        document.addEventListener('click', (event) => {
            const target = event.target;
            if (!(target instanceof Element)) return;
            if (!mobileMenu.classList.contains('hidden') && !mobileMenu.contains(target) && !menuButton.contains(target)) {
                closeMenu();
            }
        });

        mobileMenu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', closeMenu);
        });
    }
});

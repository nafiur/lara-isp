import '../css/app.css';
import './bootstrap';

import 'admin-lte/dist/css/adminlte.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'overlayscrollbars/styles/overlayscrollbars.css';

import 'admin-lte/dist/js/adminlte.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const sidebarWrapper = document.querySelector('.sidebar-wrapper');

    if (sidebarWrapper && window.OverlayScrollbars) {
        window.OverlayScrollbars(sidebarWrapper, {
            scrollbars: { autoHide: 'leave' },
        });
    }

    document.body.classList.add('app-loaded');
});

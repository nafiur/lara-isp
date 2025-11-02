import * as bootstrap from 'bootstrap';
import { OverlayScrollbars } from 'overlayscrollbars';

import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.bootstrap = bootstrap;
window.OverlayScrollbars = window.OverlayScrollbars || OverlayScrollbars;

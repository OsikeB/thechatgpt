import './bootstrap';
import Alpine from 'alpinejs';
import '@fortawesome/fontawesome-free/css/all.min.css';
import { register } from 'swiper/element/bundle';

register();

window.Alpine = Alpine;
Alpine.start();
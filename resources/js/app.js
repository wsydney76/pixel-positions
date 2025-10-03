import './bootstrap';
import '../css/app.css';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import focus from '@alpinejs/focus'

import.meta.glob([
    '../images/**'
]);

Alpine.plugin(focus)

Livewire.start()

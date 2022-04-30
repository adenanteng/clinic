import Alpine from 'alpinejs'
import component from "alpinejs-component";
import persist from '@alpinejs/persist'

Alpine.plugin(component);
Alpine.plugin(persist)
window.Alpine = Alpine

Alpine.start()

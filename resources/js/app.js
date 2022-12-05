require('./bootstrap');

window.Vue = require('vue').default;

import { createApp } from 'vue';
import LGASummary from "./Components/LGASummaryDashboard.vue"

let app=createApp({})
app.component('lgasummary-dashboard-component', LGASummary);
app.mount("#vBody");


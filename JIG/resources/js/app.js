import TallyDashboard from "./Components/TallyDashboard";

require('./bootstrap');

window.Vue = require('vue').default;

import { createApp } from 'vue';
import LGASummary from "./Components/LGASummaryDashboard.vue"
import SpreadDashboard from "./Components/SpreadDashboard";

let app=createApp({})
app.component('lgasummary-dashboard-component', LGASummary);
app.component('tally-dashboard-component', TallyDashboard);
app.component('spread-dashboard-component', SpreadDashboard);
app.mount("#vBody");


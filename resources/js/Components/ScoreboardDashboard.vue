<template>
    <div class="row">
        <div class="col-12">
            <div class="Container">
                <input type="radio" class="radio" name="progress" value="twentyfive" id="twentyfive">
                <label for="twentyfive" class="label">Reporting Progress - {{ vote_reported_percentage }}%</label>
                <div class="progress d-none d-md-block">
                    <div class="progress-bar" :style="'width:'+vote_reported_percentage+'%'"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-6 text-end">
            <div class="row m-0 p-0">
                <div class="col-md-10 text-end">
                    <img src="/image/ours.png" class="img-fluid" height="200" max />
                </div>
                <div class="col-md-2 text-end text-success">
                    APC
                    <p class="h3 text-success">{{ APCTotal }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 text-start">
            <div class="row m-0 p-0">
                <div class="col-md-2 mr-2 text-warning">
                    PDP
                    <p class="h3 text-warning">{{ PDPTotal }}</p>
                </div>
                <div class="col-md-10">
                    <img src="/image/theirs.png" class="img-fluid" height="200" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <div class="h4 py-2 bg-success text-white" :class="{'bg-danger': diff<0}">
                <div v-if="diff>0">+{{ diff }}<br /><small>{{ gap }}%</small></div>
                <div v-if="diff<0">-{{ diff }}<br /><small>{{ gap }}%</small></div>
            </div>
        </div>
    </div>
    <div class="row m-2">
        <div class="col-12">
            <div class="row m-2">
                <div class="col-12 col-md-3 text-center mb-2" v-for="LGA in LGWinners" style="color:#bbb;">
                    <div class="card">
                        <div class="card-body" style="height: 100px;" :class="{ 'text-primary':LGA.leading_party}">
                            <div class="row p-0 m-0">
                                <div class="col-3 col-md-12">
                                    <img :src="LGA.logo" style="height: 48px;" />
                                </div>
                                <div class="col-9 col-md-12">
                                    <div style="font-size: 1.15em;"><a :href="'/dash-/spread/'+LGA.id"><strong>{{ LGA.name }}</strong></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'scoreboard-dashboard-component',
    components: {},
    data(){
        return {
            time: "",
            vote_total: "",
            vote_reported_percentage: "",
            PartyResults: [],
            PDPTotal: '',
            APCTotal: '',
            diff: '',
            APCPerc: '',
            PDPPerc: '',
            LGWinners: [],
        }
    },
    mounted() {
        this.loadLGAs();
    },
    methods: {
        loadLGAs(){
            axios.get("/api/ajx_get_lga_winners")
                .then(response => {
                    var rData = response.data;
                    this.APCTotal = rData.payload.APCTotal
                    this.PDPTotal = rData.payload.PDPTotal
                    this.LGWinners = rData.payload.LGWinners
                    this.diff = rData.payload.diff.difference
                    this.gap = rData.payload.diff.gap
                    this.APCPerc = rData.payload.diff.apc_perc
                    this.PDPPerc = rData.payload.diff.pdp_perc
                    this.vote_reported_percentage = rData.payload.progress.percentage
                    this.time = rData.payload.time
                    this.loading = false
                })
                .catch(error => {
                    this.loading = false
                }).finally({
            });
            setTimeout(function () { this.loadLGAs() }.bind(this), 20000)
        }
    }
}
</script>

<style scoped>
.Container {
    background-color:#444;
    margin: 0;
    padding: 10px 0;
    width: 100%;
    text-align: center;
}

.Container .progress {
    margin: 0 auto;
    width: 25%;
}

.progress {
    padding: 4px;
    background: rgba(0, 0, 0, 0.25);
    border-radius: 6px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
}

.progress-bar {
    height: 16px;
    border-radius: 4px;
    background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
    background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
    background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
    background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
    -webkit-transition: 0.4s linear;
    -moz-transition: 0.4s linear;
    -o-transition: 0.4s linear;
    transition: 0.4s linear;
    -webkit-transition-property: width, background-color;
    -moz-transition-property: width, background-color;
    -o-transition-property: width, background-color;
    transition-property: width, background-color;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
}

.radio {
    display: none;
}

.label {
    display: inline-block;
    margin: 0 5px 20px;
    padding: 3px 8px;
    color: #aaa;
    text-shadow: 0 1px black;
    border-radius: 3px;
    cursor: pointer;
}

.radio:checked + .label {
    color: white;
    background: rgba(0, 0, 0, 0.25);
}
</style>

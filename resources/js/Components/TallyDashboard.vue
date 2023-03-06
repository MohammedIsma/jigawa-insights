<template>
    <div class="row m-2">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <p class="h6">Tally Count - {{ time }}</p>
                    <hr />
                    <p class="h4 text-center text-primary"><strong>TOTAL Votes Cast: {{ vote_total }}</strong></p>
                    <table class="table table-striped">
                        <tr v-for="Result in PartyResults">
                            <td><img :src="Result.logo" style="height:50px;" /></td>
                            <td>{{ Result.party }}</td>
                            <td class="text-right">{{ Result.count }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-7">
            <hr />
            <p class="h1 text-center text-info"> {{ vote_reported_percentage }}% Reported </p>
            <hr />
            <div class="row m-2">
                <div class="col-3 text-center mb-2" v-for="LGA in LGWinners" style="color:#bbb;">
                    <div class="card">
                        <div class="card-body" style="height: 100px;" :class="{ 'text-primary':LGA.leading_party}">
                            <div style="font-size: 1.15em;"><a :href="'/dash/spread/'+LGA.id"><strong>{{ LGA.name }}</strong></a></div>
                            <img :src="LGA.logo" style="height: 48px;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'tally-dashboard-component',
    components: {},
    data(){
        return {
            time: "",
            vote_total: "",
            vote_reported_percentage: "",
            PartyResults: [],
            LGWinners: []
        }
    },
    mounted() {
        this.getTotalTallies();
        this.loadLGAs();
    },
    methods: {
        getTotalTallies(){
            axios.get("/api/ajx_get_tally_results")
                .then(response => {
                    var rData = response.data;
                    this.PartyResults = rData.results
                    this.time = rData.time
                    this.vote_total = rData.total_votes
                    this.vote_reported_percentage = rData.vote_global_reporting
                })
                .catch(error => {
                }).finally({
            });
            setTimeout(function () { this.getTotalTallies() }.bind(this), 5000)
        },
        loadLGAs(){
            axios.get("/api/ajx_get_lga_winners")
                .then(response => {
                    var rData = response.data;
                    this.LGWinners = rData.payload.LGWinners
                    this.time = rData.payload.time
                    this.loading = false
                })
                .catch(error => {
                    this.loading = false
                }).finally({
            });
            setTimeout(function () { this.loadLGAs() }.bind(this), 5000)
        }
    }
}
</script>

<style>
body{
}
</style>

<template>
    <div class="row p-3" style="background-color: #0c4128;">
        <div class="col-12 text-center mb-2">
            <a href="/dash/tally" class="text-white mb-2 pb-2" v-if="!displayWard">back to Tally Dashboard</a>
            <div class="card">
                <div class="card-body">
                    <p class="h4" v-if="!is_loading"><a :href="'/dash/spread/' + LGA.id">{{ LGA.name }} LG</a></p>
                    <p class="h4 text-primary" v-if="is_loading">LOADING...</p>
                </div>
            </div>
        </div>
        <div class="col-12 text-left" v-if="!displayWard">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <thead>
                        <tr>
                            <th colspan="7"></th>
                            <th class="text-center" :colspan="Parties.length+1">RESULTS</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Ward</th>
                            <th class="text-center">Reg. PU Count</th>
                            <th class="text-center">Reg. Voters</th>
                            <th class="text-center">Accredited</th>
                            <th class="text-center">PUs reported</th>
                            <th class="text-center">Completion</th>
                            <th v-for="Party in Parties">
                                {{ Party }}
                            </th>
                            <th class="bg-primary text-center">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="Ward in Wards">
                            <td>{{ Ward.id }}</td>
                            <td><a href="javascript:void(0);" @click="getPartiesPUWithTally(Ward.id)">{{ Ward.name }}</a></td>
                            <td>{{ Ward.polling_unit_count }}</td>
                            <td>{{ Ward.voter_count }}</td>
                            <td>{{ Ward.accredited_count }}</td>
                            <td>{{ Ward.reported_pu_count }}</td>
                            <td><div v-if="Results[Ward.id]">{{ Results[Ward.id].reported }}%</div></td>
                            <td v-for="Party in Parties">
                                <div v-if="Results[Ward.id]">
                                    <span v-if="Results[Ward.id].results[Party]">{{ Results[Ward.id].results[Party].tally }}</span>
                                    <span v-else>--</span>
                                </div>
                                <span v-else>-</span>
                            </td>
                            <td class="bg-primary text-white text-center"><div v-if="Results[Ward.id]">{{ Results[Ward.id].total_votes }}</div></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th v-for="Party in Parties">{{ PartyTotals[Party] }}</th>
                            <th class="bg-primary text-center">TOTAL</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 text-left" v-if="displayWard">
            <div class="card">
                <div class="card-header text-center bg-info text-white"><strong>{{ displayWard.name }} Ward</strong></div>
                <div class="card-body">
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                        <tr>
                            <th colspan="4"></th>
                            <th class="text-center" :colspan="Parties.length+1">RESULTS</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th class="text-center">Reg. Voters</th>
                            <th class="text-center">Accredited</th>
                            <th class="text-center">Reported?</th>
                            <th class="text-center" v-for="Party in Parties">{{ Party }}</th>
                            <th class="text-right bg-primary text-center">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="PU in PUs">
                            <td>{{ PU.name }}</td>
                            <td class="text-center">{{ PU.voter_count }}</td>
                            <td class="text-center">{{ PU.accredited_count }}</td>
                            <td class="text-center">
                                <div v-if="PU.is_reported" class="text-success">Yes</div>
                                <div v-else class="text-danger">No</div>
                            </td>
                            <td class="text-center" v-for="Party in Parties">
                                <div v-if="PUResults[PU.id]">
                                    <span v-if="PUResults[PU.id].results[Party]">{{ PUResults[PU.id].results[Party].tally }}</span>
                                    <span v-else>--</span>
                                </div>
                                <span v-else>-</span>
                            </td>
                            <td class="bg-primary text-white text-center"><div v-if="PUResults[PU.id]">{{ PUResults[PU.id].total_votes }}</div></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th v-for="Party in Parties">{{ PUPartyTotals[Party] }}</th>
                            <th class="bg-primary text-center">TOTAL</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'spread-dashboard-component',
    components: {},
    props: [ 'lgaid', 'wardid', 'puid'],
    data(){
        return {
            is_loading: false,
            page: 'wards',
            time: "",
            displayWard: false,
            LGA: [],
            Wards: [],
            PUs: [],
            Parties: [],
            PartyTotals: [],
            PUPartyTotals: [],
            Results: {},
            PUResults: {}
        }
    },
    mounted() {
        this.getWardsDatabox();
        if(this.wardid>0){
            // this.getPUsDatabox();
            // this.getPartiesWithTally();
        }else if(this.lgaid>0) {
            this.getPartiesWithTally();
        }
    },
    methods: {
        getPUsDatabox(){
            axios.get("/api/ajx_get_wards/" + this.lgaid)
                .then(response => {
                    var rData = response.data;
                    this.LGA = rData.payload.LGA
                    this.Wards = rData.payload.Wards
                    this.time = rData.payload.time
                })
                .catch(error => {
                }).finally({
            });
            setTimeout(function () { this.getWardsDatabox() }.bind(this), 15000)
        },
        getWardsDatabox(){
            axios.get("/api/ajx_get_wards/" + this.lgaid)
                .then(response => {
                    var rData = response.data;
                    this.LGA = rData.payload.LGA
                    this.Wards = rData.payload.Wards
                    this.time = rData.payload.time
                })
                .catch(error => {
                }).finally({
            });
            setTimeout(function () { this.getWardsDatabox() }.bind(this), 15000)
        },
        getPartiesWithTally(){
            this.is_loading = true;
            axios.get("/api/ajx_get_wardparties_with_tally/" + this.lgaid)
                .then(response => {
                    var rData = response.data;
                    this.Parties = rData.payload.parties
                    this.PartyTotals = rData.payload.party_votes
                    this.Results = rData.payload.results
                    this.is_loading = false;
                })
                .catch(error => {
                    this.is_loading = false;
                }).finally({
            });
        },
        getPartiesPUWithTally(wid){
            this.is_loading = true;
            axios.get("/api/ajx_get_lga_pu_results_tally/" + wid)
                .then(response => {
                    var rData = response.data;
                    this.displayWard = rData.payload.ward
                    this.PUResults = rData.payload.pu_results
                    this.PUs = rData.payload.pu_list
                    this.PUPartyTotals = rData.payload.party_votes
                    this.is_loading = false
                })
                .catch(error => {
                    this.is_loading = false
                }).finally({
            });
            // setTimeout(function () { this.getPartiesPUWithTally() }.bind(this), 15000)
        },
        getResultTallies(){
            axios.get("/api/ajx_get_wards/" + this.lgaid)
                .then(response => {
                    var rData = response.data;
                    this.Wards = rData.payload.Wards
                    this.time = rData.payload.time
                })
                .catch(error => {
                }).finally({
            });
            setTimeout(function () { this.getWardsDatabox() }.bind(this), 15000)
        }
    }
}
</script>

<style>
body{
}
</style>

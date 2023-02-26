<template>
    <div class="row p-3" style="background-color: #0c4128;">
        <div class="col-12 text-center mb-2">
            <div class="card">
                <div class="card-body">
                    <p class="h4">Dutse LG</p>
                </div>
            </div>
        </div>
        <div class="col-12 text-left">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <thead>
                        <tr>
                            <th colspan="7"></th>
                            <th class="text-center" :colspan="Parties.length">RESULTS</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Ward</th>
                            <th>Reg. PU Count</th>
                            <th>Reg. Voters</th>
                            <th>Accredited</th>
                            <th>PUs reported</th>
                            <th>Completion</th>
                            <th v-for="Party in Parties">
                                {{ Party }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="Ward in Wards">
                            <td>{{ Ward.id }}</td>
                            <td>{{ Ward.name }}</td>
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
                        </tr>
                        </tbody>
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
            time: "",
            Wards: [],
            Parties: [
            ],
            Results: {}
        }
    },
    mounted() {
        this.getPartiesWithTally();
        if(this.lgaid>0){
            this.getWardsDatabox();
        }
    },
    methods: {
        getWardsDatabox(){
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
        },
        getPartiesWithTally(){
            axios.get("/api/ajx_get_wardparties_with_tally/" + this.lgaid)
                .then(response => {
                    var rData = response.data;
                    this.Parties = rData.payload.parties
                    this.Results = rData.payload.results
                })
                .catch(error => {
                }).finally({
            });
            setTimeout(function () { this.getWardsDatabox() }.bind(this), 15000)
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

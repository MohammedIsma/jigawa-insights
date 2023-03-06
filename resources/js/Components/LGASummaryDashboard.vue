<template>
    <table class="table table-bordered table-striped" style="height: 100vh;">
        <colgroup>
            <col width="20%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
        </colgroup>
        <tr class="text-white text-uppercase" style="border-bottom: none;">
            <th class="text-black text-center">{{  time }}</th>
            <th class="bg-primary text-center" colspan="2"></th>
            <th class="bg-success text-center" colspan="3">RESULTS</th>
            <th class="bg-warning text-center" colspan="2"></th>
        </tr>
        <tr class="text-white text-uppercase" style="border-bottom: 5px solid #000;">
            <th>LGA</th>
            <th class="bg-primary text-center">Polling Units</th>
            <th class="bg-primary text-center">Registered Voters</th>
            <th class="bg-success text-center">Reported</th>
            <th class="bg-success text-center">Completion</th>
            <th class="bg-success text-center">Voters</th>
            <th class="bg-warning text-center" colspan="2"></th>
        </tr>
        <tr v-for="LGA in LGAs">
            <th>{{ LGA.name }}</th>
            <td class="text-center rank_cell">{{ LGA.polling_unit_count }}</td>
            <td class="text-center rank_cell">{{ LGA.voter_count }}</td>
            <td class="text-center rank_cell">{{ LGA.reported_pu_count }}</td>
            <td class="text-center rank_cell" :class="{'bg-success':LGA.reported_percentage>90,'text-danger':LGA.reported_percentage<50, 'text-warning' : LGA.reported_percentage<70}">{{ LGA.reported_percentage }}%</td>

            <td class="text-center rank_cell">{{ LGA.accredited_count }}</td>
            <td class="text-center rank_cell"></td>
            <td class="text-center rank_cell"></td>
        </tr>
    </table>
</template>

<script>
export default {
    name: 'lgasummary-dashboard-component',
    components: {},
    data(){
        return {
            time: "",
            LGAs: []
        }
    },
    mounted() {
        this.loadLGAs();
    },
    methods: {
        generateNumber: function () {
            return Math.floor(Math.random()*(512500-35000+1)+35000);
        },
        generateRank: function () {
            return Math.floor(Math.random() * (5 - 0 + 1));
        },
        loadLGAs(){
            axios.get("/api/ajx_get_lgas")
                .then(response => {
                    var rData = response.data;
                    this.LGAs = rData.payload.LGAs
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

<style scoped>
body{
    font-family: Arial !important;
}
table tr:nth-child(even) {
    background-color: #f2f2f2;
}
.rank_cell{
    border-left:1px solid #ccc !important;
}
.rank_cell.rank0{ background-color: rgba(0,0,0,.5); }
.rank_cell.rank1{ background-color: rgba(170,0,0,.5); }
.rank_cell.rank2{ background-color: rgba(239,152,25,.5) }
.rank_cell.rank3{ background-color: rgba(238,238,238,.5); }
.rank_cell.rank4{ background-color: rgba(51,102,153,.5); }
.rank_cell.rank5{ background-color: rgba(0,170,0,.5); }
</style>

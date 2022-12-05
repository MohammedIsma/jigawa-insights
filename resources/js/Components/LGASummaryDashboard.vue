<template>
    <table class="table table-bordered">
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
        <tr class="text-white text-uppercase" style="border-bottom: 5px solid #000;">
            <th></th>
            <th class="bg-primary text-center">VoterCount</th>
            <th class="bg-info text-center">Confidence</th>
            <th class="bg-success text-center">Gov. Personnel</th>
            <th class="bg-warning text-center">Party Personnel</th>
            <th class="bg-info text-center">Committee Cs.</th>
            <th class="bg-dark text-center">HUMINT</th>
            <th class="bg-secondary text-center">SIGINT</th>
            <th class="bg-light text-dark text-center">OSINT</th>
            <th></th>
        </tr>
        <tr v-for="LGA in LGAs">
            <th>{{ LGA.name }}</th>
            <td class="text-center rank_cell">{{ generateNumber() }}</td>
            <td class="text-center rank_cell rank3">?</td>
            <td class="text-center rank_cell" :class="'rank'+generateRank()"></td>
            <td class="text-center rank_cell" :class="'rank'+generateRank()"></td>
            <td class="text-center rank_cell" :class="'rank'+generateRank()"></td>
            <td class="text-center rank_cell" :class="'rank'+generateRank()"></td>
            <td class="text-center rank_cell" :class="'rank'+generateRank()"></td>
            <td class="text-center rank_cell" :class="'rank'+generateRank()"></td>
            <td></td>
        </tr>
    </table>
</template>

<script>
export default {
    name: 'lgasummary-dashboard-component',
    components: {},
    data(){
        return {
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
                    this.loading = false
                })
                .catch(error => {
                    this.loading = false
                }).finally({

            });
        }
    }
}
</script>

<style>
.rank_cell{
    border-left:1px solid #ccc !important;
    height:50px;
}
.rank_cell.rank0{ background-color: rgba(0,0,0,.5); }
.rank_cell.rank1{ background-color: rgba(170,0,0,.5); }
.rank_cell.rank2{ background-color: rgba(239,152,25,.5) }
.rank_cell.rank3{ background-color: rgba(238,238,238,.5); }
.rank_cell.rank4{ background-color: rgba(51,102,153,.5); }
.rank_cell.rank5{ background-color: rgba(0,170,0,.5); }
</style>

<template>
    <div class="row m-2" style="background-color: #0c4128;">
        <div class="col-2 text-center mb-2" v-for="LGA in LGAs">
            <div class="card">
                <div class="card-body" style="height: 125px;">
                    <div style="font-size: 1.3em;"><strong>{{ LGA.name }}</strong></div>
                    <img src="https://inecnigeria.org/wp-content/uploads/2018/10/ADP.png" width="100" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'spread-dashboard-component',
    components: {},
    data(){
        return {
            time: "",
            LGAs: []
        }
    },
    mounted() {
        this.getLGADatabox();
    },
    methods: {
        getLGADatabox(){
            axios.get("/api/ajx_get_lgas")
                .then(response => {
                    var rData = response.data;
                    this.LGAs = rData.payload.LGAs
                    this.time = rData.payload.time
                })
                .catch(error => {
                }).finally({
            });
            setTimeout(function () { this.getLGADatabox() }.bind(this), 5000)
        }
    }
}
</script>

<style>
body{
}
</style>

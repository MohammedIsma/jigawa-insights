<template>
    <div class="row">
        <div class="col-12">
            <p class="h2 bg-danger text-white text-center">RECENT INCIDENTS ({{ incidents.length }})</p>
            <p class="m-0 p-0 text-center"><small>{{ datetime}}</small></p>
        </div>
        <div class="col-12" style="font-size:.8em;">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>DATE/TIME</th>
                    <th>LGA</th>
                    <th>WARD</th>
                    <th>DELIM</th>
                    <th>POLLING UNIT</th>
                    <th>DESCRIPTION</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="incident in incidents">
                    <td style="white-space: nowrap;">#{{ incident.ident }}</td>
                    <td style="white-space: nowrap;">{{ incident.datetime }}</td>
                    <td style="white-space: nowrap;">{{ incident.lga }}</td>
                    <td style="white-space: nowrap;">{{ incident.ward }}</td>
                    <td style="white-space: nowrap;">{{ incident.pu.number }}</td>
                    <td style="white-space: nowrap;">{{ incident.pu.name }}</td>
                    <td>{{ incident.description }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'problem-dashboard-component',
    components: {},
    data(){
        return {
            incidents: [],
            datetime: ""
        }
    },
    mounted() {
        this.getIncidents();
    },
    methods: {
        getIncidents(){
            axios.get("/api/ajx_get_incidences")
                .then(response => {
                    var rData = response.data;
                    this.incidents = rData.incidences
                    this.datetime = rData.datetime
                })
                .catch(error => {
                }).finally({
            });
            setTimeout(function () { this.getIncidents() }.bind(this), 5000)
        }
    }
}
</script>

<style>
body{
}
</style>

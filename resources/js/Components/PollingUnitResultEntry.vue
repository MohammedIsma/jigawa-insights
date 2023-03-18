<template>
    <div class="p-5 text-center" v-if="is_loading">
        <p class="h3 text-black">
            Loading Polling Units...
        </p>
    </div>
    <div v-else>
        <div class="p-5 text-center" v-if="is_saving">
            <p class="h3 text-black">
                Saving ...
            </p>
        </div>
        <table class="table table-bordered   table-hover" v-else>
        <thead>
        <tr>
            <th>DELIM.</th>
            <th>PU</th>
            <th style="white-space: nowrap;">Reg. Voters</th>
            <th></th>
            <th class="text-center" v-for="Party in Parties">{{ Party.slug }}</th>
            <th><button @click="SavePUDate" type="submit" class="btn btn-sm btn-success">save</button></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="PU in PollingUnits">
            <td style="white-space: nowrap;">{{ PU.number }}</td>
            <td style="white-space: nowrap;">
                {{ PU.name }}
                <div v-if="PU.has_issue" class="bg-warning pl-1"><i class="fa fa-exclamation-triangle"></i> Has Issue!</div>
            </td>
            <td>{{ PU.voter_count }}</td>
            <td>
                <i @click="enablePU(PU.id)" v-if="!enable_pus.includes(PU.id)" class="fa fa-lock text-danger"></i>
                <i @click="disablePU(PU.id)" v-if="enable_pus.includes(PU.id)" class="fa fa-unlock text-success"></i>
            </td>
            <td class="text-center" v-for="Party in Parties">
                <input v-if="Results[PU.id]"
                       :disabled="is_saving || !enable_pus.includes(PU.id)"
                       type="number"
                       class="vote_input"
                       :name="'pvote['+PU.id+']['+Party.id+']'"
                       v-model="Results[PU.id][Party.id]" />
                <input v-if="!Results[PU.id]"
                       :disabled="is_saving || !enable_pus.includes(PU.id)"
                       type="number"
                       class="vote_input"
                       v-model="Results[PU.id][Party.id]"
                        :name="'pvote['+PU.id+']['+Party.id+']'" />
            </td>
            <td>
                <div v-if="user_id==1">

                </div>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
export default {
    name: 'polling-unit-result-entry',
    components: {},
    props: [ 'ward_id', 'user_id'],
    data(){
        return {
            is_loading: false,
            is_saving: false,
            enable_pus: [],
            Parties: [],
            PollingUnits: [],
            Results: [],
        }
    },
    mounted() {
        this.getPollingUnitsSheet( this.ward_id );
    },
    methods: {
        getPollingUnitsSheet(){
            this.is_loading = true;
            axios.get("/api/ajx_get_ward_result_entry/" + this.ward_id)
                .then(response => {
                    var rData = response.data;
                    this.Parties = rData.political_parties;
                    this.PollingUnits = rData.polling_units;
                    this.Results = rData.results;
                    this.is_loading = false;
                })
                .catch(error => {
                    this.is_loading = false;
                }).finally({
            });
        },
        SavePUDate(){
            this.is_saving = true;
            console.log(this.Results);

            let p = {
                Results: this.Results,
                user_id: this.user_id
            }
            axios.post("/api/ajx_submit_ward_result_entry/" + this.ward_id, p)
                .then(response => {
                    if(response.data.success){
                        this.getPollingUnitsSheet();
                        alert("Saved")
                        this.enable_pus = [];
                    }
                    this.is_saving = false;
                })
                .catch(error => {
                    this.is_saving = false;
                }).finally({
            });
        },
        disablePU(puid){
            this.enable_pus.splice(this.enable_pus.indexOf(puid), 1);
        },
        enablePU(puid){
            this.enable_pus.push(puid)
        }
    }
}
</script>

<style>
body{
}
</style>

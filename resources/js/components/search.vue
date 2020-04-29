<template>
    <div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-6 margin-tb">
                <div class="pull-left">
                    <h3>Projects</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="projects/create">Add Project</a>
                </div>
            </div>

            <div class="col-lg-6 margin-tb">
                <div class="pull-right">
                    <h3>Filter</h3>
                </div>
                <div class="pull-right">
                    <div style="width:175px;">
                        <select class="custom-select" v-model="filterQuery">
                            <option value="Alle">Alle</option>
                            <option value="Aktiv">Aktiv</option>
                            <option value="Inaktiv">Inaktiv</option>
                            <option value="Gelöscht">Gelöscht</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="input_group">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" aria-label="Search" @keyup="searchIt"
                       v-model="searchQuery" aria-describedby="basic-addon1">
            </div>
        </div>
        <div>
            <table class="table table-bordered">
                <tr>
                    <th width="160px">Studien-Nummer</th>
                    <th width="160px">Programmierer</th>
                    <th width="160px">Projektleiter</th>
                    <th>Details</th>
                    <th>Infos</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <tr v-for="survey in surveys">
                    <td>{{ survey.survey_number }}</td>
                    <td>{{ survey.programmer }}</td>
                    <td>{{ survey.project_manager }}</td>
                    <td>{{ survey.detail }}</td>
                    <td>{{ survey.info }}</td>
                    <td>{{ survey.status }}</td>
                    <td>
                        <a class="btn btn-info" :href="'projects/' + survey.id">Show</a>

                        <a class="btn btn-primary" :href="'projects/' + survey.id + '/edit'">Edit</a>

                        <button type="submit" class="btn btn-danger" @click="deleteEntry(survey.id)">Delete</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                surveys: [],
                searchQuery: '',
                filterQuery: 'Aktiv',
                id: [],
            }
        },

        created() {
            this.searchIt()
        },

        watch: {
            filterQuery: function () {
                this.searchIt()
            }
        },

        methods: {
            searchIt() {
                axios.post('./projectSearch', {
                    searchQuery: this.searchQuery,
                    filterQuery: this.filterQuery
                }).then(response => this.surveys = response.data)
                console.log(this.searchQuery)
            },
            softDeleteEntry(id){
                axios.post('./softDelete').then(response => this.id = response.data)
                console.log(id)
            },

            deleteEntry(id) {
                let url = './api/projects/' + id
                axios.delete(url).then(response => {
                    this.searchIt()
                })
            }

        }
    }
</script>

<style scoped>

</style>

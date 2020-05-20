<template>
    <div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-6 margin-tb">
                <div class="pull-left">
                    <h3>Projekte</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="projects/create">Projekt hinzufügen</a>
                </div>
            </div>

            <div class="col-lg-6 margin-tb" style="display: flex; flex-direction: column; align-items: flex-end;">
                <div>
                    <h3>Filter</h3>
                </div>
                <div>
                    <div style="width:175px;">
                        <select class="custom-select" v-model="filterQuery">
                            <option value="Alle">Alle</option>
                            <option value="Kick-Off">Kick-Off</option>
                            <option value="Programmierung">Programmierung</option>
                            <option value="TL bei PL">TL bei PL</option>
                            <option value="Im Feld">Im Feld</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="input_group">
            <div class="input-group mb-3">
                <input type="text" placeholder="Suche nach einer Studie!" class="form-control" name="search" aria-label="Search" @keyup="searchIt"
                       v-model="searchQuery" aria-describedby="basic-addon1">
            </div>
        </div>
        <div>
            <table class="table table-bordered">
                <tr>
                    <th width="200px">Studien-Nummer <a @click="tableNumber = 1"><img src="images/arrow_down.png" width="12px" alt="arrow"></a><a @click="tableNumber = 2"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th width="180px">Programmierer <a @click="tableNumber = 3"><img src="images/arrow_down.png" width="12px" alt="arrow"></a><a @click="tableNumber = 4"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th width="160px">Projektleiter <a @click="tableNumber = 5"><img src="images/arrow_down.png" width="12px" alt="arrow"></a><a @click="tableNumber = 6"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th width="250px">Details <a @click="tableNumber = 7"><img src="images/arrow_down.png" width="12px" alt="arrow"></a><a @click="tableNumber = 8"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th width="250px">Feldstart <a @click="tableNumber = 9"><img src="images/arrow_down.png" width="12px" alt="arrow"></a><a @click="tableNumber = 10"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th colspan="2">Status </th>

                </tr>
                <tr v-for="survey in surveys">
                    <td>{{ survey.survey_number }}</td>
                    <td>{{ survey.programmer }}</td>
                    <td>{{ survey.project_manager }}</td>
                    <td>{{ survey.detail }}</td>
                    <td>{{ survey.feldstart | dateFormat }}</td>
                    <td>{{ survey.status }}</td>
                    <td>
                        <a :href="'projects/' + survey.id + '/edit'"><svg aria-hidden="true"  width="25" focusable="false" data-prefix="fas" data-icon="edit" class="svg-inline--fa fa-edit fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg></a>
                        <svg aria-hidden="true" style="color: darkred" @click="deleteEntry(survey.id)" width="20" focusable="false" data-prefix="fas" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg>

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
                filterQuery: 'Alle',
                id: [],
                tableNumber: null,
                timesPressed: null,
            }
        },

        created() {
            this.searchIt()
        },

        filters: {
            dateFormat: function (value) {
                return value.split("-").reverse().join(".")
            }
        },


        watch: {
            filterQuery: function () {
                this.searchIt()
            },
            tableNumber: function () {
                this.searchIt()
            }
        },

        methods: {
            searchIt() {
                axios.post('./projectSearch', {
                    searchQuery: this.searchQuery,
                    filterQuery: this.filterQuery,
                    tableNumber: this.tableNumber,
                    timesPressed: this.timesPressed
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

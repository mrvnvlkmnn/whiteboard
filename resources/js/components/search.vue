<template>
    <div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-6 margin-tb">
                <div class="pull-left">
                    <h3>Projekte</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="projects/create">Projekt hinzufügen</a>
                    <a class="btn btn-info" href="sendMail">E-Mail senden</a>
                </div>
            </div>
            <div style="width: 49%; display: flex; justify-content: flex-end; align-items: flex-end; margin-right: 15px;">
                <h3>Filter</h3>
            </div>
        </div>

        <div class="input_group">
            <div class="input-group mb-3">
                <input type="text" placeholder="Suche nach einer Studie!" class="searchbar" name="search" aria-label="Search" @keyup="searchIt"
                       v-model="searchQuery" aria-describedby="basic-addon1" style="width: 87%; margin-right: 15px;">
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
        <div>
            <table class="table table-bordered">
                <tr>
                    <th width="200px">Studien-Nummer <a class="cursor" @click="tableNumber = 1"><img src="images/arrow_down.png" width="12px" alt="arrow"></a><a class="cursor" @click="tableNumber = 2"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th width="180px">Programmierer <a class="cursor" @click="tableNumber = 3"><img src="images/arrow_down.png" width="12px" alt="arrow"></a><a class="cursor" @click="tableNumber = 4"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th width="160px">Projektleiter <a class="cursor" @click="tableNumber = 5"><img src="images/arrow_down.png" width="12px" alt="arrow"></a><a class="cursor" @click="tableNumber = 6"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th width="250px">Details <a class="cursor" @click="tableNumber = 7"><img src="images/arrow_down.png" width="12px" alt="arrow"></a><a class="cursor" @click="tableNumber = 8"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th width="250px">geplanter Feldstart <a class="cursor" @click="tableNumber = 9"><img src="images/arrow_down.png" width="12px"  alt="arrow"></a><a class="cursor" @click="tableNumber = 10"><img src="images/arrow_up.png" width="12px" alt="arrow"></a></th>
                    <th colspan="2">Status </th>

                </tr>
                <tr v-for="survey in surveys">
                    <td>{{ survey.survey_number }}</td>
                    <td>{{ survey.programmer }}</td>
                    <td>{{ survey.project_manager }}</td>
                    <td>{{ survey.detail }}</td>
                    <td>{{ survey.feldstart | dateFormat }}</td>
                    <td style="border: none">{{ survey.status }}</td>
                    <td style="display: flex; justify-content: flex-end;border: none;">
                        <a :href="'projects/' + survey.id + '/edit'"><svg aria-hidden="true"  width="25" focusable="false" data-prefix="fas" data-icon="edit" class="svg-inline--fa fa-edit fa-w-18 marginL" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg></a>
                        <a class="cursor marginL"><svg aria-hidden="true" style="color: darkred" @click="setDeleteID(survey.id)" width="20" focusable="false" data-prefix="fas" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg></a>

                    </td>
                </tr>
            </table>
        </div>
        <modal v-if="showModal" @close="showModal = false" :survey-id="deleteID"></modal>
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
                showModal: false,
                deleteID: null,
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

            setDeleteID(id) {
                this.deleteID = id
                this.showModal = true
            }

        }
    }
</script>

<style scoped>
    .cursor:hover{
        cursor: pointer;
    }

    .marginL {
        margin-right: 5px;
    }
    /*
    .background{
        color:#001845;;
        background:#d4e6f6;
        border-bottom:4px solid #9ea7af;
        border-right: 1px solid #343a45;
        padding:24px;
    }
    */
    tr:first-of-type{
        color:#001845;;
        background:#d4e6f6 !important;
    }

    tr:nth-child(even) {
        background:#f6f6f6;
    }
    tr:nth-child(odd){
        background: #e9e9e9;
    }
/*
    tr {
        border-top: 1px solid #C1C3D1;
        border-bottom-: 1px solid #C1C3D1;
        color:#666B85;
        font-size:16px;
        font-weight:normal;
        text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
    }
*/
    .searchbar{
        display: block;
        width: 87%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
</style>

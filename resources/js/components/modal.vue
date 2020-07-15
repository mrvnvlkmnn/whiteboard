<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            <b>Bist du dir sicher, dass du das Projekt löschen möchtest?</b>
                        </slot>
                    </div>

                    <div class="modal-footer" style="justify-content: space-between">
                        <slot name="footer">
                            <button class="modal-default-button-yes" @click="EmitAndDeleteEntry(surveyId)">
                                Ja, ich bin mir sicher!
                            </button>
                            <button class="modal-default-button-no" @click="$emit('close')">
                                Nein, bin ich mir nicht!
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: [
            'surveyId'
        ],

        methods: {

            EmitAndDeleteEntry(id) {
                this.$emit('close')
                this.deleteEntry(id)
            },

            deleteEntry(id) {
                let url = './api/projects/' + id
                axios.delete(url).then(response => {
                    this.$parent.searchIt()
                })
            },
        }
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 550px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button-yes {
        -webkit-text-size-adjust: none;
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        overflow: hidden;
        text-decoration: none;

        background-color: #48bb78;
        border-bottom: 8px solid #48bb78;
        border-left: 18px solid #48bb78;
        border-right: 18px solid #48bb78;
        border-top: 8px solid #48bb78;
    }

    .modal-default-button-no {
        -webkit-text-size-adjust: none;
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        overflow: hidden;
        text-decoration: none;

        background-color: #e53e3e;
        border-bottom: 8px solid #e53e3e;
        border-left: 18px solid #e53e3e;
        border-right: 18px solid #e53e3e;
        border-top: 8px solid #e53e3e;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>

<template>
    <transition name="moveRight" @after-enter="showContent = true" appear>
        <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
            <!--
              Slide-over panel, show/hide based on slide-over state.

              Entering: "transform transition ease-in-out duration-500 sm:duration-700"
                From: "translate-x-full"
                To: "translate-x-0"
              Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
                From: "translate-x-0"
                To: "translate-x-full"
            -->
            <div class="relative w-screen max-w-md">
                <!--
                  Close button, show/hide based on slide-over state.

                  Entering: "ease-in-out duration-500"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in-out duration-500"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <transition name="fade" @after-leave="$emit('close')">
                    <div v-if="showContent" class="absolute top-0 left-0 -ml-8 pt-4 pr-2 flex sm:-ml-10 sm:pr-4">
                        <button aria-label="Close panel"
                                class="text-gray-300 hover:text-white transition ease-in-out duration-150"
                                @click="showContent = !showContent">
                            <!-- Heroicon name: x -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </transition>
                <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
                    <header class="px-4 sm:px-6">
                        <h2 class="text-lg leading-7 font-medium text-gray-900">
                            Erstelle ein neues Projekt
                        </h2>
                    </header>
                    <div class="relative flex-1 px-4 sm:px-6">
                        <!-- Replace with your content -->
                        <div class="absolute inset-0 px-4 sm:px-6">
                            <form @submit="checkForm" action="https://vuejs.org/" method="post">

                                <label>
                                    <strong>Studien-Nummer:</strong>
                                    <input type="text" v-model="survey_number" name="survey_number" value="" class="form-control">
                                </label>
                                <label>
                                    <select class="select2 form-control" name="programmer[]" multiple >
                                        <option v-for="programmer in programmers">{{ programmer.name }}</option>
                                    </select>
                                </label>

                                <label>
                                    <strong>Programmierer</strong>
                                    <input type="text"  v-model="programmer" name="programmer" value="" class="form-control">
                                </label>

                                <label>
                                    <strong>Projektleiter</strong>
                                    <input type="text" v-model="project_manager" name="project_manager" value="" class="form-control">
                                </label>

                                <label>
                                    <strong>Detail:</strong>
                                    <textarea class="form-control" v-model="detail" name="detail"></textarea>
                                </label>

                                <label>
                                    <strong>geplanter Feldstart:</strong>
                                    <input class="form-control" type="date" v-model="feldstart" name="feldstart" value="">
                                </label>

                                <p>
                                    <label for="movie">Favorite Movie</label>
                                    <select id="movie" v-model="movie" name="movie">
                                        <option>Star Wars</option>
                                        <option>Vanilla Sky</option>
                                        <option>Atomic Blonde</option>
                                    </select>
                                </p>

                                <p>
                                    <input type="submit" value="Submit">
                                </p>

                            </form>
                        </div>
                        <!-- /End replace -->
                    </div>
                </div>
            </div>
        </section>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            survey_number: null,
            programmer: [],
            project_manager: [],
            detail: null,
            feldstart: null,
            showContent: false,
            programmers: {
                0:{
                    name: "Antje Groth",
                },
                1: {
                    name: "Dennis Silberbach",
                },
                2: {
                    name: "Marvin Volkmann",
                },
                3: {
                    name: "Mawlid Yussuf",
                },
                4: {
                    name: "Nico Sorgenfrei",
                },
                5: {
                    name: "IT",
                },

            },
        }
    },
    methods: {
        checkForm: function (e) {
            if (this.name && this.age) {
                return true;
            }

            this.errors = [];

            if (!this.name) {
                this.errors.push('Name required.');
            }
            if (!this.age) {
                this.errors.push('Age required.');
            }

            e.preventDefault();
        }
    }
}
</script>

<style scoped>
.fade-enter, .fade-leave-to {
    opacity: 0;
}

.fade-enter-active, .fade-leave-active {
    transition: 0.5s opacity ease-in-out;
}

.moveRight-enter, .moveRight-leave-to {
    transform: translateX(100%);
}

.moveRight-enter-active, .moveRight-leave-active {
    transition: 0.5s transform ease-in-out;
}
</style>

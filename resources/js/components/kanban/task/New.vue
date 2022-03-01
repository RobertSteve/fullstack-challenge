<template>
    <div class="bg-gray-900 bg-opacity-50 fixed inset-0 z-40">
        <div class="flex justify-content overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
            <div class="relative px-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex justify-between items-center py-4 px-6 rounded-t border-b">
                        <h3 class="text-base font-semibold text-gray-900 lg:text-xl">
                            Nueva Tarea
                        </h3>
                        <button 
                            type="button" 
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                            @click="closeModal()">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <form 
                        @submit="saveTask"
                        class="p-6 space-y-6 lg:px-8 sm:pb-10 xl:pb-10">
                        <div>
                            <label for="task" class="block mb-2 text-sm font-medium text-gray-900">Tarea:</label>
                            <input 
                                type="task" 
                                name="task" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                placeholder="Ingrese la tarea" 
                                v-model="name"
                                required>
                        </div>
                        <div>
                            <label for="estimation_at" class="block mb-2 text-sm font-medium text-gray-900">Fecha de estimación:</label>
                            <input 
                                type="date" 
                                name="estimation_at" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                v-model="estimation_at"
                                required>
                        </div>
                        <button 
                            type="submit" 
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            :disabled="isDisabled">
                            Grabar
                        </button>
                    </form>
                </div>
            </div>
        </div> 
    </div>
</template>
<script>
    export default {
        name: 'New',
        props: {
            stage: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                name: null,
                estimation_at: null,
                isDisabled: false,
            }
        },
        methods: {
            closeModal() {
                this.$store.commit('SET_CREATE_MODAL', false);
            },
            saveTask(event) {
                this.isDisabled = true;
                event.preventDefault();
                const data = {
                    name: this.name,
                    estimation_at: this.estimation_at,
                    stage: this.stage
                }
                this.$store.dispatch('storeTask', data)
            }
        }
    }
</script>
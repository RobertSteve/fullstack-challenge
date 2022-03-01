<template>
    <div class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40">
        <div class="flex aligns-center overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full">
            <div class="relative px-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex justify-end p-2">
                        <button 
                            type="button" 
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" 
                            @click="closeModal()">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <div class="p-6 pt-0 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg> 
                        <h3 class="mb-5 text-lg font-normal text-gray-500"> {{this.$store.state.messageModal}} </h3>
                        <button data-modal-toggle="popup-modal"
                            type="button" 
                            class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2" 
                            @click="closeModal()">
                            ¡Gracias!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        methods: {
            closeModal() {
                this.$store.commit('SET_MESSAGE_MODAL', null)
            }
        }
    };
</script>
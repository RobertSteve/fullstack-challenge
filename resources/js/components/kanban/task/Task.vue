<template>
    <div>
        <div
            :class="[isExpired ? 'text-red-800 ' : '']"
            class="mt-2 block p-5 bg-white rounded-md shadow" @click="editModal = true">
            <div class="flex justify-between items-center">
                <p class="text-sm font-medium leading-snug">{{ task.name }}</p>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
            <div
                :class="[isExpired ? 'text-red-800 ' : '']" 
                class="flex flex-col justify-between mt-1 text-xs text-gray-600">
                <div>
                    <span class="font-medium">Creado el:</span>
                    <time>{{ task.created_at_format }}</time>
                </div>
                <div>
                    <span class="font-medium">Fecha estimada:</span>
                    <time>{{ task.estimation_at_format }}</time>
                </div>
                <div v-if="task.stage === 'done'">
                    <span class="font-medium">Fecha entregada:</span>
                    <time>{{ task.delivery_at_format }}</time>
                </div>
            </div>
        </div>
        <edit v-if="editModal" :task="task" @closeModal="editModal = false"></edit>
    </div>
</template>
<script>
    import Edit from './Edit.vue';
    export default {
        components: {
            Edit
        },
        props: {
            task: {},
        },
        data() {
            return {
                editModal: false
            }
        },
        methods: {
            getTask: function(type, id) {
                this.$store.dispatch('getTask', {type, id});
            }
        },
        computed: {
            isExpired() {
                let now = new Date().setHours(0,0,0,0);
                let estimatedAt = new Date(this.task.estimation_at).setHours(0,0,0,0)
                return estimatedAt < now; 
            }
        }
    };
</script>

<template>
    <div class="h-screen flex">
        <div class="w-64 px-8 py-4 bg-gray-100 border-r">
            <img class="h-9 w-9" src="https://scontent.flim13-1.fna.fbcdn.net/v/t1.6435-1/197426563_805036880386154_3547908156571545669_n.jpg?stp=dst-jpg_s200x200&_nc_cat=1&ccb=1-5&_nc_sid=1eb0c7&_nc_eui2=AeFwP3Ryp_UlFYbVziU-1Dpuhwl4MYEd7eaHCXgxgR3t5jM7CXuJ61Quc6VVEN65ayU&_nc_ohc=fnTGyI6GJCAAX-macwS&_nc_ht=scontent.flim13-1.fna&oh=00_AT98_zl2SdHXdGVKflAqasBegkEEJp0EEZ3JXWxbQdm7gg&oe=623DF655" alt="">
            <nav class="mt-8">
                <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Tareas</h3>
                <div class="mt-2">
                    <a
                        href="#"
                        class="flex justify-between items-center px-3 py-2 bg-gray-200 rounded-lg">
                        <span class="text-sm font-medium text-gray-900">Todos</span>
                        <span class="text-xs font-semibold text-gray-700">{{ current_buffer.length + current_working.length + current_done.length }}</span>
                    </a>
                </div>
            </nav>
        </div>
        <div class="flex-1 min-w-0 bg-white">
            <header class="px-6 border-b border-gray-300">
                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                    <div class="flex-1">
                        <h1 class="text-xl font-bold text-gray-800">Kanban Board</h1>
                    </div>
                    <div class="flex items-center">
                        <button class="flex justify-center text-sm font-medium text-gray-800" @click="logout()">
                            <span class="mr-2">
                                Cerrar Sessión
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center">
                        <h2 class="text-2xl font-semibold text-gray-900 leading-tight">Todas las tareas</h2>
                    </div>
                </div>
            </header>
            <div>
                <main class="p-3 flex">
                    <div class="flex-shrink-0 p-3 w-80 bg-gray-100 rounded-md ml-3">
                        <div class="flex justify-between text-sm font-medium text-gray-800">
                            <h3>Buffer ({{current_buffer.length}})</h3>
                            <a 
                                href="#" 
                                class="no-underline hover:underline"
                                @click="openCreateModal('buffer')">
                                Añadir Tarea</a>
                        </div>
                        <draggable
                            class="mt-2 h-full"
                            group="tasks"
                            :list="current_buffer"
                            :animation="200"
                            @change="onChange"
                            >
                            <task
                                v-for="task in current_buffer"
                                class="cursor-move"
                                :key="task.id"
                                :task="task"
                                >
                            </task>
                        </draggable>
                    </div>
                    <div class="flex-shrink-0 p-3 w-80 bg-gray-100 rounded-md ml-3">
                        <div class="flex justify-between text-sm font-medium text-gray-800">
                            <h3>Working ({{current_working.length}})</h3>
                            <a 
                                href="#" 
                                class="no-underline hover:underline"
                                @click="openCreateModal('working')">
                                Añadir Tarea</a>
                        </div>
                        <draggable
                            class="mt-2 h-full"
                            group="tasks"
                            :list="current_working"
                            :animation="200"
                            @change="onChange">
                            <task
                                v-for="task in current_working"
                                class="cursor-move"
                                :key="task.id"
                                :task="task"
                                >
                            </task>
                        </draggable>
                    </div>
                    <div class="flex-shrink-0 p-3 w-80 bg-gray-100 rounded-md ml-3">
                        <div class="flex justify-between text-sm font-medium text-gray-800">
                            <h3>Done ({{current_done.length}})</h3>
                            <a 
                                href="#" 
                                class="no-underline hover:underline"
                                @click="openCreateModal('done')">
                                Añadir Tarea</a>
                        </div>
                        <draggable
                            class="mt-2 h-full"
                            group="tasks"
                            :list="current_done"
                            :animation="200"
                            @change="onChange">
                            <task
                                v-for="task in current_done"
                                :key="task.id"
                                :task="task"
                                class="cursor-move">
                            </task>
                        </draggable>
                    </div>
                </main>
            </div>
        </div>
        <message-modal v-if="messageModal"></message-modal>
        <new v-if="showCreateModal" :stage="this.stage"></new>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex';
    import draggable from 'vuedraggable';
    import Task from './task/Task.vue';
    import MessageModal from '../utils/MessageModal.vue';
    import New from './task/New.vue';

    export default {
        name: 'Dashboard',
        components: {
            draggable,
            Task,
            MessageModal,
            New
        },
        data() {
            return {
                message: null,
                stage: null,
                current_buffer: [],
                current_working: [],
                current_done: [],
                update_sortable_related: {},
                update_sortable_dragged: {}, 
            }
        },
        watch: {
            buffer: {
                deep: true,
                immediate: true,
                handler(value) {
                    this.current_buffer = value;
                }
            },
            working: {
                deep: true,
                immediate: true,
                handler(value) {
                    this.current_working = value;
                }
            },
            done: {
                deep: true,
                immediate: true,
                handler(value) {
                    this.current_done = value;
                }
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout');
            },
            onChange(event) {
                let element = event.added && event.added.element ? event.added.element : null;
                if (element) {
                    const buffer = this.buffer.filter(function(value){
                        return value.id === element.id;
                    });
                    const working = this.working.filter(function(value){
                        return value.id === element.id;
                    });
                    const done = this.done.filter(function(value){
                        return value.id === element.id;
                    });
                    if (buffer.length > 0) {
                        buffer[0].stage = 'buffer';
                        this.$store.dispatch('updateTask', buffer[0]);
                        return;
                    }
                    if (working.length > 0) {
                        working[0].stage = 'working';
                        this.$store.dispatch('updateTask', working[0]);
                        return;
                    }
                    if (done.length > 0) {
                        done[0].stage = 'done';
                        this.$store.dispatch('updateTask', done[0]);
                        this.$store.commit('SET_MESSAGE_MODAL', 'Felicitaciones por lograrlo!');
                        return;
                    }
                }
            },
            openCreateModal: function(stage) {
                this.stage = stage;
                return this.$store.commit('SET_CREATE_MODAL', true);
            }
        },
        computed: {
            ...mapGetters(['buffer', 'working', 'done']),
            messageModal() {
                 return this.$store.state.messageModal;
            },
            showCreateModal() {
                return this.$store.state.createModal;
            }

        },
        created() {
            const token = localStorage.getItem('token')
            if (!token) {
                this.$router.push('/login');
            } else {
                this.$store.dispatch('getTasks');
            }
        }
    }
</script>

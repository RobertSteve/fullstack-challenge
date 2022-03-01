import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        token: null,
        tasks: {},
        messageModal: null,
        createModal: false
    },
    getters: {
        task(state) {
            return state.task;
        },
        buffer(state) {
            return state.tasks.buffer ?? [];
        },
        working(state) {
            return state.tasks.working ?? [];
        },
        done(state) {
            return state.tasks.done ?? [];
        }
    },
    actions: {
        getTasks({commit}) { 
            window.axios.get("/api/tasks")
            .then((response) => {
                commit('SET_TASKS', response.data.data);
            }).catch((error) => {
                // TODO
                console.log(error);
            });
        },
        updateTask({dispatch}, payload) {
            window.axios.put(`/api/tasks/${payload.id}`, payload)
            .then((response) => {
                dispatch('getTasks');
            }).catch((error) => {
                // TODO
                console.log(error);
            });
        },
        storeTask({dispatch, commit}, payload) {
            window.axios.post('/api/tasks', payload)
            .then((response) => {
                dispatch('getTasks');
                commit('SET_CREATE_MODAL', false);
            }).catch((error) => {
                // TODO
                console.log(error);
            });
        },
        logout({commit}) {
            window.axios.post('/api/logout')
            .then((response) => {
                commit('SET_TOKEN', null);
                localStorage.clear();
                location.reload();
            }).catch((error) => {
                // TODO
                console.log(error);
            });
        }
    },
    mutations: {
        SET_TOKEN(state, payload) {
            state.token = payload;
        },
        SET_TASKS(state, payload) {
            state.tasks = payload;
        },
        SET_MESSAGE_MODAL(state, payload) {
            state.messageModal = payload;
        },
        SET_CREATE_MODAL(state, payload) {
            state.createModal = payload;
        }
    }
});
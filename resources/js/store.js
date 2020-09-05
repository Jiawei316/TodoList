import Vue from 'vue';
import Vuex from 'vuex';
import { getTodo } from "./api";

Vue.use(Vuex);

export default new Vuex.Store({
    state:{
      todos:[],
    },
    getters:{
        getTodos: state => state.todos,
    },
    mutations:{
        setTodos: (state,payload) => state.todos = payload,
    },
    actions:{
        async getTodos({commit}){
            commit('setTodos',await getTodo().then(res => res.data));
        },
    }
});

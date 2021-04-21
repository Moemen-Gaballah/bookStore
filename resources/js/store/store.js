import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        counter: 0,
        storeToken: '',
        // storeToken: localStorage.getItem("token") ? localStorage.getItem("token") : '',
    }
});

export default store;

import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)


export default new Vuex.Store({
    state:{
        user:[],
        posts:[]
    },
    getters:{
        getUserInfo(state){
            return state.user;
        },
        getPosts(state){
            return state.posts;
        }
    },
    mutations:{
        StorePost(state,post){
            state.posts = post
        },

    },
    actions:{

    }

});

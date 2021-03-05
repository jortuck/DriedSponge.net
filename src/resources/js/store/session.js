import axios from "axios";
import router from '../router'
import { createStore } from 'vuex'
const session = createStore({
    state(){
        return{
            loaded: false,
            authenticated: false,
            user: {
                id: null,
                username: null,
                steamid: null,
                avatar: null
            },
            permissions: {}
        }
    },
    mutations:{
        fetch(state){
            axios.get("/app/user").then(res => {
                state.authenticated = res.data['user'] !== null;
                if (state.authenticated) {
                    state.user = res.data['user'];
                } else {
                    state.user = null;
                }
                state.permissions = res.data['permissions'];
                state.loaded = true;
            })
        },

        login(state,provider){
            if(provider === undefined){
                router.push({"name":"login"});
            }else{
                window.location = "/app/login/" + provider
            }
        },
        can(state,perm){
            if(this.state.permissions["*"]){
                return true;
            }
            return this.state.permissions[perm]
        },
        logout(state) {
            state.loaded=false
            axios.post("/logout/").then(res => {
                this.fetch();
            })
        }
    },
})
export default session;

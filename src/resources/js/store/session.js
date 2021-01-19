import {reactive} from 'vue'
import axios from "axios";
import router from '../router'
const session = {
    state: reactive({
        loaded: false,
        authenticated: false,
        user: {
            id: null,
            username: null,
            steamid: null,
            avatar: null
        },
        permissions: {}
    }),
    fetch() {
        axios.get("/app/user").then(res => {
            this.state.authenticated = res.data['user'] !== null;
            if (this.state.authenticated) {
                this.state.user = res.data['user'];
            } else {
                this.state.user = null;
            }
            this.state.permissions = res.data['permissions'];
            this.state.loaded = true;
        })
    },
    logout() {
        this.state.loaded=false
        axios.post("/logout/").then(res => {
            this.fetch();
        })
    },
    login(provider){
        if(provider === undefined){
            router.push({"name":"login"});
        }else{
            window.location = "/app/login/" + provider
        }
    },
    can(perm){
        return this.state.permissions[perm]
    }
}

export default session;

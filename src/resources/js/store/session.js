import {reactive} from 'vue'
import axios from "axios";

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
        axios.get("/user").then(res => {
            this.state.authenticated = res.data[0] !== null;
            if (this.state.authenticated) {
                this.state.user = res.data[0];
            } else {
                this.state.user = null;
            }
            this.state.permissions = res.data[1];
            this.state.loaded = true;
        })
    },
    logout() {
        this.state.loaded=false
        axios.post("/logout/").then(res => {
            this.fetch();
        })
    },
}

export default session;

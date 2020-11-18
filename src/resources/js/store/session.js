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
            this.state.authenticated = res.data !== "";
            if (this.state.authenticated) {
                this.state.user = res.data[0];
                this.state.permissions = res.data[1];
            } else {
                this.state.user = null;
                this.state.permissions = null;
            }
            this.state.loaded = true;
        })
    },
    logout() {
        axios.post("/logout/").then(res => {
            this.fetch();
        })
    },
    can(perm) {
        if (this.state.permissions.includes("*")) {
            return true
        }
        return this.state.permissions.includes(perm);
    }
}

export default session;

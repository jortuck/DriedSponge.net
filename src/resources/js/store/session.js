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
    }),
    fetch() {
        axios.get("/user").then(res => {
            this.state.authenticated = res.data !== "";
            if (this.state.authenticated) {
                this.state.user = res.data;
            }
            this.state.loaded = true;
        })
    },
}

export default session;

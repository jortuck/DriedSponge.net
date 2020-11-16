import {reactive} from 'vue'
import axios from "axios";

const Auth = {
    state: reactive({
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
        })
    },
}

export default Auth;

import {useToast} from "vue-toastification";

const httpError = (error) => {
    if (error.response) {
        switch (error.response.status) {
            case 404:
                useToast().error("Resource not found (404).")
                break
            case 401:
                useToast().error("Unauthenticated (401).")
                break
            case 403:
                useToast().error("Unauthorized (403).")
                break;
            default:
                useToast().error("Something went wrong on the server side! Plese try again later ("+error.response.status+").")
                break;

        }
    }
}
export default httpError;

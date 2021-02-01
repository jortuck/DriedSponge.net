<template>
    <div class="loading-cover-dark" v-if="loading" data-aos="fade-in">
        <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
    </div>
    <div v-else-if="notfound" class="has-text-centered">
        <h1 class="title mb-6">No Alert To Edit</h1>
    </div>
    <form @submit="submit" v-else>
        <div class="columns">
            <div class="column">
                    <Textarea rows="5" placeholder="A nice message" label="Message" :required="true"
                              v-model:val="form.fields.message" v-model:error="form.errors['message']"
                             ></Textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Checkbox label="Display On Website" v-model:val="form.fields.website" />
            </div>
        </div>
        <div class="control">
            <button class="button is-primary" :class="{'is-loading':form.loading}">Save</button>
        </div>
    </form>
</template>

<script>
import Textarea from "../../../../components/form/Textarea";
import axios from "axios";
import session from "../../../../store/session";
import Icon from "../../../../components/text/Icon";
import Checkbox from "../../../../components/form/Checkbox";
import {toast} from "../../../../components/helpers/toasts";
export default {
    name: "Edit",
    components: {Checkbox, Textarea,Icon},
    data() {
        return {
            error: "Something went wrong.",
            loading: true,
            notfound: false,
            form: {
                submitted: false,
                submitted_msg: "",
                loading: false,
                errors: [],
                fields:{
                    website: 0,
                    message: "",
                }
            }
        }
    },
    mounted() {
        axios.get("/app/manage/alerts/" + this.$route.params.id).then(res => {
            this.form.fields.message = res.data.message
            this.form.fields.website = res.data.onsite
            this.loading = false
        })
        .catch(err => {
            this.loading = false
            switch (err.response.status){
                case 404:
                    this.loading = false
                    this.notfound= true
                    break
                case 403:
                    toast("toast-is-danger","Permission Denied")
                    break
                case 401:
                    toast("toast-is-danger","Permission Denied (Login)")
                    break
                default:
                    toast("toast-is-danger","Something went wrong! Please try again later")
                    break
            }
        })
    },
    methods: {
        removeErr(thing) {
            this.form.errors[thing] = "";
        },
        submit(e) {
            e.preventDefault();
            this.form.loading = true;
            axios.put('/app/manage/alerts/'+ this.$route.params.id, this.form.fields).then(res => {
                this.form.loading = false;
                this.form.submitted = true;
                this.form.submitted_msg = res.data['success'];
                toast("toast-is-success","The alert has been updated!")
            })
            .catch(err =>{
                this.form.loading = false;
                switch (err.response.status){
                    case 400:
                        for (var field in err.response.data) {
                            this.form.errors[field] = err.response.data[field][0];
                        }
                        break
                    case 403:
                        toast("toast-is-danger","Permission Denied")
                        break
                    case 401:
                        toast("toast-is-danger","Permission Denied (Login)")
                        break
                    default:
                        toast("toast-is-danger","Something went wrong! Please try again later")
                        break
                }
            })
        },
    }
}
</script>

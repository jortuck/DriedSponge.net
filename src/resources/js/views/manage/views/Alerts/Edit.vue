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
            <button class="button is-primary" :class="{'is-loading':form.loading}">
                <Icon icon="fa fa-save" />
                <span>Save</span>
            </button>
        </div>
    </form>
</template>

<script>
import Textarea from "../../../../components/form/Textarea";
import axios from "axios";
import session from "../../../../store/session";
import Icon from "../../../../components/text/Icon";
import Checkbox from "../../../../components/form/Checkbox";
import httpError from "../../../../components/helpers/httpError";
import {POSITION, useToast} from "vue-toastification";

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
            if(err.response.status ===404){
                this.notfound= true
            }else{
                httpError(err);
            }
        })
    },
    methods: {
        removeErr(thing) {
            this.form.errors[thing] = "";
        },
        submit(e) {
            e.preventDefault();
            for(var i in this.form.fields){
                if(this.form.errors[i] != null && this.form.errors[i] !== "" && this.form.errors[i] !== undefined){
                    return useToast().error("You still have some errors fix on the form.")
                }
            }
            this.form.loading = true;
            axios.put('/app/manage/alerts/'+ this.$route.params.id, this.form.fields).then(res => {
                this.form.loading = false;
                this.form.submitted = true;
                this.form.submitted_msg = res.data['success'];
                useToast().success("The alert has been updated!")
            })
            .catch(err =>{
                this.form.loading = false;
                if(err.response.status ===400){
                    for (var field in err.response.data) {
                        this.form.errors[field] = err.response.data[field][0];
                    }
                }else{
                    httpError(err);
                }
            })
        },
    }
}
</script>

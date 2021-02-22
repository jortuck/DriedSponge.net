<template>
    <form @submit="submit">
        <div class="columns">
            <div class="column">
                    <Textarea maxCharacters="1120" rows="5" placeholder="A nice message" label="Message"
                              v-model:val="form.fields.message" v-model:error="form.errors['message']" :required="true"></Textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Checkbox label="Post On Discord" v-model:val="form.fields.discord" />
            </div>
            <div class="column">
                <Checkbox label="Post On Twitter" v-model:val="form.fields.twitter" />
            </div>
            <div class="column">
                <Checkbox label="Post On Website" v-model:val="form.fields.website" />
            </div>
        </div>
        <div class="control">
            <button class="button is-primary" :class="{'is-loading':form.loading}">
                <Icon icon="fas fa-share-square" />
                <span>Post</span>
            </button>
        </div>
    </form>
</template>
<script>
import Textinput from "../../../../components/form/Textinput";
import Textarea from "../../../../components/form/Textarea";
import axios from "axios";
import Checkbox from "../../../../components/form/Checkbox";
import Icon from "../../../../components/text/Icon";
import httpError from "../../../../components/helpers/httpError";
import {POSITION, useToast} from "vue-toastification";

export default {
    name: "Create",
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
            axios.post('/app/manage/alerts', this.form.fields).then(res => {
                this.form.loading = false;
                this.form.submitted = true;
                this.form.fields.discord = false;
                this.form.fields.twitter = false;
                this.form.fields.website = false;
                this.form.fields.message = "";
                useToast().success(res.data['success']);
            })
            .catch(err =>{
                this.form.loading = false;
                if(err.response.status === 400){
                    for (var field in err.response.data) {
                        this.form.errors[field] = err.response.data[field][0];
                    }
                }else{
                    httpError(err)
                }
            })
        },
    },
    components: {Icon, Checkbox, Textinput, Textarea},
    data() {
        return {
            error: "Something went wrong.",
            form: {
                submitted: false,
                submitted_msg: "",
                loading: false,
                errors: [],
                fields:{
                    discord: false,
                    twitter: false,
                    website: false,
                    message: ""
                }
            }
        }
    },

}
</script>


<template>
    <Pagehead class="mb-6" sub_header="Is there something I can do for you, or do you just have a general inquiry? Fill out the form below!"><span class="has-text-primary">CONTACT</span> ME</Pagehead>
    <Tileancestor v-if="form.submitted" data-aos="fade-in">
        <div class="tile is-parent">
            <article class="tile is-child notification is-success has-text-centered box">
                <div class="content">
                    <p class="title">Amazing Job!</p>
                    <p class="subtitle">{{ form.submitted_msg }}</p>
                    <div class="content">
                        <button @click="reset" class="button is-light is-outlined">Submit Another Response</button>
                    </div>
                </div>
            </article>
        </div>
    </Tileancestor>
    <Tileancestor v-else data-aos="fade-up">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <form @submit="submit">
                    <div class="columns">
                        <div class="column is-half-desktop is-full-mobile">
                            <Textinput icon="fas fa-signature" maxCharacters="150" v-model:val="form.fields.name" label="Name"
                                       placeholder="John Doe"
                                       v-model:error="form.errors['name']" :required="true"/>
                        </div>
                        <div class="column is-half-desktop is-full-mobile">
                            <Textinput  icon="fas fa-envelope" maxCharacters="150" v-model:val="form.fields.email" label="Email"
                                       placeholder="email@example.com" v-model:error="form.errors['email']" :required="true"/>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <Textinput maxCharacters="256" @change="removeErr('subject')" v-model:val="form.fields.subject" label="Subject"
                                       placeholder="Some interesting subject..." v-model:error="form.errors['subject']" :required="true"/>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                    <Textarea maxCharacters="2000" rows="5" placeholder="A nice message" label="Message"
                              v-model:val="form.fields.message" v-model:error="form.errors['message']" :required="true"></Textarea>
                        </div>
                    </div>
                    <div class="control">
                        <button class="button is-primary" :class="{'is-loading':form.loading}">
                            <Icon icon="fas fa-paper-plane" />
                            <span>Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Tileancestor>
</template>

<script>
import axios from "axios";
import Textinput from "../form/Textinput";
import Textarea from "../form/Textarea";
import Captcha from "../form/Captcha";
import Tileancestor from "../tiles/Tileancestor";
import Pagehead from "../includes/Pagehead";
import Icon from "../text/Icon";
import {useToast} from "vue-toastification";
import httpError from "../helpers/httpError"
export default {
    name: "Contactform",
    components: {Icon, Pagehead, Textinput, Textarea, Captcha, Tileancestor},
    data() {
        return {
            error: "Something went wrong.",
            form: {
                submitted: false,
                submitted_msg: "",
                loading: false,
                errors: [],
                fields:{
                    name: "",
                    email: "",
                    subject: "",
                    message: "",
                },

            }
        }
    },
    methods: {
        submit(e) {
            e.preventDefault();
            for(var i in this.form.fields){
                if(this.form.errors[i] != null && this.form.errors[i] !== "" && this.form.errors[i] !== undefined){
                    return useToast().error("You still have some errors fix on the form.")
                }
            }
            this.form.loading = true;
            axios.post('/app/contact/send', this.form.fields).then(res => {
                this.form.loading = false;
                this.form.submitted = true;
                this.form.submitted_msg = res.data['success'];
            })
            .catch(err =>{
                this.form.loading = false;
                switch (err.response.status){
                    case 400:
                        for (var error in err.response.data) {
                            this.form.errors[error] = err.response.data[error][0];
                        }
                        break;
                    default:
                        httpError(err)
                        break;
                }
            })
        },
        removeErr(thing) {
            this.form.errors[thing] = "";
        },
        reset() {
            this.form.submitted = false;
            this.form.errors = [];
            this.form.fields.name = ""
            this.form.fields.email = ""
            this.form.fields.subject = ""
            this.form.fields.message = ""
        }
    },
}
</script>

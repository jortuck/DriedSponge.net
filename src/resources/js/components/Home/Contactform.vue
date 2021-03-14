<template>
    <Pagehead data-aos="fade-up" class="mb-6" sub_header="Is there something I can do for you, or do you just have a general inquiry? Fill out the form below!"><span class="has-text-primary">CONTACT</span> ME</Pagehead>
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
                <form @submit.prevent="submit" id="contact">
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
                    <div class="control" data-aos="fade-in" v-show="this.form.fields.captcha && !form.errors['captcha']">
                        <button class="button is-primary" :class="{'is-loading':form.loading}">
                            <Icon icon="fas fa-paper-plane" />
                            <span>Submit</span>
                        </button>
                    </div>
                    <div class="control" data-aos="fade-in" v-show="!this.form.fields.captcha || form.errors['captcha']">
                        <hcaptcha v-on:rendered="rendered" class="captcha" ref="captcha" @verify="captchaSolved" @expired="expired" sitekey="12e5c4f8-2eb4-4d27-8a5d-7c94c633b11a"></hcaptcha>
                        <p class="help is-danger has-text-weight-bold" v-if="form.errors['captcha']">{{form.errors['captcha']}}</p>
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
import Hcaptcha from "../form/hcpatcha/hcaptcha";
export default {
    name: "Contactform",
    components: {Hcaptcha, Icon, Pagehead, Textinput, Textarea, Captcha, Tileancestor},
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
                    captcha:null,

                },
            }
        }
    },
    methods: {
        submit(e) {
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
                if(err.response.status === 400){
                    if(err.response.data['captcha']){
                        this.$refs.captcha.reset();
                    }
                    for (var error in err.response.data) {
                        this.form.errors[error] = err.response.data[error][0];
                    }
                }else{
                    httpError(err)
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
            this.form.fields.captcha = ""
        },
        captchaSolved(token){
            this.form.fields.captcha = token
            this.form.errors['captcha'] = null
        },
        expired(){
            this.form.fields.captcha = null
            useToast().error("The captcha expired. Please complete it again!")
            this.form.errors['captcha'] = "Captcha expired. Please complete it again."
        },
        rendered(){
            console.log("capthca renderd")
        }
    },
}
</script>

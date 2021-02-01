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
                            <Textinput maxCharacters="150" @change="removeErr('name')" v-model:val="form.name.value" label="Name"
                                       placeholder="John Doe"
                                       :error="form.errors['name']"/>
                        </div>
                        <div class="column is-half-desktop is-full-mobile">
                            <Textinput  maxCharacters="150" @change="removeErr('email')" v-model:val="form.email.value" label="Email"
                                       placeholder="email@example.com" :error="form.errors['email']"/>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <Textinput  maxCharacters="256" @change="removeErr('subject')" v-model:val="form.subject.value" label="Subject"
                                       placeholder="Some interesting subject..." :error="form.errors['subject']"/>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                    <Textarea maxCharacters="2000" @change="removeErr('message')" rows="5" placeholder="A nice message" label="Message"
                              v-model:val="form.message.value" :error="form.errors['message']"></Textarea>
                        </div>
                    </div>
                    <div class="control">
                        <button class="button is-primary" :class="{'is-loading':form.loading}">Submit</button>
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
import {toast} from "../helpers/toasts"
export default {
    name: "Contactform",
    components: {Pagehead, Textinput, Textarea, Captcha, Tileancestor},
    data() {
        return {
            error: "Something went wrong.",
            form: {
                submitted: false,
                submitted_msg: "",
                loading: false,
                errors: [],
                name: {
                    value: "",
                },
                email: {
                    value: "",
                },
                subject: {
                    value: "",
                },
                message: {
                    value: "",
                },
                captcha: "robot"
            }
        }
    },
    methods: {
        submit(e) {
            e.preventDefault();
            this.form.loading = true;
            axios.post('/app/contact/send', {
                name: this.form.name.value,
                email: this.form.email.value,
                subject: this.form.subject.value,
                message: this.form.message.value
            }).then(res => {
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
                        toast("toast-is-danger","Something went wrong on the server side! Plese try again later.")
                }
            })
        },
        removeErr(thing) {
            this.form.errors[thing] = "";
        },
        reset() {
            this.form.submitted = false;
            this.form.email.value = "";
            this.form.subject.value = "";
            this.form.message.value = "";
            this.form.errors = [];
        }
    },
}
</script>

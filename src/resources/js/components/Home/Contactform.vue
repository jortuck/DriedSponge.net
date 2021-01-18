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
                            <Textinput @change="removeErr('name')" v-model="form.name.value" label="Name"
                                       placeholder="John Doe"
                                       :error="form.errors['name']"/>
                        </div>
                        <div class="column is-half-desktop is-full-mobile">
                            <Textinput @change="removeErr('email')" v-model="form.email.value" label="Email"
                                       placeholder="email@example.com" :error="form.errors['email']"/>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <Textinput @change="removeErr('subject')" v-model="form.subject.value" label="Subject"
                                       placeholder="Some interesting subject..." :error="form.errors['subject']"/>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                    <Textarea @change="removeErr('message')" rows="5" placeholder="A nice message" label="Message"
                              v-model="form.message.value" :error="form.errors['message']"></Textarea>
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
                if (res.data.success) {
                    this.form.submitted = true;
                    this.form.submitted_msg = res.data['success'];
                } else {
                    for (var error in res.data) {
                        this.form.errors[error] = res.data[error][0];
                    }
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

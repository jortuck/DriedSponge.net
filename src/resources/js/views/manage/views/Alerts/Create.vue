<template>
    <form @submit="submit">
        <div class="columns">
            <div class="column">
                    <Textarea  @change="removeErr('message')" rows="5" placeholder="A nice message" label="Message"
                              v-model="form.message.value" :error="form.errors['message']"></Textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <label class="checkbox">
                    <input type="checkbox" v-model="form.discord">
                    Post On Discord
                </label>
            </div>
            <div class="column">
                <label class="checkbox">
                    <input type="checkbox" v-model="form.twitter">
                    Post On Twitter
                </label>
            </div>
            <div class="column">
                <label class="checkbox">
                    <input type="checkbox" v-model="form.website">
                    Post On Website
                </label>
            </div>
        </div>
        <div class="control">
            <button class="button is-primary" :class="{'is-loading':form.loading}">Post</button>
        </div>
    </form>
</template>
<script>
import Textinput from "../../../../components/form/Textinput";
import Textarea from "../../../../components/form/Textarea";
import axios from "axios";

export default {
    name: "Create",
    methods: {
        removeErr(thing) {
            this.form.errors[thing] = "";
        },
        submit(e) {
            e.preventDefault();
            this.form.loading = true;
            axios.post('/app/manage/alerts', {
                discord: this.form.discord,
                twitter: this.form.twitter,
                message: this.form.message.value,
                website: this.form.website,
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
    },
    components: {Textinput, Textarea},
    data() {
        return {
            error: "Something went wrong.",
            form: {
                submitted: false,
                submitted_msg: "",
                loading: false,
                errors: [],
                discord: false,
                twitter: false,
                website: false,
                message: {
                    value: "",
                },
            }
        }
    },

}
</script>


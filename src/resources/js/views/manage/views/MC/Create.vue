<template>
    <form @submit.prevent="submit" ref="form">
        <div class="columns">
            <div class="column">
                <Textinput :maxCharacters="100" v-model:error="form.errors['name']" label="Server Name"
                           placeholder="DriedSponge Gaming" v-model:val="form.fields.name" :required="true"/>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Textinput v-model:error="form.errors['ip']" label="Server IP" placeholder="XX.XX.XX.XX"
                           v-model:val="form.fields.ip" :required="true" :maxCharacters="100"/>
            </div>
            <div class="column">
                <Textinput type="number" v-model:error="form.errors['port']" label="Server Port" placeholder="25565"
                           v-model:val="form.fields.port"/>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                    <Textarea maxCharacters="2000" rows="5" placeholder="A nice description" label="Server Description"
                              v-model:val="form.fields.description"
                              v-model:error="form.errors['description']"></Textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Checkbox label="Private Server" v-model:val="form.fields.private"
                          v-model:error="form.errors['private']"/>
            </div>
        </div>
        <div class="control">
            <button class="button is-primary" :class="{'is-loading':form.loading}">
                <Icon icon="fas fa-plus"/>
                <span>Add</span>
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
import {POSITION, useToast} from "vue-toastification";
import Token from  "../../../../components/text/Token"
import httpError from "../../../../components/helpers/httpError";
export default {
    name: "Create",
    methods: {
        removeErr(thing) {
            this.form.errors[thing] = "";
        },
        reset() {
            this.form.submitted = false;
            this.form.errors = [];
            this.form.fields.name = ""
            this.form.fields.ip = ""
            this.form.fields.port = 25565
            this.form.fields.description = ""
            this.form.fields.private = false
        },
        submit(e) {
            for (var i in this.form.fields) {
                if (this.form.errors[i] != null && this.form.errors[i] !== "" && this.form.errors[i] !== undefined) {
                    return useToast().error("Please fix the errors on the form.")
                }
            }
            axios.post('/app/manage/mc-servers', this.form.fields).then(res => {
                this.form.loading = false;
                this.form.submitted = true;
                this.form.submitted_msg = res.data['success'];
                this.reset();
                const content = {
                    component: Token,
                    props:{
                        token:  res.data['token'],
                        msg: res.data['success']
                    }
                }
                useToast().success(content,{timeout: 0, closeOnClick: false, draggable: false,})
            })
                .catch(err => {
                    this.form.loading = false;
                    switch (err.response.status) {
                        case 400:
                            for (var field in err.response.data) {
                                this.form.errors[field] = err.response.data[field][0];
                            }
                            break
                        default:
                            httpError(err)
                            break
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
                fields: {
                    "name": "",
                    "ip": "",
                    "port": 25565,
                    "description": "",
                    "private": false,
                }
            }
        }
    },

}
</script>


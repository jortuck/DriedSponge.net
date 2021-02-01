<template>
    <form @submit="submit" >
        <div class="columns">
            <div class="column">
                <Textinput :error="form.errors['name']" label="Server Name" placeholder="DriedSponge Gaming" v-model:val="form.name" @change="removeErr('name')"/>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Textinput :error="form.errors['ip']" label="Server IP" placeholder="XX.XX.XX.XX" v-model:val="form.ip" @change="removeErr('ip')"/>
            </div>
            <div class="column">
                <Textinput type="number" :error="form.errors['port']" label="Server Port" placeholder="25565" v-model:val="form.port" @change="removeErr('port')"/>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                    <Textarea maxCharacters="2000"  @change="removeErr('description')" rows="5" placeholder="A nice description" label="Server Description"
                               v-model:val="form.description" :error="form.errors['description']"></Textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <label class="checkbox">
                    <input v-model="form.private" type="checkbox">
                    Private Server
                </label>
            </div>
        </div>
        <div class="control">
            <button class="button is-primary" :class="{'is-loading':form.loading}">Add</button>
        </div>
    </form>
</template>
<script>
import Textinput from "../../../../components/form/Textinput";
import Textarea from "../../../../components/form/Textarea";
import axios from "axios";
import {toast} from "../../../../components/helpers/toasts";
export default {
    name: "Create",
    methods: {
        removeErr(thing) {
            this.form.errors[thing] = "";
        },
        reset(){
            this.form.submitted = false;
            this.form.errors= []
            this.form.name=""
            this.form.ip=""
            this.form.port=25565
            this.form.description=""
            this.form.private= false
        },
        submit(e) {
            e.preventDefault();
            this.form.loading = true;
            axios.post('/app/manage/mc-servers', {
                name: this.form.name,
                ip: this.form.ip,
                port: this.form.port,
                description: this.form.description,
                private: this.form.private,
            }).then(res => {
                this.form.loading = false;
                this.form.submitted = true;
                this.form.submitted_msg = res.data['success'];
                toast("toast-is-success",res.data['success'],-1)
                this.reset();
            })
            .catch(err=>{
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
                name:"",
                ip:"",
                port:25565,
                description:"",
                private: false,
            }
        }
    },

}
</script>


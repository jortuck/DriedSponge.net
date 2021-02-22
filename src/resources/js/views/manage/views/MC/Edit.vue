<template>
    <div class="loading-cover-dark" v-if="loading" data-aos="fade-in">
        <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
    </div>
    <div v-else-if="notfound" class="has-text-centered">
        <h1 class="title mb-6">No Alert To Edit</h1>
    </div>
    <form @submit.prevent="submit" v-else>
        <h1 class="title mb-4">Edit {{form.fields.name}}</h1>
        <div class="columns">
            <div class="column">
                <Textinput v-model:error="form.errors['name']" label="Server Name" placeholder="DriedSponge Gaming" v-model:val="form.fields.name" :required="true" :maxCharacters="100"/>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Textinput  v-model:error="form.errors['ip']" label="Server Name" placeholder="XX.XX.XX.XX" v-model:val="form.fields.ip" :required="true" :maxCharacters="100" />
            </div>
            <div class="column">
                <Textinput  v-model:error="form.errors['port']" label="Server Name" placeholder="25565" v-model:val="form.fields.port" />

            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Textarea maxCharacters="2000" rows="5" placeholder="A nice description" label="Server Description"
                              v-model:val="form.fields.description" v-model::error="form.errors['description']"></Textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <label class="checkbox">
                    <Checkbox label="Private Server" v-model:val="form.fields.private"/>
                </label>
            </div>
        </div>
        <div class="control buttons">
            <button class="button is-primary" :class="{'is-loading':form.loading}" type="submit">
                <Icon icon="fa fa-save" />
                <span>Save</span>
            </button>
            <button class="button is-danger" type="button" :class="{'is-loading':regenload}" @click="regen">
                <Icon icon="fas fa-sync-alt" />
                <span>Regenerate API Key</span>
            </button>
        </div>
    </form>
</template>

<script>
import Textarea from "../../../../components/form/Textarea";
import axios from "axios";
import Icon from "../../../../components/text/Icon";
import Textinput from "../../../../components/form/Textinput";
import Checkbox from "../../../../components/form/Checkbox";
import {useToast} from "vue-toastification";
import httpError from "../../../../components/helpers/httpError"
import Token from "../../../../components/text/Token";
export default {
    name: "Edit",
    components: {Checkbox, Textinput, Textarea,Icon},
    data() {
        return {
            error: "Something went wrong.",
            loading: true,
            notfound: false,
            regenload: false,
            form: {
                submitted: false,
                submitted_msg: "",
                loading: false,
                errors: [],
                fields:{
                    name:"",
                    ip:"",
                    port:25565,
                    description:"",
                    private: 0,
                }
            }
        }
    },
    mounted() {
        axios.get("/app/manage/mc-servers/" + this.$route.params.id).then(res => {
            this.loading = false
            this.form.fields = res.data
        })
        .catch(error => {
            if(error.response.status === 404){
                this.loading = false
                this.notfound= true
            }
        })
    },
    methods: {
        removeErr(thing) {
            this.form.errors[thing] = "";
        },
        submit(e) {
            this.form.loading = true;
            axios.put('/app/manage/mc-servers/'+ this.$route.params.id, this.form.fields).then(res => {
                this.form.loading = false
                this.form.submitted = true;
                useToast().success(res.data['success'])
            })
            .catch(err=>{
                this.form.loading = false
                switch (err.response.status){
                    case 400:
                        for (var error in err.response.data) {
                            this.form.errors[error] =err.response[error][0];
                        }
                        break;
                    case 404:
                        useToast().error("The resource you are trying to edit does not exist")
                        break;
                    default:
                        httpError(err)
                        break;
                }
            })
        },
        regen(){
            this.regenload=true;
            axios.patch('/app/manage/mc-servers/'+this.$route.params.id+'/key').then(res =>{
                const content = {
                    component: Token,
                    props:{
                        token:  res.data['token'],
                        msg: res.data['success']
                    }
                }
                useToast().success(content,{timeout: 0, closeOnClick: false, draggable: false,})
                this.regenload=false;
            })
            .catch(err=>{
                this.regenload=false;
                httpError(err)
            })
        },
    }


}
</script>

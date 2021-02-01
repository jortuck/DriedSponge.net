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
                <Textinput :error="form.errors['name']" label="Server Name" placeholder="DriedSponge Gaming" v-model:val="form.fields.name"  @change="removeErr('name')"/>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Textinput :error="form.errors['ip']" label="Server Name" placeholder="XX.XX.XX.XX" v-model:val="form.fields.ip" :internal="form.fields.ip" @change="removeErr('ip')"/>
            </div>
            <div class="column">
                <Textinput :error="form.errors['port']" label="Server Name" placeholder="25565" v-model:val="form.fields.port" :internal="form.fields.port" @change="removeErr('port')"/>

            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Textarea maxCharacters="2000"  @change="removeErr('description')" rows="5" placeholder="A nice description" label="Server Description"
                              v-model:val="form.fields.description" :error="form.errors['description']"></Textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <label class="checkbox">
                    <input type="checkbox" v-model="form.fields.private" :checked="form.fields.private">
                    Private Server
                </label>
            </div>
        </div>
        <div class="control">
            <button class="button is-primary" :class="{'is-loading':form.loading}">Save</button>
        </div>
    </form>
</template>

<script>
import Textarea from "../../../../components/form/Textarea";
import axios from "axios";
import session from "../../../../store/session";
import Icon from "../../../../components/text/Icon";
import Textinput from "../../../../components/form/Textinput";
export default {
    name: "Edit",
    components: {Textinput, Textarea,Icon},
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
            switch (error.response.status){
                case 404:
                    this.loading = false
                    this.notfound= true
                    break;
            }
        })
    },
    methods: {
        removeErr(thing) {
            this.form.errors[thing] = "";
        },
        submit(e) {
            e.preventDefault();
            this.form.loading = true;
            axios.put('/app/manage/alerts/'+ this.$route.params.id, {
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
    }


}
</script>

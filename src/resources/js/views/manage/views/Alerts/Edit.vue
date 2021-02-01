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
                    <Textarea @change="removeErr('message')" rows="5" placeholder="A nice message" label="Message"
                              v-model:val="form.message.value" :error="form.errors['message']"
                              :internal="form.message.value"></Textarea>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <label class="checkbox">
                    <input type="checkbox" v-model="form.website" :checked="form.website">
                    Display On Website
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
export default {
    name: "Edit",
    components: {Textarea,Icon},
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
                website: 0,
                message: {
                    value: "",
                },
            }
        }
    },
    mounted() {
        axios.get("/app/manage/alerts/" + this.$route.params.id).then(res => {
            this.form.message.value = res.data.message
            this.form.website = res.data.onsite === 1
            this.loading = false
        })
        .catch(error => {
            if(error.response.status ===404){
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

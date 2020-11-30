<template>
    <form @submit="submit" class="is-loading">
        <div class="columns">
            <div class="column is-half-desktop is-full-mobile">
                <Textinput @change="removeErr('name')" v-model="form.name.value" label="Name" placeholder="John Doe" :error="form.errors['name']" />
            </div>
            <div class="column is-half-desktop is-full-mobile">
                <Textinput @change="removeErr('email')" v-model="form.email.value" label="Email" placeholder="email@example.com" :error="form.errors['email']"/>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Textinput @change="removeErr('subject')" v-model="form.subject.value" label="Subject" placeholder="Some interesting subject..." :error="form.errors['subject']"/>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <Textarea @change="removeErr('message')" rows="5" placeholder="A nice message" label="Message" v-model="form.message.value" :error="form.errors['message']"></Textarea>
            </div>
        </div>
        <div class="control">
            <button :class="{'button':true,'is-primary':true,'is-loading':form.loading}">Submit</button>
        </div>
    </form>
</template>

<script>
import axios from "axios";
import Textinput from "../form/Textinput";
import Textarea from "../form/Textarea";
import Captcha from "../form/Captcha";
export default {
    name: "Contactform",
    components:{Textinput,Textarea, Captcha},
    data(){
        return{
            error: "Something went wrong.",
            form:{
                loading: false,
                errors:[],
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
                captcha:"robot"
            }
        }
    },
    methods:{
        submit(e){
            e.preventDefault();
            this.form.loading = true;
            axios.post('/contact/send',{
                name: this.form.name.value,
                email: this.form.email.value,
                subject: this.form.subject.value,
                message: this.form.message.value
            }).then(res => {
                this.form.loading = false;
                console.log(res.data);
                if(res.data.success){

                }else{
                    for (var error in res.data){
                        this.form.errors[error] = res.data[error][0];
                    }
                }
            })
        },
        removeErr(thing){
            this.form.errors[thing] = "";
        },
    },
}
</script>

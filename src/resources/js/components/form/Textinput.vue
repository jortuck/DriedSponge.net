<template>
    <div class="field">
        <label class="label">{{ label }}</label>
        <div class="control" :class="{'has-icons-right': error, 'has-icons-left':icon}">

            <input @focusout="updateValue" @input="updateValue"
                   :maxlength="maxCharacters > 0 ? maxCharacters:null"
                   :class="{'is-danger': error}"
                   :type="type"
                   :placeholder="placeholder"
                   :value="val"
                   class="input"
                   >
            <span v-if="error" class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
            <Icon :icon="icon" class="is-small is-left" v-if="icon" />

        </div>
        <p class="help is-danger is-bold" v-if="error">{{ error }}</p>
    </div>
</template>
<script>
import Icon from "../text/Icon";
export default {
    name: "Textinput",
    components: {Icon},
    props: {
        label: {
            required: true,
            type: String
        },
        placeholder: {
            required: false,
            type: String
        },
        error: {
            required: false,
            type: String
        },
        type:{
            required: false,
            default: "text",
            type: String
        },
        maxCharacters:{
            required:false,
            default: 0,
        },
        val:{
            required: false,
        },
        required:{
            type: Boolean,
            required: false,
            default:false
        },
        icon:{
            type: String,
            required: false
        }

    },
    emits: ['update:val','update:error','update:invalid'],
    methods: {
        updateValue(e) {
            this.charCount = e.target.value.length;
            this.$emit("update:val",e.target.value)
            if(this.required && e.target.value.length === 0){
                this.$emit('update:error', "The "+this.label.toLowerCase()+" field is required!")
            }else if(this.maxCharacters > 0 && this.charCount > this.maxCharacters){
                this.$emit('update:error', "Please reduce the length of text in this field!")
            }else{
                this.$emit('update:error', null)
            }

        },
    },
    data(){
        return{
            charCount:0,
        }
    },
}
</script>

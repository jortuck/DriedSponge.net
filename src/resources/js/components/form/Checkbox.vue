<template>
    <label class="checkbox">
        <input :checked="val" type="checkbox" @input="updateValue">
        {{ label }}
    </label>
    <p class="help is-danger is-bold">{{ error }}</p>
</template>
<script>
export default {
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
        val:{
            required: false,
        },
        required:{
            default: false,
            type:Boolean
        }
    },
    name: "Checkbox",
    emits:['update:val','update:error'],
    methods:{
        updateValue(e){
            this.$emit('update:val',e.target.checked)
            if(this.required  && !e.target.checked){
                this.$emit('update:error',"This value must be checked!")
            }else{
                this.$emit('update:error',null)
            }
        }
    }

}
</script>

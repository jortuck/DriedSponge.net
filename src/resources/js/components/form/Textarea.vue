<template>
    <div class="field">
        <label class="label">{{ label }}</label>
        <div :class="{'control':true,'has-icons-right': error}">
            <textarea @input="updateValue"
                      :maxlength="maxCharacters > 0 ? maxCharacters:null"
                      class="textarea input"
                      :class="{'is-danger': error}"
                      :placeholder="placeholder"
                      :rows="rows">{{val}}</textarea>
            <span v-if="error" class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
        </div>
        <p class="help is-danger is-bold" v-if="error">{{ error }}</p>
        <p class="help is-bold" v-if="maxCharacters">{{charCount }}/{{maxCharacters}}</p>
    </div>
</template>

<script>
export default {
    name: "Textarea",
    props: {
        val: {
            required: false,
        },
        rows: {
            required: false,
            default: "5"
        },
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
        maxCharacters:{
            required:false,
            default: 0,
        }
    },
    emits: ['update:val','change'],
    methods: {
        updateValue(e) {
            this.$emit('update:val', e.target.value)
            this.$emit('change')
            this.charCount = e.target.value.length;
        },
    },
    data(){
        return{
            charCount:0
        }
    },
}
</script>

<style scoped>

</style>

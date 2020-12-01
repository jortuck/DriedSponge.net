<template>
    <div class="field">
        <label class="label">{{ label }}</label>
        <div :class="{'control':true,'has-icons-right': error}">
            <input :class="{'is-danger': error, 'input':true}" :type="type" :placeholder="placeholder"
                   @change="updateValue">
            <span v-if="error" class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
        </div>
        <p class="help is-danger is-bold" v-if="error">{{ error }}</p>
    </div>
</template>
<script>
export default {
    name: "Textinput",
    props: {
        modelValue: {
            required: false,
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
        type:{
            required: false,
            default: "text",
            type: String
        }
    },
    emits: ['update:modelValue','change'],
    methods: {
        updateValue(e) {
            this.$emit('update:modelValue', e.target.value)
            this.$emit('change')
        },
    }
}
</script>

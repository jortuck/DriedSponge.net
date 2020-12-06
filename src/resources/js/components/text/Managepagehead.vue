<template>
    <div class="container my-1 has-text-centered-mobile">
        <h1 class="title">
            <slot></slot>
            {{ header }}
        </h1>
        <h2 class="subtitle mt-2" v-if="sub_header">{{ sub_header }}</h2>
    </div>
</template>
<script>
export default {
    name: "Managepagehead",
    props: {
        header: {
            type: String,
            required: false,
            default: null,
        },
        sub_header: {
            type: String,
            required: false,
            default: null,
        },
    }
}
</script>

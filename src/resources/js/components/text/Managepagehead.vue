<template>
    <div class="container is-1 my-6 has-text-centered-mobile" data-aos="fade-right">
        <h1 class="title has-text-white is-2">
            <slot></slot>
            {{ header }}
        </h1>
        <h2 class="subtitle mt-2" v-if="sub_header">{{ sub_header }}</h2>
    </div>
</template>
<script>
export default {
    name: "Managepagehead"
}
</script>

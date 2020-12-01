<template>
    <div class="tile is-4 is-vertical">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <h1 class="title mb-3">{{ heading }}</h1>
                <div class="content is-medium">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Homecard",
    props:{
        heading:{
            required: true,
            type: String
        }
    }
}
</script>

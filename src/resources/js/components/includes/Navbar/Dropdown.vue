<template>
    <div class="has-dropdown navbar-item" :class="{'is-clicked':click,'is-hoverable':!click,'is-active':click&&state.showDropDown}">
        <a class="navbar-link" @click="toggleDrop">
            {{ text }}
        </a>
        <div class="navbar-dropdown is-right is-boxed">
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    name: "Navdropdown",
    data() {
        return {
            state:{
                showDropDown: false,
            }
        }
    },
    props:{
        text:{
            type: String,
            required: true,
        },
        click:{
            type: Boolean,
            default: false,
            required: false
        }
    },
    methods: {
        toggleDrop(){
            this.state.showDropDown = !this.state.showDropDown;
        }
    },

}
</script>

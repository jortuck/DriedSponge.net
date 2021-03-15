<template>
    <Managebox heder="Contact Form Responses">
        <router-view></router-view>
    </Managebox>
</template>
<script>
import Tileancestor from "../../../../components/tiles/Tileancestor";
import Managebox from "../../../../components/box/Managebox";

export default {
    name: "Contactform",
    components: {Managebox, Tileancestor},
}
</script>

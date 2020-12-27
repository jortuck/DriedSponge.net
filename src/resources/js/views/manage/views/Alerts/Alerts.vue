<template>
    <section class="section">
        <div class="container">
            <div class="box" data-aos="fade-up">
                <Managepagehead>
                    Alerts
                </Managepagehead>
                <br>
                <router-view></router-view>
            </div>
        </div>
    </section>
</template>
<script>
import Managepagehead from "../../../../components/text/Managepagehead";
import Tileancestor from "../../../../components/tiles/Tileancestor";
import axios from "axios";
export default {
    name: "Alerts",
    components: {Tileancestor, Managepagehead},
}
</script>

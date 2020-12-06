<template>
    <section class="section">
        <div class="container">
            <div class="box" data-aos="fade-up">
                <Managepagehead>
                    Contact Form Responses
                </Managepagehead>
                <br>
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date Sent</th>
                            <th>View Message</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>
<script>
import Managepagehead from "../../../../components/text/Managepagehead";
import Tileancestor from "../../../../components/tiles/Tileancestor";
import axios from "axios";
export default {
    name: "Contactform",
    components: {Tileancestor, Managepagehead},
    data(){
        return{
            state:{
                page: 1,
                currentData: {},
            },
        }
    },
    beforeMount(){
        this.fetch();
    },
    methods:{
        fetch(){
            axios.get("/contact-form/get",{params:{"page":this.state.page}}).then(res => {
                console.log("test")
            })
        }
    }
}
</script>

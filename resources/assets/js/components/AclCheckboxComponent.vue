<template>
    <a href="javascript:void(0)" v-on:click="toogleCheckbox()">
        
        <span v-if="loading == true">
            <i class="fa fa-spinner fa-spin"></i>
        </span>

        <span v-else>
            <i v-if="checkboxStatus == false" class="fa fa-toggle-off"></i>
            <i v-else class="fa fa-toggle-on"></i>
        </span>
    
    </a>
        
</template>

<script>
    export default {
        props: ['index', 'page'],
        data () {
            return {
                checkboxStatus: false,
                save: {
                    page: "",
                    email: "",
                    permission: false
                },
                loading: true
            }
        },
        mounted (){
            this.setUser();
            let data = {
                 email: this.$root.list[this.index].email,
                 page: this.page
            };
            // axios.post('/acl/get', data).then((res)=>{
            //     let perm = false;
            //     if (res.data[0]) {
            //         perm = res.data[0].permission;
            //     }
            //     this.checkboxStatus = perm;
            //     this.save.permission = perm;
            //     this.loading = false;
            // });
        },
        methods: {
            toogleCheckbox () {
                this.checkboxStatus = !this.checkboxStatus;
                this.setUser();
                this.saveACL();
            },
            setUser () {
                this.save.email = this.$root.list[this.index].email;
                this.save.page = this.page;
                this.save.permission = !this.save.permission;
            },
            saveACL () {
                axios.post('/acl/save', this.save);
            }
        }
    }
</script>

<style scoped>
    a {
        color: #FFF;
    }
</style>
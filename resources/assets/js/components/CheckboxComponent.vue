<template>
    <a href="javascript:void(0)" v-on:click="toogleCheckbox()">
        <i v-if="checkboxStatus == false" class="fa fa-toggle-off"></i>
        <i v-else class="fa fa-toggle-on"></i>
    </a>
</template>

<script>
    export default {
        props: ['index'],
        data () {
            return {
                checkboxStatus: false
            }
        },
        mounted (){
            this.checkStatus();
        },
        methods: {
            toogleCheckbox () {
                let text = 'Realmente deseja modificar a configuração para recepção de notificações no servidor?';
                swal({
                    title: 'Tem certeza?',
                    text: text,
                    icon: 'warning',
                    buttons: {
                        cancel: "Não",
                        confirm: "Sim"
                    }
                }).then((willDelete)=>{
                    if (willDelete) {
                        this.checkboxStatus = !this.checkboxStatus;
                        this.$root.form.notify_receive = this.checkboxStatus;
                        this.saveStatus();
                    }
                });                
            },
            saveStatus () {
                this.$root.saveStatus(this.index);
            },
            checkStatus () {
                if ( this.$root.list[this.index] && this.$root.list[this.index].notify_receive == true ) {
                    this.checkboxStatus = true;
                }
                if ( this.modal_value == true ) {
                    this.checkboxStatus = true;
                }
            }
        }
    }
</script>
<template>


    <div class="modal fade" :id="id || 'modalForm'" tabindex="-1" role="dialog">

        <div class="modal-dialog modal-dialog-centered" :class="size" role="document">
            <div class="modal-content" id="dc_modal_content">

                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 class="modal-title" v-html="title"></h4>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <slot></slot>
                </div>

                <div class="modal-footer" v-show="this.$root.saving == null">
                    <button type="button" @click="save()" class="btn btn-primary">Salvar</button>
                </div>
                <div class="sz_loading"></div>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        props: ['title', 'data', 'size', 'id'],
        data() {
            return {}
        },
        methods: {
            save() {
                this.$emit("submit", this.data);
            }
        }
    }
</script>

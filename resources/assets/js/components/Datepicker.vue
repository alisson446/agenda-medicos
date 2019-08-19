<template>
    <date-pick v-model="date"
               :value="date"
               displayFormat="DD/MM/YYYY"
               format="DD/MM/YYYY"
               :inputAttributes="attr"
               :nextMonthCaption="nextMonthCaption"
               :prevMonthCaption="prevMonthCaption"
               :weekdays="weekdays"
               :months="months">
    </date-pick>
</template>

<script>
    import DatePick from 'vue-date-pick';
    import 'vue-date-pick/dist/vueDatePick.css';

    export default {
        name: "datepicker",
        components: {DatePick},
        props: ['nameValidate', 'placeholder', 'value'],
        data() {
            return {
                date: "",
                nextMonthCaption: "Próximo mês",
                prevMonthCaption: "Mês anterior",
                attr: {
                    readonly: false,
                    name: this.nameValidate,
                    placeholder: this.placeholder
                }
            }
        },
        computed: {
            weekdays() {
                return [
                    "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"
                ];
            },
            months() {
                return [
                    'Janeiro',
                    'Fevereiro',
                    'Março',
                    'Abril',
                    'Maio',
                    'Junho',
                    'Julho',
                    'Agosto',
                    'Setembro',
                    'Outubro',
                    'Novembro',
                    'Dezembro'
                ];
            }
        },
        watch: {
            value() {
                this.date = this.value;
            },
            date() {
                this.$emit("set", this.date);
            }
        }
    }
</script>

<style>
    .vdpComponent {
        display: flex;
        font-size: 13px !important;

    }

    .vdpComponent.vdpWithInput > input {
        padding: 5px !important;
        width: 100% !important;
    }

    .vdpArrowPrev:after {
        border-right-color: #2185d0;
    }

    .vdpArrowNext:after {
        border-left-color: #2185d0;
    }

    .vdpCell {
        padding: 0 !important;
    }

    .vdpHeadCell {
        padding: 0.1em !important;
    }

    .vdpCell.selectable:hover .vdpCellContent,
    .vdpCell.selected .vdpCellContent {
        background: #2185d0;
        color: #fff;
    }

    .vdpCell.today {
        color: #2185d0;
    }

    .vdpTimeUnit > input:hover,
    .vdpTimeUnit > input:focus {
        border-bottom-color: #2185d0;
    }
</style>
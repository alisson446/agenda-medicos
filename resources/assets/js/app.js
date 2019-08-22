/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import swal from 'sweetalert';

window.Vue = require('vue');
import VueTheMask from 'vue-the-mask'
import VeeValidate from 'vee-validate'
import Multiselect from 'vue-multiselect'
import VueMoney from 'v-money'

// register directive v-money and component <money>
Vue.use(VueTheMask);
Vue.use(VeeValidate);
Vue.use(VueMoney, {precision: 4})

const moment = require('moment')
require('moment/locale/pt-br')
Vue.use(require('vue-moment'), { moment });


Vue.component("datepicker", require('./components/Datepicker.vue'));
Vue.component("modal-component", require('./components/ModalComponent.vue'));
Vue.component('calendar-component', require('./components/CalendarComponent.vue'));
Vue.component("checkbox-component", require('./components/CheckboxComponent.vue'));
Vue.component("acl-checkbox-component", require('./components/AclCheckboxComponent.vue'));
Vue.component('multiselect', Multiselect)

$(window).on('load', function(){
    $(".dc_loader").fadeOut();

    //BacktopNbt
    $(".btn-backtop").on('click', function(){
        $("html, body").animate({scrollTop: '0px'});
    });

    //ViewBacktopButton
    $(window).on('scroll', function(evt){
        if ($("html, body")[0].scrollTop >= 210) {
            $(".btn-backtop").fadeIn(300);
        } else {
            $(".btn-backtop").fadeOut(300);
        }
    });

    //MoveBackTop BUttons
    $(document).on('keydown', function(key){
        if (key.keyCode === 16 && ($("html, body")[0].scrollTop >= 210)) {
            $(".btn-backtop").fadeOut(0);
        }
    });

    $(document).on('keyup', function(key){
        if (key.keyCode === 16 && ($("html, body")[0].scrollTop >= 210)) {
            $(".btn-backtop").fadeIn(0);
        }
    });

});


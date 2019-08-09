import mixins from "../../../assets/js/menuRules";
const app = new Vue({
    el:"#app",
    mixins:[mixins],
    mounted(){
        console.log("success");
    }
});
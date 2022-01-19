ELEMENT.locale(ELEMENT.lang.en)

new Vue({
    el : '#v_nav',
    methods:{
        navigateLogin: function() {
            // alert("hello world")
            window.location.href = "login"
        },
    }
})
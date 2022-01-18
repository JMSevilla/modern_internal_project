ELEMENT.locale(ELEMENT.lang.en)

new Vue({
    el : '#v_nav',
    methods:{
        navigateLogin: function() {
            window.location.href = "http://localhost/modern_web/views/" + " " + this.makeid(10) + "login_views"
        },
     makeid(length) {
            var result           = [];
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
              result.push(characters.charAt(Math.floor(Math.random() *
          charactersLength)));
           }
           return result.join('');
          }
    }
})
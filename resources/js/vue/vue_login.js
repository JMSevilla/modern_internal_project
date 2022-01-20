ELEMENT.locale(ELEMENT.lang.en)
import __constructJS from "../main.js"
new Vue({
    el : '#vue_signin',
    data: () => ({
        task : {
            email : '', password : '',
            triggerLogin: true
        },
        fullscreenLoading: false
    }),
    methods : {
        onlogin: function() {
            this.fullscreenLoading = true
            setTimeout(() => {
                __constructJS.signinRequest(this.task).then(r => {
                    const reader = JSON.parse(r)
                    if(reader.NOT_FOUND === 404){
                        this.fullscreenLoading = false
                        this.$notify.error({
                            title: 'Invalid',
                            message: 'Account not found',
                            offset: 100
                          });
                          return false
                    }
                })
            }, 3000)
        }
    }
})
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
                    __constructJS.ResponseConfiguration(r).then(__debounce => {
                        switch (__debounce[0].key) {
                          case 'NOTFOUND':
                          this.fullscreenLoading = false;
                          this.$notify.error({
                              title: 'Account Not Found',
                              message: 'The account you want to login was not found',
                              offset: 100
                          });
                            break;
                          case 'DEACTIVATED':
                          this.fullscreenLoading = false;
                          this.$notify.error({
                              title: 'Account Deactivated',
                              message: 'The account you want to login is currently deactivated',
                              offset: 100
                          });
                          break;
                          case 'ADMIN_SUCCESS':
                          this.fullscreenLoading = false;
                          this.$notify.success({
                              title: 'Successfully Login',
                              message: 'You have successfully login !',
                              offset: 100
                          });
                          break;
                          case 'INVALID_PASSWORD':
                          this.fullscreenLoading = false;
                          this.$notify.error({
                              title: 'Invalid Password',
                              message: 'The password you have entered was invalid',
                              offset: 100
                          });
                          break;
                          default:

                        }
                    })
                })
            }, 3000)
        }
    }
})

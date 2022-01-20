ELEMENT.locale(ELEMENT.lang.en)
import __constructJS from "../main.js"
new Vue({
    el : '#index_app',
    methods: {
        register: function() {
            this.dialogVisible = true;
            
        },
        onnavigateLogin(){
            alert("hello world")
        },
        onregister: function() {
            
            this.fullscreenLoading = true;
            setTimeout(() => {
                __constructJS.registrationRequest(this.task)
            .then(response => {
               let __debounce = JSON.parse(response)
               switch(true){
                   case __debounce[0].label == "emptyHanded":
                        this.fullscreenLoading = false;
                        this.dialogVisible = false;
                        this.$notify.error({
                            title: 'Empty',
                            message: 'Empty fields, please retry',
                            offset: 100
                          });
                          return false;
                   case __debounce[0].label == "mismatchPassword":
                        this.fullscreenLoading = false;
                        this.dialogVisible = false;
                        this.$notify.error({
                            title: 'Mismatch Password',
                            message: 'Your password does not match',
                            offset: 100
                        });
                        return false;  
                   case __debounce[0].label == "password8MaxLength":
                        this.fullscreenLoading = false;
                        this.dialogVisible = false;
                        this.$notify.error({
                            title: 'Password maximum of 8',
                            message: 'The password must be maximum of 8 characters',
                            offset: 100
                        });
                        return false; 
                   case __debounce.success_admin == 200:
                        this.fullscreenLoading = false;
                        this.dialogVisible = false;
                        //reset fields
                        this.$notify.success({
                            title: 'You can now login !',
                            dangerouslyUseHTMLString: true,
                            message: '<a class="btn btn-primary btn-sm" href="http://localhost/modern_project/modern_internal_project/login">Click here</a>'
                          });
                        return true;
                   case __debounce.exist_email == 505:
                        this.fullscreenLoading = false;
                        this.task.email = null;
                        this.$notify.error({
                            title: 'Invalid',
                            message: 'Email already exist',
                            offset: 100
                          });
                          return false;
                   case __debounce.success_user == 200:
                    this.fullscreenLoading = false;
                    this.dialogVisible = false;
                    //reset fields
                    this.$notify.success({
                        title: 'Well Done! ',
                        message: 'Kindly wait for the admin approval',
                        offset: 100
                      });
                    return true;
                   default:
                        return alert("Problem Encountered");
               }
            })
            }, 3000)
        },
        handleClose(done) {
            this.$confirm('Are you sure to close this Registration?')
              .then(_ => {
                done();
              })
              .catch(_ => {});
          }
    },
    data() {
        return {
            dialogVisible: false,
            fullscreenLoading: false,
            task: {
                firstname : null, 
                lastname : null, 
                email : null,
                address : null, roles : null, occupation : null, password :null, cpass: null, trigger: 1
            },
            Optionroles: [
            {
                label : 'test 1', value: 'test'
            }
            ],
            OptionOccupation : [{label : 'test occupation', value: 'test'}]

        }
    }
})
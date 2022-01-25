ELEMENT.locale(ELEMENT.lang.en)
import __constructJS from "../main.js"
// import JSONConfiguration from "../main.js";
new Vue({
    el : '#index_app',
    created() {
        this.getAllDepartment();
        this.getAlloccupation();
        // this.getServicesContent();
    },
    mounted(){
        this.tokenScanning();
    },
    methods: {
        tokenScanning: function(){
            __constructJS.tokenConfiguration().then(r => {
               __constructJS.ResponseConfiguration(r).then(__debounce => {
                   if(__debounce[0].key === 'admin_exist_token'){
                       window.location.href = 'http://localhost/modern_web/modern_internal_project/admin'
                   }
               })
            })
        },
        register: function() {
            this.dialogVisible = true;

        },
        getAllDepartment: function() {
            __constructJS.departmentConfiguration().then(res => {
                __constructJS.ResponseConfiguration(res).then(r => {
                   this.Optionroles = r[0];
                })
            })
        },
        getAlloccupation: function() {
            __constructJS.occupationConfigation().then(res => {
                __constructJS.ResponseConfiguration(res).then(r => {
                    this.OptionOccupation = r[0];
                })
            })
        },
        // getServicesContent: function() {
        //     __constructJS.servicescontentConfiguration().then(res => {
        //         console.log(res);
        //         __constructJS.ResponseConfiguration(res).then(r => {
        //
        //         })
        //     })
        // },
        onnavigateLogin(){
            alert("hello world")
        },
        onregister: function() {

            this.fullscreenLoading = true;
            setTimeout(() => {
                __constructJS.registrationRequest(this.task)
            .then(response => {
               __constructJS.ResponseConfiguration(response).then(__debounce => {
                   this.fullscreenLoading = false;
                    if(__debounce[0].key == "emptyHanded")
                        {
                            this.fullscreenLoading = false;
                            this.dialogVisible = false;
                            this.$notify.error({
                                title: 'Empty',
                                message: 'Empty fields, please retry',
                                offset: 100
                              });
                        }

                    else if(__debounce[0].key == "mismatchPassword")
                         {
                            this.fullscreenLoading = false;
                            this.dialogVisible = false;
                            this.$notify.error({
                                title: 'Mismatch Password',
                                message: 'Your password does not match',
                                offset: 100
                            });
                         }
                    else if(__debounce[0].key == "password8MaxLength")
                         {
                            this.fullscreenLoading = false;
                            this.dialogVisible = false;
                            this.$notify.error({
                                title: 'Password maximum of 8',
                                message: 'The password must be maximum of 8 characters',
                                offset: 100
                            });
                         }
                    else if (__debounce[0].key == "success_admin")
                         {
                            this.fullscreenLoading = false;
                            this.dialogVisible = false;
                            //reset fields
                            this.$notify.success({
                                title: 'You can now login !',
                                dangerouslyUseHTMLString: true,
                                message: '<a class="btn btn-primary btn-sm" href="http://localhost/modern_project/modern_internal_project/login">Click here</a>'
                              });
                         }
                    else if (__debounce[0].key == "exist_email")
                         {
                            this.fullscreenLoading = false;
                            this.task.email = null;
                            this.$notify.error({
                                title: 'Invalid',
                                message: 'Email already exist',
                                offset: 100
                              });
                         }
                    else if (__debounce[0].key == "success_user")
                     {
                        this.fullscreenLoading = false;
                        this.dialogVisible = false;
                        //reset fields
                        this.$notify.success({
                            title: 'Well Done! ',
                            message: 'Kindly wait for the admin approval',
                            offset: 100
                          });
                     }
                    else{
                          alert("Problem Encountered");
                    }

               })
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
            Optionroles: [],
            OptionOccupation : []

        }
    }
})

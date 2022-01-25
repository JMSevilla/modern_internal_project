ELEMENT.locale(ELEMENT.lang.en)
import __constructJS from "../../main.js"
new Vue({
    el : '#v_adduser',
    data : () => ({
        adduserObj : {
            firstname : '',
            lastname : '',
            roles : '',
            occupation : '',
            email : '',
            password : '',
            cpass : '',
            address : '',trigger: 1
        },
        Optionroles: [],
            OptionOccupation : [], fullscreenLoading: false,
        propPageSize : 5,
        propListArray : [],
        searchable : '',
        page : 5
    }),
    created() {
        this.getAllDepartment()
        this.getAlloccupation()
        this.callUserList()
    },
    computed : {
        pagedTableData(){
            if(this.searchable){
                return this.propListArray.filter((item)=>{
                    return this.searchable.toLowerCase().split(' ').every(v => item.firstname.toString().toLowerCase().includes(v))
                })
            }else{
                return this.propListArray.slice(this.propPageSize * this.page - this.propPageSize, this.propPageSize * this.page)
            }
        }
    },
    methods : {
        callUserList : function(){
            __constructJS.UserConfiguration().then(res => {
                let jsonbroke = JSON.parse(res)
                for(var x = 0; x < jsonbroke.length; x++){
                    this.propListArray = jsonbroke[x]
                }
                // __constructJS.ResponseConfiguration(res).then(__debounce => {
                //     this.propListArray = __debounce[0]
                //     console.log(__debounce[0])
                // })
            })
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
        onsave: function() {

            this.fullscreenLoading = true;
            setTimeout(() => {
                __constructJS.registrationRequest(this.adduserObj)
            .then(response => {
               __constructJS.ResponseConfiguration(response).then(__debounce => {
                   this.fullscreenLoading = false;
                    if(__debounce[0].key == "emptyHanded")
                        {
                            this.fullscreenLoading = false;
                            this.$notify.error({
                                title: 'Empty',
                                message: 'Empty fields, please retry',
                                offset: 100
                              });
                        }

                    else if(__debounce[0].key == "mismatchPassword")
                         {
                            this.fullscreenLoading = false;
                            this.$notify.error({
                                title: 'Mismatch Password',
                                message: 'Your password does not match',
                                offset: 100
                            });
                         }
                    else if(__debounce[0].key == "password8MaxLength")
                         {
                            this.fullscreenLoading = false;
                            this.$notify.error({
                                title: 'Password maximum of 8',
                                message: 'The password must be maximum of 8 characters',
                                offset: 100
                            });
                         }
                    else if (__debounce[0].key == "success_admin")
                         {
                            this.fullscreenLoading = false;
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
                            this.adduserObj.email = null;
                            this.$notify.error({
                                title: 'Invalid',
                                message: 'Email already exist',
                                offset: 100
                              });
                         }
                    else if (__debounce[0].key == "success_user")
                     {
                        this.fullscreenLoading = false;
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
    }
})
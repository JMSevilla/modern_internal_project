ELEMENT.locale(ELEMENT.lang.en)
import __constructJS from "../main.js"
new Vue({
    el : '#index_app',
    methods: {
        register: function() {
            this.dialogVisible = true;
            
        },
        onregister: function() {
            __constructJS.registrationRequest(this.task)
            .then(response => {
                console.log(response)
            })
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
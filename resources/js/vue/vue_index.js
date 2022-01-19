ELEMENT.locale(ELEMENT.lang.en)

new Vue({
    el : '#index_app',
    methods: {
        register: function() {
            this.dialogVisible = true
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
        }
    }


})
module.exports = {
    data() {
        return {
            fieldType: 'password'
        }

    },
    methods: {
        switchVisibility() {
            this.fieldType = this.fieldType === "password" ? "text" : "password";
        }
    }
}

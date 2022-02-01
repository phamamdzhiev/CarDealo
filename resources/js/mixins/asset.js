module.exports = {
    methods: {
        asset(path) {
            const base_path = window._asset || '';
            return base_path + path;
        }
    }
}

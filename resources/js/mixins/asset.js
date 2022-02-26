module.exports = {
    methods: {
        asset(path) {
            const base_path = window._asset + 'storage/' || '';
            return base_path + path;
        }
    }
}

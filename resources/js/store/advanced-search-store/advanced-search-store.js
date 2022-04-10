export default {
    namespaced: true,
    state() {
        return {
            filters: {
                category: "1",// by default load cars
                type: '',
                region: '',
                city: '',
                fuel: '',
                color: '',
                transmission: '',
                brand: '',
                model: '',
                yearMin: '',
                yearMax: '',
                budgetMin: '',
                budgetMax: '',
                kmMin: '',
                kmMax: '',
                sortBy: '',
                uploadedBy: ''
            }
        }
    },
    mutations: {
        setFilters(state, {filter, value}) {
            state.filters[filter] = value;
        },
        resetFilter(state) {
            state.filters.brand = '';
            state.filters.model = '';
            state.filters.type = '';
            state.filters.region = '';
            state.filters.city = '';
            state.filters.fuel = '';
            state.filters.color = '';
            state.filters.transmission = '';
            state.filters.yearMin = '';
            state.filters.yearMax = '';
            state.filters.budgetMin = '';
            state.filters.budgetMax = '';
            state.filters.kmMin = '';
            state.filters.kmMax = '';
            state.filters.sortBy = '';
            state.filters.uploadedBy = '';
        }
    },
    getters: {
        getFilters(state) {
            return state.filters;
        }
    },
    actions: {},
}

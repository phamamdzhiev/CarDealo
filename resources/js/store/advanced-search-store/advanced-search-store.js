export default {
    namespaced: true,
    state() {
        return {
            filters: {
                type: "1",// by default load cars
                category: '',
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
                kmMax: ''
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
            state.filters.category = '';
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
        }
    },
    getters: {
        getFilters(state) {
            return state.filters;
        }
    },
    actions: {},
}

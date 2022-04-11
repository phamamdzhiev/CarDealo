export default {
    namespaced: true,
    state() {
        return {
            // the ideas with this preserver is to fetch only once some data from db
            // and keep it here, so that reduece amount of request to the db
            preserver: [
                {'get.fuels': ''},
                {'get.transmissions': ''}
            ],
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
        },
        // setPreserver(state, {options, value}) {
        //     state.preserver.forEach((elem) => {
        //         if (Object.keys(elem)[0] === options) {
        //             console.log(elem)
        //         }
        //     })
        // }
    },
    getters: {
        getFilters(state) {
            return state.filters;
        },
        // getPreserver(state) {
        //     return state.preserver;
        // },
        fulfilledFilters(state) {
            return Object.fromEntries(Object.entries(state.filters).filter(([k, v]) => v !== ""))
        }
    },
    actions: {},
}

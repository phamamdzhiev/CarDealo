export const uploadOfferPersist = {
    key: 'offer',
    paths: [
        'uploadOffer.vehicle',
        'uploadOffer.step',
    ],
    storage: window.sessionStorage,
};

export const advancedFiltersPersist = {
    key: 'filters',
    paths: [
        'advancedFilters.filters',
    ],
    storage: window.sessionStorage,
};

export const favoriteStorePersist = {
    key: 'favorites',
    paths: [
        'favoriteStore.favorites',
    ],
    storage: window.localStorage,
};

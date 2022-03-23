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

import {defineStore} from "pinia";

export const useEventStore = defineStore('eventStore', {
    state: () => ({
        data: null,
        text: null,
        triggered: false,
    }),
    actions: {
        updateDate(data) {
            this.data = data;
        },
        updateSearch(data) {
            this.text = data;
        },
        reset() {
            this.data = 'reset';
            this.text = null;
        },
    },
    getters: {
        dateChanged: (state) => state.data,
        searchChanged: (state) => state.text,
    }
});
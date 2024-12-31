import {defineStore} from "pinia";

export const useLanguageStore = defineStore('languageStore', {
    state: () => ({
        lang: 'mk'
    }),
    actions: {
        updateLanguage(data) {
            this.lang = data;
        }
    },
    getters: {
        languageChanged: (state) => state.lang
    }
})
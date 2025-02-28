import type { Drink } from '../../types'
import { defineStore } from 'pinia'
import fetchDrinks from '../../api/fetchDrinks'

interface State {
    drinks: Drink[]
}

export const useDrinkStore = defineStore('drink', {
    state: (): State => ({
        drinks: [],
    }),
    actions: {
        async fetchData() {
            const data = await fetchDrinks()

            if (!data) {
                return
            }

            this.drinks = data
        },
    },
})

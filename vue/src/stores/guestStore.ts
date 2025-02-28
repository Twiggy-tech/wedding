import type { Guest } from '../../types'
import { defineStore } from 'pinia'
import fetchGuest from '../../api/fetchGuest'

interface State {
    guest: Guest | null
}

export const useGuestStore = defineStore('guest', {
    state: (): State => ({
        guest: null,
    }),
    actions: {
        async fetchData(token: string) {
            const data = await fetchGuest(token)

            if (!data) {
                return
            }

            this.guest = data
        },
    },
})

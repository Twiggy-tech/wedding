<template>
    <Header />
    <WeddingCountdown />
    <WeddingEvents />
    <InvitationForm />
    <DrinkSelector v-if="!guestStore.guest?.preferredDrinks?.length"/>
    <FAQ />
    <Footer />
</template>

<script setup lang="ts">
import WeddingCountdown from '@/components/WeddingCountdown.vue'
import WeddingEvents from '@/components/WeddingEvents/WeddingEvents.vue'
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
import InvitationForm from '@/components/InvitationForm.vue'
import FAQ from '@/components/FAQ.vue'
import DrinkSelector from '@/components/DrinkSelector.vue'
import { useGuestStore } from '@/stores/guestStore.ts'

const guestStore = useGuestStore()
</script>

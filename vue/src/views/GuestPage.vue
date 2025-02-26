<template>
    <Header />
    <WeddingCountdown />
    <WeddingEvents />
    <InvitationForm />
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
</script>

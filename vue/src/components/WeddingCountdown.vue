<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-6 col-md-12 mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2 :class="$style.count_down__title">Мы ждем этот день</h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h3 :class="$style.count_down__description">
                                Мы с нетерпением ждем 26 апреля, чтобы разделить наш особенный день с друзьями и семьей!
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div
                data-aos="zoom-in-up"
                data-aos-duration="1000"
                class="col-lg-6 col-md-12 mt-5 mb-5"
            >
                <div class="container">
                    <div class="row justify-content-center">
                        <div
                            v-for="(unit, index) in timeUnits"
                            :key="index"
                            class="col-xl-3 col-lg-6 col-md-3 col-6"
                        >
                            <div :class="$style.count_down__item">
                                <div :class="$style.count_down__number">{{ unit.value }}</div>
                                <div :class="$style.count_down__label">{{ unit.label }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import {useGuestStore} from '@/stores/guestStore'

const guestStore = useGuestStore()

const targetDate = new Date(guestStore.guest?.willAttendMainCeremony ? '2025-04-26T12:30:00' : '2025-04-26T16:00:00').getTime()
const now = ref<number>(Date.now())

const timeLeft = computed(() => {
    const difference = targetDate - now.value
    return {
        days: Math.floor(difference / (1000 * 60 * 60 * 24)),
        hours: Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
        minutes: Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60)),
        seconds: Math.floor((difference % (1000 * 60)) / 1000)
    }
})

interface TimeUnit {
    value: number
    label: string
}

const timeUnits = computed<TimeUnit[]>(() => [
    { value: timeLeft.value.days, label: 'ДНЕЙ' },
    { value: timeLeft.value.hours, label: 'ЧАСОВ' },
    { value: timeLeft.value.minutes, label: 'МИНУТ' },
    { value: timeLeft.value.seconds, label: 'СЕКУНД' }
])

let timer: number | undefined = undefined;

onMounted(() => {
    timer = setInterval(() => {
        now.value = Date.now()
    }, 1000)
})

onUnmounted(() => {
    clearInterval(timer)
})
</script>

<style module lang="scss">
.count_down {
    &__title {
        width: 100%;
        color: rgb(54, 54, 54);
        margin-bottom: 20px;
        text-align: left;
        font-family: "Playfair Display", serif;
        font-weight: 400;
        font-size: 2.5rem;
    }

    &__description {
        font-family: "Lato", serif;
        font-weight: 400;
        font-size: 1.3rem;
        line-height: 1.4;
        width: 100%;
        text-align: left;
        color: rgb(54, 54, 54);
    }

    &__item {
        background: white;
        border-radius: 12px;
        padding: 25px 15px;
        margin: 10px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    &__number {
        font-family: "Playfair Display", serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1;
        margin-bottom: 8px;
    }

    &__label {
        font-family: "Arial", sans-serif;
        font-size: 0.9rem;
        letter-spacing: 2px;
        color: #7f8c8d;
        text-transform: uppercase;
    }
}
</style>

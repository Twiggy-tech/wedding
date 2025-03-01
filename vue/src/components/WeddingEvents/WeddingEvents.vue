<template>
    <div class="container-fluid mt-5" :class="$style.events">
        <div class="row">
            <div class="col mt-5 mb-5 text-center" style="z-index: 10">
                <h1 :class="$style.events__title">{{ guestStore.guest?.willAttendMainCeremony ? 'Свадебные события' : 'Свадебное событие'}}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row justify-content-center">
                        <div
                            v-if="isVisibleEvent(events[0].isMainCeremony)"
                            class="col-xl-6 col-lg-8 col-md-12 mb-5"
                            style="z-index: 10"
                        >
                            <WeddingEvent
                                :title="events[0].title"
                                :description="events[0].description"
                                :date-time="events[0].dateTime"
                            />
                        </div>

                        <div
                            v-if="isVisibleEvent(events[1].isMainCeremony)"
                            class="col-xl-6 col-lg-8 col-md-12 mb-5"
                            style="z-index: 10"
                        >
                            <WeddingEvent
                                :title="events[1].title"
                                :description="events[1].description"
                                :date-time="events[1].dateTime"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import WeddingEvent from './components/WeddingEvent.vue'
import { useGuestStore } from '@/stores/guestStore'

const guestStore = useGuestStore()

const events = [
    {
        title: 'ЦЕРЕМОНИЯ БРАКОСОЧЕТАНИЯ',
        description: 'Церемония бракосочетания состоится 26 апреля в 12:30\n' +
            'в Управлении ЗАГС Администрации г. Липецка\n' +
            'по адресу: ул. Ленина, 28.',
        dateTime: new Date(2025, 3, 26, 12, 30),
        isMainCeremony: true,
    },
    {
        title: 'ПРАЗДНИЧНЫЙ БАНКЕТ',
        description: 'Праздничный банкет состоится 26 апреля в 16:00 в ресторане Марбелья по адресу: ул. Карла Маркса, 31',
        dateTime: new Date(2025, 3, 26, 16, 0),
        isMainCeremony: false,
    },
]

const isVisibleEvent = (isMainCeremony: boolean) => {
    return isMainCeremony && guestStore.guest?.willAttendMainCeremony || !isMainCeremony
}
</script>

<style module lang="scss">
.events {
    position: relative;
    background-image: url("../../../images/events-bg.webp");
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;

    &::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    &__title {
        font-size: 2.7rem;
        margin-bottom: 10px;
        line-height: 1.5;
        font-weight: bold;
        color: white;
        font-family: "Sacramento", Arial, serif;
    }
}
</style>

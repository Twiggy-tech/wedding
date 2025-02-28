<template>
    <div class="container-fluid" :class="$style.form_container">
        <div class="row h-100 align-items-center">
            <div class="col">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-md-12" :class="$style.form">
                            <div
                                v-if="answerAccepted"
                                class="container"
                            >

                                <div class="row mt-5 mb-5">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__title"
                                        >
                                            {{ answer }}
                                        </h2>
                                    </div>
                                </div>


                                <div class="row mt-5">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__text"
                                        >
                                            Дата: {{ invitationDateTime }}
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__text"
                                        >
                                            Место: {{ place }}
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__text"
                                        >
                                            Адрес: {{ address }}
                                        </h2>
                                    </div>
                                </div>

                                <div class="row mt-5 mb-5">
                                    <div class="col text-center">
                                        <button
                                            type="button"
                                            class="p-2 m-2"
                                            :class="$style.form__button"
                                            @click="answerAccepted = !answerAccepted"
                                        >
                                            Изменить ответ
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div
                                v-else
                                class="container"
                            >
                                <div class="row mt-5 mb-5">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__title"
                                        >
                                            {{ appeal }} {{ guestStore.guest?.firstName }}
                                        </h2>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__text"
                                        >
                                            Приглашаем на нашу свадьбу
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__text"
                                        >
                                            Дата: {{ invitationDateTime }}
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__text"
                                        >
                                            Место: {{ place }}
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__text"
                                        >
                                            Адрес: {{ address }}
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <h2
                                            class="text-center"
                                            :class="$style.form__text"
                                        >
                                            Просим подтвердить ваше присутствие до 15 марта 2025 года.
                                        </h2>
                                    </div>
                                </div>

                                <div class="row mt-5 mb-5">
                                    <div
                                        v-if="editing"
                                        class="col text-center"
                                    >
                                        <button
                                            type="button"
                                            class="p-2 m-2"
                                            disabled
                                            :class="$style.form__button"
                                        >
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            <span class="sr-only">Загрузка...</span>
                                        </button>
                                    </div>

                                    <div
                                        v-else
                                        class="col text-center"
                                    >
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <button
                                                        type="button"
                                                        class="p-2 m-2 w-100"
                                                        :class="$style.form__button"
                                                        :disabled="editing"
                                                        @click="onClick(true)"
                                                    >
                                                        {{ agreement }}
                                                    </button>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <button
                                                        type="button"
                                                        class="p-2 m-2 w-100"
                                                        :class="$style.form__button"
                                                        :disabled="editing"
                                                        @click="onClick(false)"
                                                    >
                                                        {{ refusal }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onBeforeMount, ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import { useGuestStore } from '@/stores/guestStore'
import editGuest from '../../api/editGuest'
import { GuestGenderEnum } from '../../types'

const loading = ref(true)
const editing = ref(false)
const answerAccepted = ref(false)
const error = ref<string | null>(null)

const dateTimeOptions: Intl.DateTimeFormatOptions = {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: 'numeric',
    minute: 'numeric',
};

const mainCeremonyDateTime = new Date(2025, 3, 26, 12, 30)
const banquetDateTime = new Date(2025, 3, 26, 16, 0)

const route = useRoute()
const guestStore = useGuestStore()

const invitationDateTime = computed(() => {
    return guestStore.guest?.willAttendMainCeremony
        ? mainCeremonyDateTime.toLocaleString("ru", dateTimeOptions)
        : banquetDateTime.toLocaleString("ru", dateTimeOptions)
})

const appeal = computed(() => {
    switch (guestStore.guest?.gender) {
        case GuestGenderEnum.MAN:
            return 'Дорогой'
        case GuestGenderEnum.WOMAN:
            return 'Дорогая'
        case GuestGenderEnum.MULTIPLE:
            return 'Дорогие'
    }
})

const place = computed(() => {
    return guestStore.guest?.willAttendMainCeremony
        ? 'Управление ЗАГС Администрации г. Липецка'
        : 'ресторан Марбелья'
})

const answer = computed(() => {
    return guestStore.guest?.willAttend
        ? 'Вы приняли приглашение'
        : 'Вы не приняли приглашение'
})

const address = computed(() => {
    return guestStore.guest?.willAttendMainCeremony
        ? 'г. Липецк, ул. Ленина, 28'
        : 'г. Липецк, ул. Карла Маркса, 31'
})

const agreement = computed(() => {
    switch (guestStore.guest?.gender) {
        case GuestGenderEnum.MAN:
        case GuestGenderEnum.WOMAN:
            return 'Я приду'
        case GuestGenderEnum.MULTIPLE:
            return 'Мы придем'
    }
})

const refusal = computed(() => {
    switch (guestStore.guest?.gender) {
        case GuestGenderEnum.MAN:
        case GuestGenderEnum.WOMAN:
            return 'К сожалению, я не смогу'
        case GuestGenderEnum.MULTIPLE:
            return 'К сожалению, мы не сможем'
    }
})

onBeforeMount(async () => {
    loading.value = true

    try {
        const token = route.params.token?.toString()
        await guestStore.fetchData(token)

        answerAccepted.value = guestStore.guest?.willAttend !== null
    } catch (err) {
        error.value = err instanceof Error ? err.message : 'Неизвестная ошибка'
    } finally {
        loading.value = false
    }
})

const onClick = async (willAttend: boolean) => {
    editing.value = true

    try {
        const data = await editGuest({ id: Number(guestStore.guest?.id), willAttend })

        console.log(data)

        guestStore.guest = data ?? null

        console.log(guestStore.guest)

        answerAccepted.value = true
    } catch (err) {
        error.value = err instanceof Error ? err.message : 'Неизвестная ошибка'
    } finally {
        editing.value = false
    }
}
</script>


<style module lang="scss">
.form_container {
    position: relative;
    background-image: url("../../images/guest-page-bg.jpg");
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    height: 600px;
}

.form {
    box-shadow: 0 4px 12px #00000014;
    border-radius: 2px;
    border: 2px solid rgba(255, 255, 255, 0.5);
    background-image: url("../../images/rsvp-bg.jpg");
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;


    &__title {
        font-family: "Playfair Display", serif;
        font-size: 2.4rem;
        -webkit-text-fill-color: transparent;
        color: rgb(54, 54, 54);
        background: linear-gradient(to right, rgb(235, 149, 148) 0%, rgb(224, 102, 101) 100%) padding-box text;
    }

    &__text {
        color: rgb(54, 54, 54);
        font-family: "Playfair Display", serif;
        font-weight: 400;
        font-size: 1.4rem;
    }

    &__button {
        position: relative;
        display: inline-block;
        -moz-box-pack: center;
        justify-content: center;
        -moz-box-align: center;
        align-items: center;
        border-radius: 0px;
        color: rgb(255, 255, 255);
        background-color: rgb(224, 102, 101);
        background-position: 0% 0%;
        background-attachment: scroll;
        background-image: none;
        background-size: auto;
        background-origin: padding-box;
        background-clip: border-box;
        box-sizing: border-box;
        text-align: center;
        cursor: pointer;
        text-decoration: none !important;
        font-weight: 400 !important;
        background-repeat: no-repeat !important;
        font-size: 1rem !important;
        line-height: 50px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        border: medium;
    }
}

@media (max-width: 1400px) {
  .form_container {
    height: 700px;
  }
}

@media (max-width: 576px) {
    .form_container {
        height: 800px;
    }
}

@media (max-width: 400px) {
  .form_container {
    height: 1000px;
  }
}
</style>

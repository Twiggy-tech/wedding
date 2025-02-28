<template>
    <div class="container-fluid" :class="$style.drinks_section">
        <div class="row">
            <div class="col">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div
                                class="container-fluid"
                                v-if="!answerAccepted" :class="$style.selector"
                            >
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <h2 :class="$style.title">Какой алкоголь предпочитаете?</h2>
                                    </div>
                                    <div class="col-10">
                                        <div :class="$style.options_container">
                                            <div
                                                v-for="drink in drinkStore.drinks"
                                                :key="drink.id"
                                                class="form-check option-item"
                                            >
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    :id="'option-' + drink.id"
                                                    :value="drink.id"
                                                    v-model="selectedOptions"
                                                >

                                                <label
                                                    class="form-check-label"
                                                    :for="'option-' + drink.id"
                                                >
                                                    {{ drink.name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center mt-3">
                                    <div class="col-6">
                                        <button
                                            type="button"
                                            class="p-2 m-2 w-100"
                                            :class="$style.button"
                                            @click="onClick"
                                        >
                                            Отправить
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div
                                v-else
                                class="container-fluid"
                            >
                                <div class="row">
                                    <div class="col">
                                        <div
                                            class=" text-center"
                                            :class="$style.confirmation_block"
                                        >
                                            <h2 :class="$style.title">Ваш ответ принят</h2>
                                            <p>Мы учтём ваши предпочтения!</p>
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
import type { Drink } from '../../types.ts'
import {onBeforeMount, ref} from 'vue'
import { useGuestStore } from '@/stores/guestStore.ts'
import { useDrinkStore } from '@/stores/drinkStore.ts'
import selectDrinks from '../../api/selectDrinks.ts'


const guestStore = useGuestStore()
const drinkStore = useDrinkStore()

const selectedOptions = ref<Drink[]>([]);
const answerAccepted = ref(false)

onBeforeMount(async () => {
    await drinkStore.fetchData()
})

const onClick = () => {
    const ids = selectedOptions.value.map(item => Number(item))

    selectDrinks({
        guestId: Number(guestStore.guest?.id),
        drinkIds: ids
    }).then(() => {
        answerAccepted.value = true
    }).catch(() => {
        answerAccepted.value = false
    })
}
</script>

<style module lang="scss">
.drinks_section {
    background: linear-gradient(45deg, #fff5f8 0%, #f8f2e5 100%);
}

.selector {
    padding: 2rem;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 12px;
    margin: 2rem auto;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.title {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    text-align: center;
    color: #b76e79;
    margin-bottom: 2.5rem;
    position: relative;

    &::after {
        content: '';
        display: block;
        width: 60px;
        height: 2px;
        background: #b76e79;
        margin: 1rem auto 0;
    }
}

.options_container {
    font-size: 1.5rem;
}

.button {
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

.confirmation_block {
    text-align: center;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 12px;
    margin: 2rem auto;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);

    h2 {
        color: #b76e79;
        font-family: 'Playfair Display', serif;
        margin-bottom: 1rem;
    }

    p {
        font-size: 1.1rem;
        color: #666;
    }
}
</style>

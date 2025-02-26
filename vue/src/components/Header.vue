<template>
    <div :class="$style.header">
        <div class="container h-100">
            <div class="row">
                <div class="col" style="z-index: 10">
                    <div class="mt-2">
                        <h2 :class="$style.logo__text">Свадьба<strong>.</strong></h2>
                    </div>
                </div>
            </div>

            <div class="row mt-5 h-75">
                <div class="col-lg-4 col-md-12 mt-5">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-2" style="z-index: 10">
                                <div :class="$style.header__line_vertical"></div>
                            </div>

                            <div class="col-10" :class="$style.text_right" style="z-index: 10">
                                <h1 :class="$style.header__title">Давайте вместе отметим наш важный день — ваше присутствие сделает его по-настоящему особенным!</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mt-5">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12" style="z-index: 10">
                                <img :class="$style.header__image" src="@/../images/header.jpg" alt="Photo" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 align-self-end mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-10 d-flex" style="z-index: 10">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div><h1 :class="$style.header__title">С любовью, Вадим и Софья</h1></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div><h1 :class="$style.header__description">Мы приглашаем вас разделить с нами радость этого знаменательного дня!</h1></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2" style="z-index: 10">
                                <div style="margin-left: auto" :class="$style.header__line_vertical"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style module lang="scss">

.logo {
    &__text {
        font-size: 40px;
        line-height: 40px;
        font-family: "Playfair Display", serif;
        color: white;
    }
}

.header {
    height: 900px;
    position: relative;
    width: 100%;
    background-image: url("@/../images/header-bg.jpg");
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
        font-size: 2.4rem;
        line-height: 1.5;
        font-family: "Playfair Display", serif;
        color: white;
    }

    &__description {
        font-size: 1.5rem;
        line-height: 1.5;
        font-family: "Playfair Display", serif;
        color: white;
    }

    &__image {
        border: 2px solid white;
        max-height: 100%;
        max-width: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
    }

    &__line_vertical {
        width: 2px;
        background-color: rgb(255, 255, 255);
        height: 100%;
    }
}

.text_right {
    text-align: right;
}

@media (max-width: 1400px) {
    .header {
        &__title {
            font-size: 2rem;
        }
    }
}

@media (max-width: 992px) {
    .header {
        height: 1600px;

        &__title {
            font-size: 2rem;
        }
    }
}

@media (max-width: 768px) {
    .header {
        height: 1450px;
    }
}

@media (max-width: 370px) {
    .header {
        height: 1600px;
    }
}
</style>

<script setup lang="ts">
</script>

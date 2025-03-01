<template>
    <div
        class="h-100"
        data-aos="zoom-in-up"
        data-aos-duration="1000"
        :class="$style.card">
        <div class="row">
            <div class="col">
                <h3 :class="$style.card__title">{{ props.title }}</h3>
            </div>
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-3">
                <i class="bi bi-clock" :class="$style.card__time"></i>
            </div>

            <div class="col-8">
                <i class="bi bi-calendar-heart" :class="$style.card__time"></i>
            </div>
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-3">
                <p :class="$style.card__time">{{ props.dateTime.toLocaleString("ru", timeOptions) }}</p>
            </div>

            <div class="col-8">
                <p :class="$style.card__time">{{ props.dateTime.toLocaleString("ru", dateOptions) }}</p>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col">
                <div :class="$style.card__description">{{ props.description }}</div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>

const props = defineProps({
    title: {
        type: String,
        required: true,
    },

    dateTime: {
        type: Date,
        required: true,
    },

    description: {
        type: String,
        required: true,
    },
})

const dateOptions: Intl.DateTimeFormatOptions = {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    weekday: 'long',
};

const timeOptions: Intl.DateTimeFormatOptions = {
    hour: 'numeric',
    minute: 'numeric',
};
</script>

<style module lang="scss">
.card {
    border-radius: 2px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    border: 2px solid rgba(255, 255, 255, 0.5);
    background: rgba(255, 255, 255, 0.4);

    &__time {
        color: white;
        font-size: 1.5rem;
    }

    &__title {
        text-align: center;
        font-family: "Playfair Display", serif;
        font-size: 1.4rem;
        color: white;
        margin-bottom: 15px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.5);
    }

    &__description {
        font-size: 1.4rem;
        line-height: 1.6;
        color: white;
        flex-grow: 1;
    }
}
</style>

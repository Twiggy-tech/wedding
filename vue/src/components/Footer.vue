<template>
    <div class="container-fluid" :class="$style.footer">
        <div class="row h-100" :class="$style.footer__dark">
            <div class="col d-flex align-items-center">
                <h3 class="w-100 text-center" :class="$style.footer__text">Ждем вас этой весной.</h3>
            </div>
        </div>
    </div>
</template>

<style module lang="scss">
.footer {
    height: 200px;

    &__dark {
        background-color: rgb(54, 54, 54);
    }

    &__text {
        font-size: 14px;
        color: rgb(255, 255, 255);
    }
}
</style>

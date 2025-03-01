<template>
    <div :class="$style.faqSection">
        <div class="container">
            <h2 :class="$style.faqTitle">Частые вопросы</h2>

            <div :class="$style.faqAccordion">
                <div
                    v-for="(item, index) in items"
                    :key="index"
                    data-aos="fade-up"
                    data-aos-duration="1000"
                    :class="[$style.faqItem, { [$style.active]: activeIndex === index }]"
                    @click="toggleAccordion(index)"
                >
                    <div :class="$style.faqQuestion">
                        <span>{{ item.title }}</span>
                        <div :class="$style.arrowIcon"></div>
                    </div>

                    <div :class="$style.faqAnswer">
                        <div :class="$style.answerContent">
                            <p v-html="item.answer"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const activeIndex = ref(-1)

const toggleAccordion = (index: number) => {
    activeIndex.value = activeIndex.value === index ? -1 : index
}

const items = [
    {
        title: 'Какой дресс-код мероприятия?',
        answer: "Мы будем рады видеть вас в вечерних нарядах. Мужчинам рекомендуем костюмы, женщинам — платья любой длины.",
    },
    {
        title: 'Можно ли с детьми?',
        answer: "Нам важно заранее знать о количестве гостей на мероприятии. Если вы хотите взять с собой детей, сообщите нам по телефону: " +
            "<a href=\"tel:+79086991046\">+7 (908) 699-10-46</a>, <a href=\"tel:+79667560566\">+7 (966) 756-05-66</a>",
    },
    {
        title: 'Можно ли взять с собой кого-нибудь?',
        answer: "Нам важно заранее знать о количестве гостей. Если вы хотите взять с собой партнёра, \n" +
            "    сообщите нам по телефону: \n" +
            "    <a href=\"tel:+79086991046\">+7 (908) 699-10-46</a>, <a href=\"tel:+79667560566\">+7 (966) 756-05-66</a>",
    },
    {
        title: 'Какие подарки будут для вас особенно приятны?',
        answer: "Ваше присутствие — уже самый ценный подарок! 💖<br>\n" +
            "    Если всё же хочется порадовать нас сюрпризом, будем благодарны за:\n" +
            "    <ul :class=\"$style.giftList\">\n" +
            "      <li>🍷 Хорошее вино или авторский алкоголь для нашей коллекции</li>\n" +
            "      <li>🎲 Настольные игры для будущих семейных вечеров</li>\n" +
            "      <li>💌 Конверт на медовый месяц (будем рады вашей доброй мысли)</li>\n" +
            "    </ul>\n" +
            "    Цветы, к сожалению, быстро теряют свою красоту, а ваше внимание \n" +
            "    мы хотим сохранить в воспоминаниях надолго!",
    },
]
</script>

<style module lang="scss">
ul {
    margin: 0;
}

.faqSection {
    padding: 4rem 0;
    background: linear-gradient(45deg, #fff5f8 0%, #f8f2e5 100%);
}

.faqTitle {
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

.faqAccordion {
    max-width: 800px;
    margin: 0 auto;
}

.faqItem {
    margin-bottom: 1rem;
    border-radius: 8px;
    background: white;
    box-shadow: 0 3px 15px rgba(183, 110, 121, 0.1);
    transition: all 0.3s ease;

    &.active {
        box-shadow: 0 5px 20px rgba(183, 110, 121, 0.15);
        max-height: 500px;

        .faqAnswer {
            max-height: 500px;
            padding: 1rem;
        }

        .arrowIcon {
            transform: rotate(180deg);
        }
    }
}

.faqQuestion {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    cursor: pointer;

    span {
        font-family: 'Lora', serif;
        font-size: 1.1rem;
        color: #4a4a4a;
        font-weight: 500;
    }
}

.arrowIcon {
    width: 20px;
    height: 20px;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23b76e79'%3E%3Cpath d='M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z'/%3E%3C/svg%3E");
    transition: transform 0.3s ease;
}

.faqAnswer {
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease;
    padding: 0 1.5rem;

    p {
        font-family: 'Lora', serif;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }
}

.answerContent {
    padding: 0 1.5rem 1.5rem;
    word-wrap: break-word;
    overflow-y: auto;
    max-height: 300px;
}

.giftList {
    margin: 1rem 0;
    padding-left: 1.5rem;
}

@media (max-width: 768px) {
    .faqTitle {
        font-size: 2rem;
    }

    .faqQuestion span {
        font-size: 1rem;
    }
}
</style>

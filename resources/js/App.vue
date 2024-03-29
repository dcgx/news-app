<template>
    <main class="container mx-auto px-4 py-8">
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        >
            <div
                class="max-w-sm rounded overflow-hidden shadow-lg"
                v-for="(article, index) in articles"
                :key="index"
            >
                <img
                    class="w-full"
                    :src="article.urlToImage"
                    :alt="article.title"
                />
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ article.title }}
                    </div>
                    <p class="text-gray-700 text-base">
                        {{ article.description }}
                    </p>
                    <p class="text-gray-600 text-sm mt-2">Autor: Lloyd Lee</p>
                </div>
                <div class="px-6 py-4">
                    <a
                        :href="article.url"
                        target="_blank"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Leer más
                    </a>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const articles = ref();
const totalResults = ref(0);

onMounted(async () => {
    await getAllNews();
});

const getAllNews = async () => {
    try {
        const { data } = await axios.get("http://localhost:8000/api/news");
        if (data) {
            articles.value = data.articles;
        }
    } catch (error) {
        console.error(error);
    }
};
</script>

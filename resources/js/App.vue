<template>
    <main class="container mx-auto px-4 py-8">
        <div
            class="d-flex align-items-center justify-content-center"
            v-if="isLoading"
        >
            <p class="text-center">Cargando noticias...</p>
            <div class="loader"></div>
        </div>
        <div class="row">
            <div
                class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4"
                v-for="(article, index) in articles"
                :key="index"
            >
                <div class="card">
                    <img
                        :src="article.urlToImage"
                        :alt="article.title"
                        class="card-img-top"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ article.title }}</h5>
                        <p class="card-text">{{ article.description }}</p>
                        <p class="card-text">
                            <a class="text-muted" :href="'mailto:' + article.randomUser.email"
                                >Autor: {{ article.randomUser.name }}</a
                            >
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a
                            :href="article.url"
                            target="_blank"
                            class="btn btn-primary"
                        >
                            Leer más
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const isLoading = ref(false);
const articles = ref();
const totalResults = ref(0);

onMounted(async () => {
    await getAllNews();
});

const getAllNews = async () => {
    try {
        isLoading.value = true;
        const { data } = await axios.get("http://localhost:8000/api/news");
        if (data) {
            articles.value = data.articles;
        }
        isLoading.value = false;
    } catch (error) {
        console.error(error);
        isLoading.value = false;
    }
};
</script>

<template>
    <main class="container mx-auto px-4 py-8">
        <div
            class="d-flex align-items-center justify-content-center"
            v-if="isLoading"
        >
            <p class="text-center">Cargando noticias...</p>
            <div class="loader"></div>
        </div>
        <div class="row" v-else>
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
                            <a
                                class="text-muted"
                                :href="'mailto:' + article.randomUser.email"
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

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a
                        class="page-link"
                        href="#"
                        aria-label="Previous"
                        @click="prevPage"
                    >
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li
                    class="page-item"
                    v-for="page in visiblePages"
                    :key="page"
                    :class="{ active: page === currentPage }"
                >
                    <a class="page-link" href="#" @click="setPage(page)">{{
                        page
                    }}</a>
                </li>
                <li
                    class="page-item"
                    :class="{ disabled: currentPage === totalPages }"
                >
                    <a
                        class="page-link"
                        href="#"
                        aria-label="Next"
                        @click="nextPage"
                    >
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </main>
</template>

<script setup>
import axios from "axios";
import { computed, onMounted, ref } from "vue";

const isLoading = ref(false);
const articles = ref([]);
const totalResults = ref(0);

const currentPage = ref(1);
const pageSize = 10;

const maxVisiblePages = 10;

const visiblePages = computed(() => {
    const firstPage = Math.max(
        1,
        currentPage.value - Math.floor(maxVisiblePages / 2)
    );
    const lastPage = Math.min(
        totalPages.value,
        firstPage + maxVisiblePages - 1
    );
    return Array.from(
        { length: lastPage - firstPage + 1 },
        (_, index) => index + firstPage
    );
});

onMounted(async () => {
    await getAllNews();
});

const getAllNews = async () => {
    try {
        isLoading.value = true;
        const { data } = await axios.get(
            `${import.meta.env.VITE_APP_API_URL}/news?pageSize=${pageSize}&page=${currentPage.value}`
        );
        if (data) {
            articles.value = data.articles;
            totalResults.value = data.totalResults;
        }
        isLoading.value = false;
    } catch (error) {
        console.error(error);
        isLoading.value = false;
    }
};

const paginatedArticles = computed(() => {
    const startIndex = (currentPage.value - 1) * pageSize;
    return articles.value.slice(startIndex, startIndex + pageSize);
});

const totalPages = computed(() => Math.ceil(totalResults.value / pageSize));

const setPage = async (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
        console.log(currentPage.value);
        await getAllNews();
    }
};

const prevPage = async () => {
    if (currentPage.value > 1) {
        currentPage.value--;
        console.log(currentPage.value);
        await getAllNews();
    }
};

const nextPage = async () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
        console.log(currentPage.value);
        await getAllNews();
    }
};
</script>

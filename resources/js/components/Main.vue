<template>
    <main id="main">
        <div class="container">
            <h1 class="text-center my-3">ARTICOLI</h1>
            <div class="row flex-column">
                <Loader v-if="isLoading" />
                <div v-else>
                    <PostCard
                        v-for="post in posts"
                        :key="post.id"
                        :post="post"
                    />
                    <nav
                        aria-label="Page navigation example"
                        class=" d-flex justify-content-center"
                    >
                        <ul class="pagination">
                            <li
                                class="page-item"
                                v-if="pagination.currentPage > 1"
                                @click="getPosts(pagination.currentPage - 1)"
                            >
                                <a class="page-link">Previous</a>
                            </li>
                            <li
                                v-for="i in pagination.lastPage"
                                :key="i"
                                class="page-item"
                            >
                                <a class="page-link">{{ i }}</a>
                            </li>
                            <li
                                class="page-item"
                                v-if="
                                    pagination.lastPage > pagination.currentPage
                                "
                                @click="getPosts(pagination.currentPage + 1)"
                            >
                                <a class="page-link">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import axios from "axios";
import PostCard from "./PostCard.vue";
import Loader from "./Loader.vue";

export default {
    name: "Main",
    components: {
        PostCard,
        Loader
    },
    data() {
        return {
            baseUri: "http://localhost:8000",
            posts: [],
            isLoading: false,
            pagination: {}
        };
    },
    methods: {
        getPosts(page) {
            this.isLoading = true;
            axios
                .get(`${this.baseUri}/api/posts?page=${page}`)
                .then(res => {
                    // prendiamo i dati delle api che hanno paginate, e che non inviasno solo i post ma anche altre informazioni
                    //const data = res.data.data;
                    //const current_page = res.data.current_page;
                    //const last_page = res.data.last_page;

                    //in maniera accorciata possiamo scrivere :
                    const { data, current_page, last_page } = res.data;
                    //ovvero prendimi i dati dentro le graffe che stanno dentro res.data e mettimeli in delle variabili omonime

                    this.posts = data;
                    this.pagination = {
                        currentPage: current_page,
                        lastPage: last_page
                    };
                })
                .catch(err => {
                    console.error(err);
                })
                .then(() => {
                    this.isLoading = false;
                });
        }
    },
    created() {
        this.getPosts();
    }
};
</script>

<style scoped lang="scss">
.page-item {
    cursor: pointer;
}
</style>

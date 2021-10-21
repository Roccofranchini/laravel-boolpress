<template>
    <main>
        <div class="container">
            <h1 class="text-center my-3">ARTICOLI</h1>
            <div class="row flex-column">
                <PostCard v-for="post in posts" :key="post.id" :post="post" />
                <Loader v-if="isLoading" />
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
            isLoading: false
        };
    },
    methods: {
        getPosts() {
            this.isLoading = true;
            axios
                .get(`${this.baseUri}/api/posts`)
                .then(res => {
                    this.posts = res.data;
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

<style></style>

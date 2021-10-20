<template>
    <main>
        <div class="container">
            <h1 class="text-center my-3">ARTICOLI</h1>
            <div class="row flex-column">
                <PostCard v-for="post in posts" :key="post.id" :post="post" />
            </div>
        </div>
    </main>
</template>

<script>

import axios from "axios";
import PostCard from "./PostCard.vue"

export default {
    name: "Main",
    components: {
        PostCard,
    },
    data() {
        return {
            baseUri: "http://localhost:8000",
            posts: []
        };
    },
    methods: {
        getPosts() {
            axios
                .get(`${this.baseUri}/api/posts`)
                .then((res) => {
                    this.posts = res.data;
                })
                .catch((err) => {
                    console.error(err);
                });
        },
    },
    created() {
        this.getPosts();
    }
};
</script>

<style></style>

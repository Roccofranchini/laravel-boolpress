<template>
    <div class="card my-4 shadow-lg">
        <div class="card-header">
            {{ post.title }}
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <h4>
                    Categoria:
                    <span
                        v-if="post.category !== null"
                        class="badge badge-pill"
                        :class="`badge-${post.category.color}`"
                        >{{ post.category.name }}</span
                    >
                    <span v-else>Nessuna</span>
                </h4>
                <p>{{ post.content }}</p>
                <img
                    v-if="post.image !== null"
                    class="img-fluid post-img"
                    :src="'./storage/' + post.image"
                    alt="postimg"
                />
                <footer>
                    {{ getFormattedDate(post.created_at) }}
                </footer>
            </blockquote>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostCard",
    props: ["post"],
    methods: {
        getFormattedDate(date) {
            const PostDate = new Date(date);
            const day = PostDate.getDate();
            const month = PostDate.getMonth() + 1;
            const year = PostDate.getFullYear();

            return `${day}/${month}/${year}`;
        }
    }
};
</script>

<style scoped lang="scss">
.post-img {
    max-width: 100%;
    height: auto;
}
</style>

<template>
    <div class="card my-4 shadow-lg">
        <div class="card-header">
            {{ post.title }}
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <h4>
                    Categoria:
                    <span v-if="post.category.name !== null">{{
                        post.category.name
                    }}</span>
                    <span v-else>Nessuna</span>
                </h4>
                <p>{{ post.content }}</p>
                <footer class="blockquote-footer">{{ post.created_at }}</footer>
            </blockquote>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostCard",
    props: ["post"]
};
</script>

<style></style>

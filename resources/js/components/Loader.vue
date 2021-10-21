<template>
    <div class="loader d-flex justify-content-center align-items-center">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Loader"
};
</script>

<style scoped lang="scss">
.loader {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.2);

    .spinner-border {
        width: 200px;
        height: 200px;
    }
}
</style>

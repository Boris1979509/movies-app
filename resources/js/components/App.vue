<template>
    <Loader/>
    <!--    <div id="nav">-->
    <!--        <router-link to="/">Home</router-link>-->
    <!--    </div>-->
    <router-view/>
</template>

<script>
    import Loader from "./loader/Loader";

    export default {
        name: "App",
        components: {
            Loader
        }
    }
</script>

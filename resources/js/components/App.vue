<template>
    <Loader/>
    <Notify/>
    <Header/>
    <!--    <div id="nav">-->
    <!--        <router-link to="/">Home</router-link>-->
    <!--    </div>-->
    <router-view/>
</template>

<script>
    import Loader from "./loader/Loader";
    import Header from "./header/Header";
    import Notify from "./notification/Notify"

    export default {
        name: "App",
        components: {
            Loader,
            Header,
            Notify
        }
    }
</script>

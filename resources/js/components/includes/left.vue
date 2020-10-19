<template>
    <div class="iq-sidebar">
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li>
                        <router-link to="/newsfeed"    class="iq-waves-effect"><i class="las la-newspaper"></i><span>Newsfeed</span></router-link>
                    </li>
                </ul>
            </nav>
            <div class="p-3"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "left"
    }
</script>

<style scoped>
    .router-link-exact-active{
        background-color: #c5e3fb;
        color: #65c3fb;
        opacity: 0.8;
    }
</style>

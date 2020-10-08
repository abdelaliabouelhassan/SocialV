<template>

     <div class="wrapper">
        <socialV-header></socialV-header>
        <socialV-left></socialV-left>
        <socialV-right></socialV-right>
            <div id="content-page" class="content-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        <socialV-footer></socialV-footer>
    </div>


</template>

<script>
    export default {

    }
</script>

<style scoped>

</style>

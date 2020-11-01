<template>

     <div class="wrapper">
        <socialV-header></socialV-header>
        <socialV-left></socialV-left>
        <socialV-right></socialV-right>
            <div id="content-page" class="content-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12" v-if="$store.state.user.length != 0">
                            <router-view v-show="!$store.state.isSearch && !$store.state.showCall"></router-view>
                            <FriendSearch v-show="$store.state.isSearch"></FriendSearch>
                            <VideoCall v-show="$store.state.showCall"></VideoCall>
                            <vue-progress-bar></vue-progress-bar>
                        </div>
                    </div>
                </div>
            </div>
        <socialV-footer></socialV-footer>
    </div>


</template>

<script>
    import FriendSearch from "./socialV/search/FriendSearch";
    import VideoCall from "./socialV/Chat/VideoCall";
    export default {
        components:{
            FriendSearch,
            VideoCall
        },
        methods:{
          loadCurrentUser(){
              this.$Progress.start();
              this.axios.get('/api/user').then((response) => {
                  this.$store.state.user = response.data
                  this.$Progress.finish();
              }).catch((error)=>{
                  console.log(error)
                  this.$Progress.fail()
              })

          }
        },
        created() {
                this.loadCurrentUser();
        }
    }
</script>

<style scoped>

</style>

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
                            <vue-progress-bar></vue-progress-bar>
                        </div>
                    </div>
                </div>
            </div>
        <socialV-footer></socialV-footer>
    </div>


</template>

<script>
    export default {
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

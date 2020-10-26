<template>
    <div class="right-sidebar-mini right-sidebar">
        <div class="right-sidebar-panel p-0">
            <div class="iq-card shadow-none">
                <div class="iq-card-body p-0">
                    <div class="media-height p-3">
                        <div class="media align-items-center mb-4" v-for="Friends in MyFriends">
                            <div class="iq-profile-avatar status-online" v-if="Friends.status == 'online'">
                                <img class="rounded-circle avatar-50" :src="Friends.profile_photo_url" alt="">
                            </div>
                            <div class="iq-profile-avatar" v-else>
                                <img class="rounded-circle avatar-50" :src="Friends.profile_photo_url" alt="">
                            </div>
                            <div class="media-body ml-3">
                                <h6 class="mb-0"><a href="#">{{Friends.name}}</a></h6>
                                <p class="mb-0">Admin</p>
                            </div>
                        </div>
                        <div class="media align-items-center">
                            <div class="iq-profile-avatar">
                                <img class="rounded-circle avatar-50" src="images/user/02.jpg" alt="">
                            </div>
                            <div class="media-body ml-3">
                                <h6 class="mb-0"><a href="#">Monty Carlo</a></h6>
                                <p class="mb-0">Admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="right-sidebar-toggle bg-primary mt-3">
                        <i class="ri-arrow-left-line side-left-icon"></i>
                        <i class="ri-arrow-right-line side-right-icon"><span class="ml-3 d-inline-block">Close Menu</span></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                MyFriends:[]
            }
        },
        methods:{
            setUserOffline(user){
                this.MyFriends.forEach(freind=>{
                    if(freind.id == user.id){
                        freind.status = 'offline'
                        this.axios.post('/api/SetUserOffline',{id:user.id}).then((response) => {
                        }).catch((error)=>{
                            console.log(error)
                        })
                    }
                });
            },
            setUserOnline(user){
                this.MyFriends.forEach(freind=>{
                    if(freind.id == user.id){
                        freind.status = 'online'
                        this.axios.post('/api/SetUserOnline',{id:user.id}).then((response) => {
                        }).catch((error)=>{
                            console.log(error)
                        })
                    }
                });
            },
           getFriends(){
               this.axios.get('/api/getFriends').then((response) => {
                   this.MyFriends = response.data;
               }).catch((error)=>{
                   console.log(error)
               })
           },
            listen(){
                Echo.join('chat')
                    .joining((user) => {
                           this.setUserOnline(user);
                    }).leaving((user) => {
                        this.setUserOffline(user);
                })
            }
        },
        created(){
            this.getFriends()
        },
        mounted() {
              this.listen();
            }
    }
</script>

<style scoped>

</style>

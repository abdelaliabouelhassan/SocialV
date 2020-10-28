<template>
  <div>
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
                            <div class="media-body ml-3" @click="StartChat(Friends)">
                                <h6 class="mb-0"><a href="#" style="text-decoration: none;">{{Friends.name}}</a></h6>
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

        <!-- Chat Box     -->
        <ChatBox v-show="showChatBox" :Friend="Friend" ></ChatBox>
 </div>

</template>

<script>

import ChatBox from "../socialV/Chat/ChatBox";
    export default {
        components:{
            ChatBox,
        },
        data(){
            return {
                MyFriends:[],
                showChatBox:false,
                Friend:[],
            }
        },
        methods:{
            StartChat(Friend){
              this.showChatBox = true;
              this.Friend = Friend;
            },
            setUserOffline(user){
                this.MyFriends.forEach(freind=>{
                    if(freind.id == user.id){
                        freind.status = 'offline'
                        //this is not necessary to send request to server again cuz we are using webhook
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
                        //this is not necessary to send request to server again cuz we are using webhook
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

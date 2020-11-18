<template>
    <li class="nav-item dropdown">
        <a href="#" class="search-toggle iq-waves-effect">
            <i class="las la-envelope-open"></i>
            <span class="bg-primary count-mail" v-show="MessageCountNotRead > 0"></span>
        </a>
        <div class="iq-sub-dropdown">
            <div class="iq-card shadow-none m-0">
                <div class="iq-card-body p-0 ">
                    <div class="bg-primary p-3">
                        <h5 class="mb-0 text-white">All Messages<small class="badge  badge-light float-right pt-1">{{MessageCountNotRead}}</small></h5>
                    </div>
                    <a href="#" class="iq-sub-card" v-for="(msg,index) in LastMsgs" :class="{'notColor':msg.isread == null && msg.ismy == false}">
                        <div class="media align-items-center">
                            <div class="">
                                <img class="avatar-40 rounded" :src="msg.user.profile_photo_url" alt="msg.user.name">
                            </div>
                            <div class="media-body ml-3">
                                <h6 class="mb-0 ">{{msg.user.name}}</h6>
                                <div class="float-left">
                                    <b class="mb-0" v-if="msg.type == 'message'"> {{msg.message}}</b>
                                    <b class="mb-0" v-if="msg.type == 'bothremoved'"> Message Deleted</b>
                                    <b class="mb-0" v-if="msg.type == 'DeleteForEveryone'"> Message Deleted</b>
                                    <b class="mb-0" v-if="msg.type == 'removed' && msg.who != getUserInfo.id"> Message Deleted</b>
                                    <b class="mb-0" v-if="msg.attachment == 'yes'"> Attachments</b>
                                    <b class="mb-0" v-if="msg.type == 'callMissed' && msg.to != getUserInfo.id" style="color:red">You Called With No Responde </b>
                                    <b class="mb-0" v-if="msg.type == 'callMissed' && msg.to == getUserInfo.id" style="color:red">You Missed Call </b>
                                    <b class="mb-0" v-if="msg.type == 'callEnd'" style="color:blue"> Call End</b>

                                </div>
                                <br>
                                <small class="float-left font-size-12"><TimeAgo :refresh="60" :datetime="msg.created_at" locale="en" tooltip></TimeAgo></small>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    import TimeAgo from 'vue2-timeago'
    import {mapGetters} from "vuex";

    export default {
        components:{
            TimeAgo
        },
        name: "MessageNotification",
         data(){
            return{
              LastMsgs:[],
            }
         },
        methods:{
          LoadNotficationMsg(){
              this.axios.get('/api/GetMessageNotification').then((response)=>{
                  this.LastMsgs = response.data.data;
                  console.log(response.data.data)
              }).catch((error)=>{
                  console.log(error)
              });
          }
        },
        computed:{
            ...mapGetters([
                'getUserInfo'
            ]),
            MessageCountNotRead(){
                if(this.getUserInfo){
                    var i = 0 ;
                    this.LastMsgs.forEach(msg=>{
                        if(msg.isread == null && msg.to == this.getUserInfo.id){
                            i++;
                        }
                    });



                    return i;
                }
                    return 0;
            }
        },
        created(){
            something.$on('LoadNotficationMsg',()=>{
                this.LoadNotficationMsg();
            });
            this.LoadNotficationMsg();
        }
    }
</script>

<style scoped>
        .notColor{
            background-color:gray;
        }
</style>

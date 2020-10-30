<template>
    <div class="wrapper">
        <div class="chat-box">
            <header class="d-flex justify-content-between align-items-center bg-white pt-3 pr-3 pb-3">
                <div class="d-flex align-items-center">
                    <div class="sidebar-toggle">
                        <i class="ri-menu-3-line"></i>
                    </div>
                    <div class="avatar chat-user-profile m-0 mr-3" >
                        <img :src="Friend.profile_photo_url" alt="avatar" class="avatar-50 " style="margin-left: 8px">
                        <span class="avatar-status"><i class="ri-checkbox-blank-circle-fill" :class="{'text-success':Friend.status == 'online'}"></i></span>
                    </div>
                    <h5 class="mb-0">{{Friend.name}}</h5>
                </div>
                <div class="chat-user-detail-popup scroller">
                    <div class="user-profile text-center">
                        <button type="submit" class="close-popup p-3"><i class="ri-close-fill"></i></button>
                        <div class="user mb-4">
                            <a class="avatar m-0">
                                <img src="images/user/05.jpg" alt="avatar">
                            </a>
                            <div class="user-name mt-4">
                                <h4>Bni Jordan</h4>
                            </div>
                            <div class="user-desc">
                                <p>Cape Town, RSA</p>
                            </div>
                        </div>
                        <hr>
                        <div class="chatuser-detail text-left mt-4">
                            <div class="row">
                                <div class="col-6 col-md-6 title">Bni Name:</div>
                                <div class="col-6 col-md-6 text-right">Bni</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-6 title">Tel:</div>
                                <div class="col-6 col-md-6 text-right">072 143 9920</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-6 title">Date Of Birth:</div>
                                <div class="col-6 col-md-6 text-right">July 12, 1989</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-6 title">Gender:</div>
                                <div class="col-6 col-md-6 text-right">Male</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-6 title">Language:</div>
                                <div class="col-6 col-md-6 text-right">Engliah</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-header-icons d-flex">
                    <a href="javascript:void(0);" class="chat-icon-phone iq-bg-primary">
                        <i class="ri-phone-line"></i>
                    </a>
                    <a href="javascript:void(0);" class="chat-icon-video iq-bg-primary">
                        <i class="ri-vidicon-line"></i>
                    </a>
                    <a href="javascript:void(0);" class="chat-icon-delete iq-bg-primary">
                        <i class="ri-delete-bin-line"></i>
                    </a>
                    <span class="dropdown iq-bg-primary">
                                                   <i class="ri-more-2-line cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer pr-0" id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></i>
                                                   <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton02">
                                                   <a class="dropdown-item" href="JavaScript:void(0);"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Pin to top</a>
                                                   <a class="dropdown-item" href="JavaScript:void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete chat</a>
                                                   <a class="dropdown-item" href="JavaScript:void(0);"><i class="fa fa-ban" aria-hidden="true"></i> Block</a>
                                                   </span>
                                                   </span>
                </div>
            </header>

            <div class="chat-content scroller" id="scroller" style="background:url('../images/page-img/100.jpg')">
                <div class="chat" v-for="chat in ChatMessages.slice().reverse()" :class="{'chat-left': Friend.id == chat.from}">
                    <div class="chat-user">
                        <a class="avatar m-0">
                            <img :src="Friend.profile_photo_url" v-if="Friend.id == chat.from" alt="avatar" class="avatar-35 ">
                            <img :src="getUserInfo.profile_photo_url" v-if="Friend.id != chat.from" alt="avatar" class="avatar-35 ">
                        </a>
                        <span class="chat-time mt-1">{{chat.created_at}}</span>
                    </div>
                    <div class="chat-detail">
                        <div class="chat-message">
                            <p v-if="chat.type == 'message'" style="font-size: 19px">{{chat.message}}</p>
                            <p style="font-size: 70px" v-if="chat.type == 'emoji'">{{chat.message}}</p>
<!--                            <FbImageLibrary  :images="images" style="cursor: pointer"></FbImageLibrary>-->
                        </div>

                    </div>
                </div>
                <div class="chat" v-show="isSent">
                    <div class="chat-user">
                        <a class="avatar m-0">
                            <img :src="getUserInfo.profile_photo_url" alt="avatar" class="avatar-35 ">
                        </a>
                        <img src="images/page-img/page-load-loader.gif" alt="loader" style="height: 60px;">

                    </div>
                    <div class="chat-detail">
                        <div class="chat-message">
                            <p>{{message}}</p>
                        </div>
                    </div>
                </div>
                <div class="chat chat-left" v-if="typing && typingTo == Friend.id">
                    <div class="chat-user">
                        <a class="avatar m-0">
                            <img :src="Friend.profile_photo_url"  alt="avatar" class="avatar-35 ">
                        </a>
                    </div>
                    <div class="chat-detail">
                        <div class="media-body ml-3'">
                            <div class="chat-message">

                            <vue-typed-js :strings="['Is Typing...😄']">
                                <h5 class="typing"></h5>
                            </vue-typed-js>
                        </div>
                        </div>
                    </div>
                </div>
                <VEmojiPicker @select="selectEmoji" v-show="showEmoji"/>
            </div>
            <div class="chat-footer p-3 bg-white">
                <div class="attachmnt">
                    <img  class="item" src="https://cdn.hipwallpaper.com/i/77/4/gIx0SV.jpg" style="width: 50px;height: 50px ;cursor: pointer" alt="">
                </div>
                <form class="d-flex align-items-center"  action="javascript:void(0);">
                    <div class="chat-attagement d-flex">
                        <a href="javascript:void(0);" @click="openEmoji"><i class="fa fa-smile-o pr-3" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-paperclip pr-3" aria-hidden="true"></i></a>
                    </div>
                    <input type="text" class="form-control mr-3" placeholder="Type your message" @keydwon.enter="SendMessage" @keydown="isTyping()"  v-model="message">
                    <button type="submit" class="btn btn-primary d-flex align-items-center p-2" @click="SendMessage" ><i class="fa fa-paper-plane-o" aria-hidden="true"></i><span class="d-none d-lg-block ml-1">Send</span></button>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from "vuex";


    export default {
        props:['Friend','chat'],
        name: "ChatBox",
        data(){
            return{
                message:'',
                ChatMessages:[],
                typing: false,
                typingTo:0,
                to:0,
                isSent:false,
                showEmoji:false,
                isOnlyEmot:false,
                images:[
                    'https://cdn.hipwallpaper.com/i/77/4/gIx0SV.jpg'
                ]
            }
        },
        computed:{
            ...mapGetters([
                'getUserInfo'
            ])
        },
        methods:{
            openEmoji(){
                setTimeout(this.ScrollToEnd,100)
                this.showEmoji = !this.showEmoji
            },
            selectEmoji(emoji) {
                if(this.message == ''){
                    this.isOnlyEmot = true;
                    this.message = emoji.data
                }else{
                    this.isOnlyEmot = false;
                    this.message = this.message + ' ' + emoji.data
                }
            },
            SendMessage(){
                if(this.message == ''){
                    return
                }else{
                    var type = ""
                    if(this.isOnlyEmot){
                        type = "emoji";
                    }else {
                        type = "message";
                    }
                    this.showEmoji = false
                    this.isSent = true
                    setTimeout(this.ScrollToEnd,100)
                    this.axios.post('/api/SendMessage',{message:this.message,to:this.Friend.id,type:type}).then((response) => {
                        this.ChatMessages.unshift(response.data)
                        this.isSent = false
                        this.message= ''
                        this.showEmoji = false
                        setTimeout(this.ScrollToEnd,100)
                    }).catch((error)=>{
                        this.isSent = false
                        console.log(error)
                    });
                }
            },
            GetMessage(user){
                this.axios.post('/api/GetMessage',{user_id:user.id}).then((response) => {
                    this.ChatMessages = response.data.data;
                    setTimeout( this.ScrollToEnd,100)
                }).catch((error)=>{
                    console.log(error)
                });
            },
            ScrollToEnd(){
                document.getElementById('scroller').scrollTo(0,999999);
            },
            listen(){
                let _this = this;
                Echo.private('ChatMessages.' + this.getUserInfo.id)
                    .listen('MessageEvent', (e) => {
                        this.ChatMessages.unshift(e.message)
                        this.typing = false;
                        setTimeout(this.ScrollToEnd,100)
                    })
                .listenForWhisper('typing', (e) => {
                    this.typing = e.typing;
                    this.typingTo = e.to;
                    document.getElementById('scroller').scrollTo(0,999999);
                    // remove is typing indicator after 0.9s
                    setTimeout(function() {
                        _this.typing = false
                    }, 10000);
                });
            },
            isTyping() {
                this.isOnlyEmot = false;
                let channel = Echo.private('ChatMessages.' + this.to);
                document.getElementById('scroller').scrollTo(0,999999);
                var vm = this
                setTimeout(function() {
                    channel.whisper('typing', {
                        typing: true,
                        to:vm.getUserInfo.id
                    });
                }, 100);
            },
        },
        created(){
            something.$on('getMessageEvent',(Friend)=>{
                this.message= ''
                this.showEmoji = false
                this.to = Friend.id
                this.GetMessage(Friend);
            });
        },
        mounted() {
            setTimeout( this.listen,9000);
        },
    }
</script>

<style scoped>
    .chat-box{
        z-index: 1;
        position: fixed;
        right: 300px;
        bottom: 0px;
        background: white;
        width: 500px;
        border-radius: 5px 5px 0px 0px;
    }

    .chat-head h2{
        color: white;
        padding: 8px;
        display: inline-block;
    }
    .chat-head img{
        cursor: pointer;
        float: right;
        width: 25px;
        margin: 10px;
    }


    .chat-text textarea{
        width: inherit;
        height: inherit;
        box-sizing: border-box;
        border: 2px solid black;
        padding: 10px;
        resize: none;
    }
    .chat-text textarea:active, .chat-text textarea:focus, .chat-text textarea:hover{
        border-color: royalblue;
    }

    .attachmnt{
        background-color: darkgray;
        margin-bottom: 10px;
    }
    .item:hover {
        border:2px solid red;
        background: #ff443d;
    }


</style>

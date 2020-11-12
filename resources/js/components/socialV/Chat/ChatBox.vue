<template>
    <div class="wrapper">
        <div class="chat-box">
            <header class="d-flex justify-content-between align-items-center bg-white pt-3 pr-3 pb-3">
                <div class="d-flex align-items-center">
                    <div class="sidebar-toggle">
                        <i class="ri-menu-3-line"></i>
                    </div>
                    <div class="avatar chat-user-profile m-0 mr-3" @click="showChatUserInfo = !showChatUserInfo" style="cursor:pointer" >
                        <img :src="Friend.profile_photo_url" alt="avatar" class="avatar-50 " style="margin-left: 8px">
                        <span class="avatar-status"><i class="ri-checkbox-blank-circle-fill" :class="{'text-success':Friend.status == 'online'}"></i></span>
                    </div>
                    <h5 class="mb-0">{{Friend.name}}</h5>
                </div>
                <div class="chat-user-detail-popup" :class="{'show':showChatUserInfo}">
                    <div class="user-profile text-center">
                        <button type="submit" class="close-popup p-3"><i class="ri-close-fill"></i></button>
                        <div class="user mb-4">
                            <a class="avatar m-0">
                                <img :src="Friend.profile_photo_url" alt="avatar">
                            </a>
                            <div class="user-name mt-4">
                                <h4>{{Friend.name}}</h4>
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
                    <a href="javascript:void(0);" @click="Call(Friend)" class="chat-icon-video iq-bg-primary">
                        <i class="ri-vidicon-line"></i>
                    </a>
                    <a href="javascript:void(0);" class="chat-icon-delete iq-bg-primary" @click="closeChat">
                        <i class="fa fa-times"></i>
                    </a>
                    <span class="dropdown iq-bg-primary"  @click="showChatOptions = !showChatOptions">
                       <i class="ri-more-2-line cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer pr-0" id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu" @click="showChatOptions = !showChatOptions"></i>
                       <span class="dropdown-menu dropdown-menu-right" :class="{'show':showChatOptions}" aria-labelledby="dropdownMenuButton02">
                       <a class="dropdown-item" href="JavaScript:void(0);"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Pin to top</a>
                       <a class="dropdown-item" href="JavaScript:void(0);" @click="DeleteChat(Friend)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Conversation</a>
                       <a class="dropdown-item" href="JavaScript:void(0);"><i class="fa fa-ban" aria-hidden="true"></i> Block</a>
                       </span>
                    </span>
                </div>
            </header>

            <div class="chat-content scroller" id="scroller" style="background:url('../images/page-img/100.jpg')">
                <div class="chat" v-for="(chat,index) in ChatMessages.slice().reverse()" :class="{'chat-left': Friend.id == chat.from}" @mouseover="messageHover(index)"  @mouseleave="isHover = false;showMsgOptions=false">
                    <div class="chat-user" >
                     <span v-if="isHover && hovermsg==index">
                       <a class="dropdown-item" href="JavaScript:void(0);" @click="DeleteMsg(chat)"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove </a>
                       <a class="dropdown-item" href="JavaScript:void(0);" @click="DeleteForEveryone(chat)" v-if="chat.from == getUserInfo.id && chat.type !=  'DeleteForEveryone'"><i class="fa fa-eraser" aria-hidden="true"></i> Delete for everyone </a>
                       <a class="dropdown-item" href="JavaScript:void(0);" @click="ReplayMsg(chat)" v-if="chat.type !=  'DeleteForEveryone'"> <i class="fa fa-reply" aria-hidden="true" ></i> Replay</a>

                    </span>
                  <span v-else>
                        <a  class="avatar m-0" v-if="chat.type == 'emoji' || chat.type == 'message' || chat.type == 'removed' && chat.who != getUserInfo.id ">
                            <img :src="Friend.profile_photo_url" v-if="Friend.id == chat.from" alt="avatar" class="avatar-35 ">
                            <img :src="getUserInfo.profile_photo_url" v-if="Friend.id != chat.from" alt="avatar" class="avatar-35 ">
                        </a>
                                  <span class="chat-time mt-1" v-if="chat.type == 'emoji' || chat.type == 'message'"><TimeAgo :refresh="60" :datetime="chat.created_at" locale="en" tooltip></TimeAgo>
                                  <span v-if="index == ChatMessages.length -1" v-show="chat.read != null && chat.from == getUserInfo.id" > (  <img src="images/icon/eye-125-141484.png"  alt="seen" style="width:25px;height:20px;"  >) </span>
                                   <span v-if="index == ChatMessages.length - 2" v-show="chat.read != null && chat.from == getUserInfo.id" > (  <img src="images/icon/eye-125-141484.png"  alt="seen" style="width:25px;height:20px;"  >) </span>
                        </span>
                  </span>
                        </span>
                    </div>
                    <div class="chat-detail" v-if=" chat.type == 'emoji' || chat.type == 'message' || chat.type == 'removed' && chat.who != getUserInfo.id " v-linkified  >
                        <div class="chat-message">
                            <p v-if="chat.type == 'message'" style="font-size: 19px" v-text="chat.message"  ></p>
                            <p style="font-size: 70px" v-if="chat.type == 'emoji'" v-text="chat.message"   ></p>
                            <p style="font-size: 19px" v-if="chat.type == 'removed' && chat.who != getUserInfo.id" v-text="chat.message"></p>
                            <ChatAttachments  :files="chat.attachments" v-if="chat.attachment == 'yes'"></ChatAttachments>
                        </div>
                    </div>
                    <div class="chat-detail" v-if=" chat.type ==  'DeleteForEveryone' "  >
                        <div class="chat-message" style="background-color:#146c80">
                            <p style="font-size: 19px;"  v-text="'Message Deleted'"></p>
                            <ChatAttachments  :files="chat.attachments" v-if="chat.attachment == 'yes'"></ChatAttachments>
                        </div>
                    </div>
                    <div>
                             <span class="chat-time mt-1" style="color:red" v-if="chat.type == 'callMissed' && chat.to == getUserInfo.id">
                              <b> You Missed Call at <TimeAgo :refresh="60" :datetime="chat.created_at" locale="en" tooltip></TimeAgo></b>

                             </span>
                            <span class="chat-time mt-1" style="color:red" v-if="chat.type == 'callMissed' && chat.from == getUserInfo.id">
                              <b> You Called With No Responde at <TimeAgo :refresh="60" :datetime="chat.created_at" locale="en" tooltip></TimeAgo></b>
                             </span>
                             <span class="chat-time mt-1" style="color:blue" v-if="chat.type == 'callEnd'">
                                Call End
                             </span>
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
                    <img  v-for="(img,index) in image" class="img-thumbnail item" :src="img" style="width: 50px;height: 50px ;cursor: pointer" @click="deleteImage(index)" alt="">
                    <video v-for="(vid,index) in video" :src="vid" class="embed-responsive-item item" style="width: 90px;height: 90px;cursor:pointer " @click="Deletevid(index)"></video>
                </div>
                <form class="d-flex align-items-center"  action="javascript:void(0);">
                    <div class="chat-attagement d-flex">
                        <a href="javascript:void(0);" @click="openEmoji"><i class="fa fa-smile-o pr-3" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);" @click="$refs.UploadAttachment.click()"><i class="fa fa-paperclip pr-3" aria-hidden="true"></i></a>
                        <input type="file" style="display:none" @change="UploadAttachments($event)" ref="UploadAttachment" alt="" multiple>
                    </div>
                    <input type="text" class="form-control mr-3" placeholder="Type your message" @keydwon.enter="SendMessage" @keydown="isTyping()" @click="Seen"  v-model="message">
                    <button type="submit" class="btn btn-primary d-flex align-items-center p-2" @click="SendMessage" ><i class="fa fa-paper-plane-o" aria-hidden="true"></i><span class="d-none d-lg-block ml-1">Send</span></button>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import ChatAttachments from "../NewsFeed/ChatAttachments";
    import TimeAgo from 'vue2-timeago'
    export default {
        props:['Friend','chat'],
        name: "ChatBox",
        components:{
            ChatAttachments,
            TimeAgo
        },
        data(){
            return{
                showMsgOptions:false,
                hovermsg:null,
                isHover:false,
                showChatUserInfo:false,
                showChatOptions:false,
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
                ],
                image:[],
                video:[],
            }
        },
        computed:{
            ...mapGetters([
                'getUserInfo'
            ]),
        },
        methods:{
            DeleteForEveryone(msg){
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Once you Delete  this Message, it cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.axios.post('/api/DeleteForEveryone',{msg_id:msg.id}).then((response) => {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your Message has been Deleted.',
                                'success'
                            )
                            msg.type = "bothremoved";
                            msg.who = 0;
                        }).catch((error)=>{
                            console.log(error)
                        });

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your Message is safe :)',
                            'error'
                        )
                    }
                })
            },
            ReplayMsg(msg){
                    console.log(msg)
            },
            DeleteMsg(msg){
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Once you Remove your copy of this Message, it cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.axios.post('/api/removeMsg',{msg_id:msg.id}).then((response) => {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your Message has been Removed.',
                                'success'
                            )
                            if(msg.who == null){
                                msg.type = "removed";
                                msg.who = this.getUserInfo.id;
                            }else{
                                msg.type = "bothremoved";
                                msg.who = 0;
                            }
                        }).catch((error)=>{
                            console.log(error)
                        });

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your Message is safe :)',
                            'error'
                        )
                    }
                })
            },
            messageHover(index){
                  this.hovermsg = index
                this.isHover = true;
            },
            DeleteChat(user){
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Once you delete your copy of this conversation, it cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.axios.post('/api/DeleteChat',{user_id:user.id}).then((response) => {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your Conversation has been deleted.',
                                'success'
                            )
                            this.ChatMessages = [];
                        }).catch((error)=>{
                            console.log(error)
                        });

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your conversation is safe :)',
                            'error'
                        )
                    }
                })
            },
            closeChat(){
                something.$emit('CloseChat');
            },
            Call(user){
                this.$store.state.showCall = true;
                something.$emit('Call',user);
            },
            Seen(){
                var len =   this.ChatMessages.length
                if(len != 0){
                var isread = this.ChatMessages[0].read;
                var isme = this.ChatMessages[0].from;
                if(isme != this.getUserInfo.id && isread == null)
                {
                    this.axios.post('/api/MessageSeen',{message_id:this.ChatMessages[0].id}).then((response) => {
                        console.log(response)
                        this.ChatMessages[0].read = response.data.read
                    }).catch((error)=>{
                        console.log(error)
                    });
                    let channel = Echo.private('ChatMessages.' + this.to);
                    channel.whisper('seen', {
                        message_id:this.ChatMessages[0].id,
                    });
                }
          }


            },
            deleteImage(i){
                this.image.splice(i,1);
            },
            Deletevid(i){
                this.video.splice(i,1);
            },
            UploadAttachments(event){
                for (let file of event.target.files) {
                    try {
                        let reader = new FileReader();
                        if(file['type']==='image/jpeg' || file['type']==='image/png'){
                            if(file['size'] < 2111775){
                                reader.onloadend = (file) =>{
                                    this.image.push(reader.result);
                                }
                            }else{

                            }
                        }else if( file['type']==='video/mp4'){

                            reader.onloadend = (file) =>{
                                this.video.push(reader.result);
                            }
                        }else{

                        }

                        reader.readAsDataURL(file);
                    } catch {

                    }

                }
            },
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

                if(this.message == '' && this.image.length == 0 && this.video.length == 0){
                   return;
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
                    this.axios.post('/api/SendMessage',{message:this.message,to:this.Friend.id,type:type,image:this.image,video:this.video}).then((response) => {
                        this.ChatMessages.unshift(response.data)
                        this.image = [];
                        this.video = []
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
                }) .listenForWhisper('seen', (e) => {
                    this.ChatMessages[0].read = "yes";
                    document.getElementById('scroller').scrollTo(0,999999);
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
    .testmsg {
        background-color:red
    }
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

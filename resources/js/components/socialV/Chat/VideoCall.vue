<template>
    <div>
        <div class="header-for-bg">
            <div class="background-header position-relative">
                <img src="images/page-img/profile-bg9.jpg" class="img-fluid w-100 rounded rounded" alt="profile-bg">
                <div class="title-on-header">
                    <div class="data-block">
                    <!--                        -->
                        <div v-if="icall==true && showCallVideo==false && isHeCancel == false && IsCallEnd==true">
                            <div v-if="!callInProgress">
                                <h1>Do You Want To Call  {{user.name}} ?</h1>
                                <button @click="NoCancel" class="btn btn-outline-secondary rounded-pill mb-3">No Cancel</button>
                                <button @click="Call" class="btn btn-outline-success rounded-pill mb-3">Yes Call</button>
                            </div>
                            <div v-if="callInProgress">
                                <h1>You Are Calling...</h1>
                                <button @click="CancelCall" class="btn btn-outline-danger rounded-pill mb-3">Cancel Call</button>
                            </div>

                        </div>

                    <!--                -->
                        <div v-if="isHeCancel">
                            <h1>{{user.name}} Rejected Your Call.   </h1>
                            <button @click="NoCancel" class="btn btn-outline-info rounded-pill mb-3">Ok. Go Back</button>
                            <button @click="Call" class="btn btn-outline-success rounded-pill mb-3">Call Again</button>
                        </div>
                        <div v-if="!IsCallEnd">
                            <h1>The Call Is Ended How It Was ?   </h1>
                            <button @click="NoCancel" class="btn btn-outline-info rounded-pill mb-3">Ok. Go Back</button>
                        </div>
                        <div v-if="igotCall==true && showCallVideo==false && IsCallEnd==true">
                            <div v-if="callInProgress">
                                <h1>You Got Call From {{whoIsCalling.name}}</h1>
                                <button @click="NoCancelCall" class="btn btn-outline-danger rounded-pill mb-3">Cancel Call</button>
                                <button @click="Accept" class="btn btn-outline-success rounded-pill mb-3">Accept Call</button>
                            </div>
                        </div>
                    <!--                        -->
                        <div  v-show="showCallVideo">
                            <h1 class="text-center">You Are Talking With  {{igotCall == true ? whoIsCalling.name : user.name }}</h1>
                            <div class="video-container" ref="video-container">
                                <video class="video-here" ref="video-here" autoplay></video>
                                <video class="video-there" ref="video-there" autoplay></video>
                            </div>
                            <button @click="EndCall" class="btn btn-outline-danger rounded-pill mb-3">End Call</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div>
            <audio
                ref="audio"
                src="/audio/video_tronics.mp3"
                preload
                loop
                id="audio"
                muted="muted"
            ></audio>
        </div>



    </div>
</template>

<script>
    import Pusher from 'pusher-js';
    import Peer from 'simple-peer';
    export default {
        name: "VideoCall",
        data(){
            return {
                user:[],
                icall:true,
                igotCall:false,
                showCallVideo:false,
                whoIsCalling:[],
                isHeCancel:false,
                channel: null,
                stream: null,
                IsCallEnd:true,
                callInProgress:false,
                peers: {},
                peer:null,
                pusherKey:'1059af4a7bb544febd4f',
                pusherCluster:'eu'
            }
        },
        methods:{
            stopBothVideoAndAudio(stream) {
                stream.getTracks().forEach(function(track) {
                    if (track.readyState == 'live') {
                        track.stop();
                    }
                  });
           },
            EndCall(){
                this.peer.destroy();
                var id ;
                if(this.igotCall == true){
                    id =  this.whoIsCalling.id
                }else{
                    id =  this.user.id
                }
                let channel = Echo.private('VedioCallRuning.' + id);
                this.callInProgress = false
                this.IsCallEnd = false
                this.showCallVideo=false
                this.stopBothVideoAndAudio(this.stream)
                setTimeout( function(){
                    channel.whisper('EndCall', {
                        EndCall:false
                    });
                },1000);


            },
            NoCancelCall(){
                let channel = Echo.private('VedioCallRuning.' + this.whoIsCalling.id);
                this.callInProgress = false
                this.$store.state.showCall = false
                this.IsCallEnd = true
                this.$refs.audio.pause()
                setTimeout( function(){
                    channel.whisper('NoCancelCall', {
                        CancelCall:true
                    });
                },1000);
            },
            CancelCall(){
                let channel = Echo.private('VedioCallRuning.' + this.user.id);
                this.callInProgress = false
                this.$store.state.showCall = false
                this.isHeCancel = false
                this.IsCallEnd = true
                this.$refs.audio.pause()
                setTimeout( function(){
                    channel.whisper('CancelCall', {
                        CancelCall:true
                    });
                },1000);
            },
            NoCancel(){
                this.isHeCancel = false
                this.$store.state.showCall = false
                this.IsCallEnd = true
                this.$refs.audio.pause()
            },
            startVideoChat(userId) {
                this.getPeer(userId, true);
            },
            getPeer(userId, initiator) {
                if(this.peers[userId] === undefined) {
                     this.peer = new Peer({
                        initiator,
                        stream: this.stream,
                        trickle: false
                    });
                    this.peer.on('signal', (data) => {
                        console.log('signal')
                        this.channel.trigger(`client-signal-${userId}`, {
                            userId: this.$store.state.user.id,
                            data: data
                        });
                    })
                     .on('stream', (stream) => {
                            console.log('stream')
                            const videoThere = this.$refs['video-there'];
                            try {
                                videoThere.srcObject = stream;
                            } catch (e) {
                                videoThere.src = URL.createObjectURL(stream);
                            }
                        })
                        .on('close', () => {
                            console.log('close')
                            const peer = this.peers[userId];
                            if(peer !== undefined) {
                                peer.destroy();
                            }
                            delete this.peers[userId];
                        });
                    this.peers[userId] = this.peer;
                }
                return this.peers[userId];
            },
            getPusherInstance() {
                return new Pusher(this.pusherKey, {
                    authEndpoint: '/auth/video_chat',
                    cluster: this.pusherCluster,
                    auth: {
                        headers: {
                            'X-CSRF-Token': crfToken
                        }
                    }
                });
            },
            async ConnectToVideoCall(){
                const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                const videoHere = this.$refs['video-here'];
                try {
                    videoHere.srcObject = stream;
                } catch (e) {
                    videoHere.src = URL.createObjectURL(stream);
                }
                this.stream = stream;
            },
            Accept(){
                let channel = Echo.private('VedioCallRuning.' + this.whoIsCalling.id);
                let vm = this
                this.IsCallEnd = true
                this.$refs.audio.pause()
                setTimeout( function(){
                    channel.whisper('Accept', {
                        acepted: true,
                    });
                },1000);
                this.showCallVideo = true;
                this.ConnectToVideoCall();
                setTimeout( function(){
                    vm.startVideoChat(vm.whoIsCalling.id);
                },5000);
            },
            Call(){
                this.icall = true
                this.igotCall = false
                this.callInProgress = true
                this.isHeCancel = false
                this.IsCallEnd = true
                this.playCallSong();
                let vm = this
                let channel = Echo.private('VedioCallRuning.' + this.user.id);
                setTimeout( function(){
                    channel.whisper('call', {
                        fromWho: vm.$store.state.user,
                    });
                },1000);
            },

            async  playCallSong() {
                try {
                    await   this.$refs.audio.play()

                } catch(err) {
                    console.log(err)
                }
            },
            listen(){
                let _this = this;
                Echo.private('VedioCallRuning.' + this.$store.state.user.id)
                    .listenForWhisper('call', (e) => {
                        this.igotCall =true
                        this.icall= false
                        this.IsCallEnd = true
                        this.$store.state.showCall = true
                        this.callInProgress = true
                        this.whoIsCalling = e.fromWho
                        this.playCallSong();

                    })
               .listenForWhisper('Accept', (e) => {
                            this.ConnectToVideoCall();
                            this.showCallVideo=true
                            this.$refs.audio.pause()

                }).listenForWhisper('CancelCall', (e) => {
                    this.igotCall = false
                    this.$store.state.showCall = false
                    this.$refs.audio.pause()

                }).listenForWhisper('NoCancelCall', (e) => {
                    this.isHeCancel = true
                    this.callInProgress = false
                    this.$refs.audio.pause()
                }).listenForWhisper('EndCall', (e) => {
                    this.peer.destroy();
                    this.callInProgress = false
                    this.IsCallEnd = false
                    this.showCallVideo=false
                    this.stopBothVideoAndAudio(this.stream)
                    this.$refs.audio.pause()
                });
            },
            async setupVideoChat() {
                // To show pusher errors
                // Pusher.logToConsole = true;
                const pusher = this.getPusherInstance();
                this.channel = pusher.subscribe('presence-video-chat');
                this.channel.bind(`client-signal-${this.$store.state.user.id}`, (signal) =>
                {
                    const peer = this.getPeer(signal.userId, false);
                    peer.signal(signal.data);
                });
            },
        },
        mounted() {
             this.listen()
             this.setupVideoChat();
        },
        created(){
            something.$on('Call',(Friend)=>{
                this.user = Friend
                this.icall = true
            });
        }
    }
</script>

<style scoped>
    .video-container {
        width: 500px;
        height: 380px;
        margin: 8px auto;
        border: 5px solid #03d3fc;
        position: relative;
        box-shadow: 1px 1px 1px #9e9e9e;
    }
    .video-here {
        width: 130px;
        position: absolute;
        left: 10px;
        bottom: 16px;
        border: 1px solid #000;
        border-radius: 2px;
        z-index: 2;
    }
    .video-there {
        width: 100%;
        height: 100%;
        z-index: 1;
    }
    .text-right {
        text-align: right;
    }
</style>

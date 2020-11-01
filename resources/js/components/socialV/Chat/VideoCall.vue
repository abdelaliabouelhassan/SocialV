<template>
    <div>
        <div class="container">
        <div v-if="icall==true && showCallVideo==false">
           <h1>You Are Calling {{user.name}}</h1>
            <button @click="Cancel">Cancel Call</button>
            <button @click="Call">Call</button>
        </div>
        <div v-if="igotCall==true && showCallVideo==false">
            You Got Call From {{whoIsCalling.name}}
            <button @click="Cancel">Cancel Call</button>
            <button @click="Accept">Accept Call</button>
        </div>
        </div>
        <div class="container" v-show="showCallVideo">
            <h1 class="text-center">You Are Talking With  {{igotCall == true ? whoIsCalling.name : user.name }}</h1>
            <div class="video-container" ref="video-container">
                <video class="video-here" ref="video-here" autoplay></video>
                <video class="video-there" ref="video-there" autoplay></video>
            </div>
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
                channel: null,
                stream: null,
                peers: {},
                pusherKey:'1059af4a7bb544febd4f',
                pusherCluster:'eu'
            }
        },
        methods:{
            startVideoChat(userId) {
                this.getPeer(userId, true);
            },
            getPeer(userId, initiator) {
                if(this.peers[userId] === undefined) {
                    let peer = new Peer({
                        initiator,
                        stream: this.stream,
                        trickle: false
                    });
                    peer.on('signal', (data) => {
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
                    this.peers[userId] = peer;
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
                setTimeout( function(){
                    channel.whisper('Accept', {
                        acepted: true,
                    });
                },1000);
                this.showCallVideo = true;
                this.ConnectToVideoCall();
                setTimeout( function(){
                    vm.startVideoChat(vm.whoIsCalling.id);
                },3000);
            },
            Call(){
                this.icall = true
                this.igotCall = false
                let vm = this
                let channel = Echo.private('VedioCallRuning.' + this.user.id);
                setTimeout( function(){
                    channel.whisper('call', {
                        fromWho: vm.$store.state.user,
                    });
                },1000);
            },
            Cancel(){

            },
            listen(){
                let _this = this;
                Echo.private('VedioCallRuning.' + this.$store.state.user.id)
                    .listenForWhisper('call', (e) => {
                        this.igotCall =true
                        this.icall= false
                        this.$store.state.showCall = true
                        this.whoIsCalling = e.fromWho
                    })
               .listenForWhisper('Accept', (e) => {
                            this.ConnectToVideoCall();
                            this.showCallVideo=true

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
            });
        }
    }
</script>

<style scoped>
    .video-container {
        width: 500px;
        height: 380px;
        margin: 8px auto;
        border: 3px solid #000;
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

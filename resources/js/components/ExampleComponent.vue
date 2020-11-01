<template>
    <div class="container">
        <h1 class="text-center">Laravel Video Chat</h1>
        <div class="video-container" ref="video-container">
            <video class="video-here" ref="video-here" autoplay></video>
            <video class="video-there" ref="video-there" autoplay></video>
                <button @click="startVideoChat(2)" v-text="'Call Random'"/>
        </div>
    </div>
</template>
<script>
    import Pusher from 'pusher-js';
    import Peer from 'simple-peer';
    export default {
        props: ['user', 'others'],
        data() {
            return {
                channel: null,
                stream: null,
                peers: {},
                pusherKey:'1059af4a7bb544febd4f',
                pusherCluster:'eu'
            }
        },
        mounted() {
            this.setupVideoChat();
        },
        methods: {
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
            async setupVideoChat() {
                // To show pusher errors
                // Pusher.logToConsole = true;
                const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                const videoHere = this.$refs['video-here'];
                try {
                    videoHere.srcObject = stream;
                } catch (e) {
                    videoHere.src = URL.createObjectURL(stream);
                }
                this.stream = stream;
                const pusher = this.getPusherInstance();
                this.channel = pusher.subscribe('presence-video-chat');
                this.channel.bind(`client-signal-${this.$store.state.user.id}`, (signal) =>
                {
                    const peer = this.getPeer(signal.userId, false);
                    peer.signal(signal.data);
                });
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
            }
        }
    };
</script>
<style>
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

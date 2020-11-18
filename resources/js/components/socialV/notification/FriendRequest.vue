<template>
    <li class="nav-item">
        <a class="search-toggle iq-waves-effect" href="javascript:void(0);"><i class="ri-group-line"></i>
            <span class="bg-primary count-mail" v-show="FriendRequests.length != 0"></span>

        </a>
        <div class="iq-sub-dropdown iq-sub-dropdown-large">
            <div class="iq-card shadow-none m-0">
                <div class="iq-card-body p-0 ">
                    <div class="bg-primary p-3">
                        <h5 class="mb-0 text-white">Friend Request<small class="badge  badge-light float-right pt-1">{{FriendRequests.length}}</small></h5>
                    </div>
                    <div class="iq-friend-request" v-for="(frRequest,index) in FriendRequests">
                        <div class="iq-sub-card iq-sub-card-big d-flex align-items-center justify-content-between" >
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <img class="avatar-40 rounded" :src="frRequest.image" :alt="frRequest.name">
                                </div>
                                <div class="media-body ml-3">
                                    <h6 class="mb-0 ">{{frRequest.name}}</h6>
                                    <p class="mb-0">Send You Friend Request</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="javascript:void(0);" class="mr-3 btn btn-primary rounded" @click="ConfirmRequest(frRequest,index)">Confirm</a>
                                <a href="javascript:void(0);" class="mr-3 btn btn-secondary rounded" @click="DeleteRequest(frRequest,index)">Delete Request</a>
                            </div>
                        </div>
                    </div>


                    <div class="text-center">
                        <a v-if="FriendRequests.length != 0 && FriendRequests.length >= 8" href="#" class="mr-3 btn text-primary">View More Request</a>
                        <b>You Dont Have Any Requests</b>
                    </div>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        data(){
            return{
                FriendRequests:[]
            }
        },
        name: "FriendRequest",
        computed:{
            ...mapGetters([
                'getUserInfo'
            ])
        },
        methods:{
            ConfirmRequest(request,index){
                this.$Progress.start();
                this.axios.post('/api/ConfirmRequest',{user_id:request.id}).then((response) => {
                    this.FriendRequests.splice(index,1);
                    this.$Progress.finish();
                    something.$emit('ReloadFriends');
                }).catch((error)=>{
                    this.$Progress.fail()
                    console.log(error)
                })
            },
            DeleteRequest(request,index){
                this.$Progress.start();
                this.axios.post('/api/DeleteRequest',{user_id:request.id}).then((response) => {
                    this.FriendRequests.splice(index,1);
                    this.$Progress.finish();
                }).catch((error)=>{
                    console.log(error)
                    this.$Progress.fail()
                });
            },
            LoadFriendRequests()
            {
                this.axios.get('/api/LoadFriendRequests').then((response) => {
                    this.FriendRequests = response.data;
                }).catch((error)=>{
                    console.log(error)
                })
            }
        },
        created(){
            something.$on('loadRequest',()=>{
                this.LoadFriendRequests();
            });
            this.LoadFriendRequests();
        },
        mounted(){
            //events for Friend Requests
            Echo.private('SendFriendRequest')
                .listen('FriendRequestEvent', (e) => {
                    if(e.user_id == this.getUserInfo.id ){
                        console.log(e)
                        if(e.type == 'request'){
                            this.FriendRequests.push(e.user)
                            Toast.fire({
                                icon: 'info',
                                title: 'You Have New Friend Request from ' + e.user.name
                            })
                        }
                        if(e.type == 'accepted'){
                            Toast.fire({
                                icon: 'info',
                                title: e.user.name +' Accept Your Request '
                            })
                            something.$emit('ReloadFriends');
                        }
                        if(e.type == 'denied'){
                            Toast.fire({
                                icon: 'info',
                                title: e.user.name +' denied Your Request '
                            })
                        }

                    }

                });

        }
    }
</script>

<style scoped>

</style>

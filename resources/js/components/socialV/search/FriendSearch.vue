<template>
        <div>
            <div class="header-for-bg">
                <div class="background-header position-relative">
                    <img src="images/page-img/profile-bg3.jpg" class="img-fluid w-100" alt="header-bg">
                    <div class="title-on-header">
                        <div class="data-block">
                            <h2>Find Friends</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content  -->
            <div id="content-page" class="content-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6" v-for="fr in GetFindFriendsSearch">
                            <div class="iq-card">
                                <div class="iq-card-body profile-page p-0">
                                    <div class="profile-header-image">
                                        <div class="cover-container">
                                            <img src="images/page-img/profile-bg2.jpg" alt="profile-bg" class="rounded img-fluid w-100">
                                        </div>
                                        <div class="profile-info p-4">
                                            <div class="user-detail">
                                                <div class="d-flex flex-wrap justify-content-between align-items-start">
                                                    <div class="profile-detail d-flex">
                                                        <div class="profile-img pr-4">
                                                            <img :src="fr.profile_photo_url" alt="profile-img" style="height:100px;width:100px;" class="avatar-130 img-fluid" />
                                                        </div>
                                                        <div class="user-data-block">
                                                            <h4 class="">{{fr.name}}</h4>
                                                            <h6>@designer</h6>
                                                            <p>Lorem Ipsum is simply dummy text of the</p>
                                                        </div>
                                                    </div>

                                                    <span v-if="!fr.isFriend && fr.Tohim == false && fr.Tome == false">
                                                        <button type="submit" class="btn btn-primary"  v-show="getUserInfo.id != fr.id" @click="addFriend(fr)" >Add Friend</button>
                                                    </span>
                                                    <span v-if="fr.isFriend && fr.Tohim == false && fr.Tome == false">
                                                        <button type="submit" class="btn btn-danger" v-show="getUserInfo.id != fr.id" @click="unFriend(fr)">Un Friend</button>
                                                    </span>
                                                    <span v-if="fr.Tohim && !fr.Tome">
                                                        <button type="submit" class="btn btn-info"  v-show="getUserInfo.id != fr.id" @click="cancelRequest(fr)">Cancel Request</button>
                                                    </span>
                                                    <span v-if="fr.Tome && !fr.Tohim">
                                                        <button type="submit" class="btn btn-success" v-if="fr.Tome" v-show="getUserInfo.id != fr.id" @click="ConfirmRequest(fr)">Accept Request</button>
                                                    </span>
                                                    <span>
                                                          <h4 class="bg bg-info text-black-50" v-show="getUserInfo.id == fr.id">You</h4>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center" v-if="GetFindFriendsSearch.length == 0">
                            <img src="images/page-img/page-load-loader.gif" alt="loader" style="height: 100px;">
                        </div>
                    </div>
                </div>
            </div>

        </div>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        methods:{
            unFriend(Friendrequest){
                this.axios.post('/api/UnFriend',{user_id:Friendrequest.id}).then((response) => {
                    console.log(response)
                    this.$Progress.finish();
                    Friendrequest.isFriend = false
                    Friendrequest.Tohim = false
                    Friendrequest.Tome = false
                }).catch((error)=>{
                    this.$Progress.fail()
                    console.log(error)
                })
            },
            ConfirmRequest(Friendrequest){
                this.$Progress.start();
                this.axios.post('/api/ConfirmRequest',{user_id:Friendrequest.id}).then((response) => {
                    console.log(response)
                    this.$Progress.finish();
                    Friendrequest.isFriend = true
                    Friendrequest.Tohim = false
                    Friendrequest.Tome = false
                    something.$emit('loadRequest');
                }).catch((error)=>{
                    this.$Progress.fail()
                    console.log(error)
                })
            },
            cancelRequest(Friendrequest){
                this.$Progress.start();
                this.axios.post('/api/CancelRequest',{user_id:Friendrequest.id}).then((response) => {
                    Friendrequest.Tohim = false;
                    console.log(response)
                    console.log(Friendrequest)
                    this.$Progress.finish();
                }).catch((error)=>{
                    console.log(error)
                    this.$Progress.fail()
                });
            },
            addFriend(Friend){
                this.$Progress.start();
                this.axios.post('/api/AddFriend',{user_id:Friend.id}).then((response) => {
                        Friend.Tohim = true;
                        console.log(response)
                    this.$Progress.finish();
                }).catch((error)=>{
                    console.log(error)
                    this.$Progress.fail()
                });
            }
        },
        computed:{
            ...mapGetters([
                'GetFindFriendsSearch',
                'getUserInfo'
            ]),
        },
        name: "FriendSearch"
    }
</script>

<style scoped>

</style>

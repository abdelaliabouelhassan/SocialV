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
                                                        <button type="submit" class="btn btn-danger" v-show="getUserInfo.id != fr.id">Un Friend</button>
                                                    </span>
                                                    <span v-if="fr.Tohim && !fr.Tome">
                                                        <button type="submit" class="btn btn-info"  v-show="getUserInfo.id != fr.id">Cancel Request</button>
                                                    </span>
                                                    <span v-if="fr.Tome && !fr.Tohim">
                                                        <button type="submit" class="btn btn-success" v-if="fr.Tome" v-show="getUserInfo.id != fr.id">Accept Request</button>
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
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        methods:{
            addFriend(Friend){
                this.axios.post('/api/AddFriend',{user_id:Friend.id}).then((response) => {
                        Friend.Tohim = true;
                        console.log(response)
                }).catch((error)=>{
                    console.log(error)
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

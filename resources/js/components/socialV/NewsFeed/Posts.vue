<template>
    <div>
    <div v-for="(post,index,id) in posts" :key="id">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-body">
                <div class="user-post-data">
                    <div class="d-flex flex-wrap">
                        <div class="media-support-user-img mr-3">
                            <img class="rounded-circle img-fluid" :src="post.user.profile_photo_url" alt="">
                        </div>
                        <div class="media-support-info mt-2">
                            <h5 class="mb-0 d-inline-block"><a href="#" class="">{{post.user.name}}</a></h5>
                            <p class="mb-0 d-inline-block">Add New Post</p>
                            <p class="mb-0 text-primary">{{post.created_at}}</p>
                        </div>
                        <div class="iq-card-post-toolbar">
                            <div class="dropdown">
                                          <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                          <i class="ri-more-fill"></i>
                                          </span>
                                <div class="dropdown-menu m-0 p-0">
                                    <a class="dropdown-item p-3" href="#">
                                        <div class="d-flex align-items-top">
                                            <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                            <div class="data ml-2">
                                                <h6>Save Post</h6>
                                                <p class="mb-0">Add this to your saved items</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item p-3" href="#">
                                        <div class="d-flex align-items-top">
                                            <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                            <div class="data ml-2">
                                                <h6>Hide Post</h6>
                                                <p class="mb-0">See fewer posts like this.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item p-3" href="#">
                                        <div class="d-flex align-items-top">
                                            <div class="icon font-size-20"><i class="ri-user-unfollow-line"></i></div>
                                            <div class="data ml-2">
                                                <h6>Unfollow User</h6>
                                                <p class="mb-0">Stop seeing posts but stay friends.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item p-3" href="#">
                                        <div class="d-flex align-items-top">
                                            <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                            <div class="data ml-2">
                                                <h6>Notifications</h6>
                                                <p class="mb-0">Turn on notifications for this post</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <p v-if="post.body != null">{{post.body}}</p>
                </div>
                <div style="display: none" v-for="(path,index) in post.files">
                    <p style="display: none">{{filetype = path.type}}</p>
                </div>
                <div class="user-post"  v-if="filetype =='image'">
                    <div id="photo-grid">
                        <socialV-imgrid :box-height="'600px'" :box-width="'100%'"  >
                            <img v-for="(path,index) in post.files" :src="'uploads/SocialVFiles/PostsFiles/' + path.path"  />
                        </socialV-imgrid>
                    </div>
                </div>
                <div class="user-post"  v-else>
                    <video controls  v-for="(path,index) in post.files" class="img-fluid rounded w-100" >
                        <source :src="'uploads/SocialVFiles/PostsFiles/' + path.path" type="video/mp4">
                    </video>
                </div>
                <div class="comment-area mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="like-block position-relative d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="like-data">
                                    <div class="dropdown">
                                                <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                    <a href="javascript:void(0)"  @click="LikePost('Like',post.id,post)" v-show="!post.isLiked" class="img-fluid">Like</a>
                                                    <img src="images/icon/01.png" @click="LikePost('Like',post.id,post)" v-show="post.isLiked" class="img-fluid" alt="">
                                                </span>
                                        <div class="dropdown-menu" v-show="false">
                                            <a class="ml-2 mr-2"  href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like" @click="LikePost('Like',post.id)"><img src="images/icon/01.png" class="img-fluid" alt=""></a>
                                            <a class="mr-2" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love"  @click="LikePost('Love',post.id)"><img src="images/icon/02.png" class="img-fluid" alt=""></a>
                                            <a class="mr-2" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Happy"  @click="LikePost('Happy',post.id)"><img src="images/icon/03.png" class="img-fluid" alt=""></a>
                                            <a class="mr-2" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="HaHa"  @click="LikePost('HaHa',post.id)"><img src="images/icon/04.png" class="img-fluid" alt=""></a>
                                            <a class="mr-2" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Think"  @click="LikePost('Think',post.id)"><img src="images/icon/05.png" class="img-fluid" alt=""></a>
                                            <a class="mr-2" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sade"  @click="LikePost('Sade',post.id)"><img src="images/icon/06.png" class="img-fluid" alt=""></a>
                                            <a class="mr-2" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lovely"  @click="LikePost('Lovely',post.id)"><img src="images/icon/07.png" class="img-fluid" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="total-like-block ml-2 mr-3">
                                    <div class="dropdown">
                                                <span  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                {{post.likeCount}} Likes
                                                </span>
                                        <div class="dropdown-menu" v-show="post.likeCount > 0">
                                            <a v-for="like in post.likes" class="dropdown-item" href="#">{{like.user.name}}</a>
                                            <a  class="dropdown-item" href="#">Other</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="total-comment-block">
                                <div class="dropdown">
                                             <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                             {{post.commentCount}} Comment
                                             </span>
<!--                                    <div class="dropdown-menu">-->
<!--                                        <a class="dropdown-item" v-for="comment in post.comments"  href="#">{{comment.user.name}}</a>-->
<!--                                        <a class="dropdown-item" href="#">Other</a>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div>
                        <div class="share-block d-flex align-items-center feather-icon mr-3">
                            <a href="javascript:void();"><i class="ri-share-line"></i>
                                <span class="ml-1">99 Share</span></a>
                        </div>
                    </div>
                    <hr>
                    <ul class="post-comments p-0 m-0">
                        <li class="mb-2" v-for="comment in post.comments">
                            <div class="d-flex flex-wrap">
                                <div class="user-img">
                                    <img :src="comment.user.profile_photo_url" :alt="comment.user.name" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                    <h6>{{comment.user.name}}</h6>
                                    <p class="mb-0">{{comment.body}}</p>
                                    <div class="d-flex flex-wrap align-items-center comment-activity">
                                        <a href="javascript:void();">like</a>
                                        <a href="javascript:void();">reply</a>
                                        <a href="javascript:void();">translate</a>
                                        <span> {{comment.created_at}} </span>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                    <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                        <input type="text" class="form-control rounded" v-model="commentText[index]" @keyup.enter="createComment(index,post.id)">
                        <div class="comment-attagement d-flex">
                            <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                            <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                            <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import uniq from 'lodash/uniq'

    export default {
       props:['posts'],
        data(){
           return{
               filetype:'',
               isliked:false,
               post:'',
               commentText:[]
           }

        },
        methods:{
           LikePost(type,post_id,post){
               if( post.isLiked){
                   post.isLiked = false
                   post.likeCount--;
               }else {
                   post.likeCount++;
                   post.isLiked = true
               }
               this.axios.post('/api/LikePost',{type:type,post_id:post_id}).then((response) => {
                   console.log(response)
               }).catch((error)=>{
                   console.log(error)
               })
           },
            createComment(index,post_id){
                if(this.commentText == ""){
                    return
                }else{
                    this.axios.post('/api/CreateComment',{comment:this.commentText[index],post_id:post_id}).then((response) => {
                        this.commentText = []
                        something.$emit('StoreNewPost');

                        console.log(response)
                    }).catch((error)=>{
                            console.log(error)
                    })
                }
            }
        },
        computed:{
            ...mapGetters([
                'getUserInfo'
            ]),


        }
    }
</script>

<style scoped>

</style>

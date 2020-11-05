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
                            <p class="mb-0 text-primary"> <TimeAgo :refresh="60" :datetime="post.created_at" locale="en" tooltip></TimeAgo></p>
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
                    <p v-if="post.body != null">
                        <read-more more-str="read more" :text="post.body" link="javascript:void(0)" less-str="read less" :max-chars="1000"></read-more>
                    </p>
                </div>

                <PostAttachments :files="post.files"></PostAttachments>

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
                                            <a  class="dropdown-item" href="#" v-if="post.likes.length < post.likeCount">Other</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="total-comment-block">
                                <div class="dropdown">
                                             <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                             {{post.commentCount}} Comment
                                             </span>
                                </div>
                            </div>
                        </div>
                        <div class="share-block d-flex align-items-center feather-icon mr-3">
                            <a href="javascript:void(0);"><i class="ri-share-line"></i>
                                <span class="ml-1">99 Share</span></a>
                        </div>
                    </div>
                    <hr>
                    <ul class="post-comments p-0 m-0">
                        <li class="mb-2" v-for="(comment,index1) in post.comments">
                            <div class="d-flex flex-wrap">
                                <div class="user-img">
                                    <img :src="comment.user.profile_photo_url" :alt="comment.user.name" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                    <h6>{{comment.user.name}}</h6>
                                    <p class="mb-0">{{comment.body}}</p>
                                    <div class="d-flex flex-wrap align-items-center comment-activity">
                                        <a href="javascript:void(0);" @click="showCommentForm(comment,post)" v-if="showCommentForms != comment">reply</a>
                                        <a href="javascript:void(0);" @click="HideCommentForm(comment,post)" v-if="showCommentForms == comment">un-reply</a>
                                        <a href="javascript:void(0);" @click="translate(comment,'comment')">translate</a>
                                        <span> <TimeAgo :refresh="60" :datetime="comment.created_at" locale="en" tooltip></TimeAgo> </span>
                                    </div>

                                    <!--      Replay           -->
                                    <ul class="post-comments p-0 m-0">
                                        <li class="mb-0" v-for="replay in comment.replay" v-if="hideReplay == comment.replay">
                                            <div class="d-flex flex-wrap">
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-img">
                                                        <img :src="replay.user.profile_photo_url" :alt="replay.user.name" class="avatar-35 rounded-circle img-fluid">
                                                    </div>

                                                    <div class="comment-data-block ml-3">
                                                        <h6>{{replay.user.name}}</h6>
                                                        <p class="mb-0">{{replay.replay}}</p>
                                                        <div class="d-flex flex-wrap align-items-center comment-activity">
                                                            <a href="javascript:void(0);">like</a>
                                                            <a href="javascript:void(0);" @click="translate(replay,'replay')" >translate</a>
                                                            <span>  <TimeAgo :refresh="60" :datetime="replay.created_at" locale="en" tooltip></TimeAgo> </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </li>
                                        <a href="javascript:void(0);" @click="heidOrReplays(comment.replay,'hide')" v-if="hideReplay == comment.replay">Hied Replays</a>
                                        <a href="javascript:void(0);" @click="heidOrReplays(comment.replay,'see')" v-if="comment.replay.length > 0 && hideReplay != comment.replay">See Replays ({{comment.replay.length}})</a>


                                    </ul>

                                    <!--     comment form       -->
                                    <CommentReplayInput :post="post" :showCommentForms="showCommentForms" :comment="comment" ></CommentReplayInput>
                                </div>
                            </div>

                        </li>
                        <div class="d-flex flex-wrap align-items-center comment-activity">
                            <a href="javascript:void(0)" v-if="post.comments.length < post.commentCount" @click="loadMoreComments(post)">LoadMore Comments</a>
                            <a href="javascript:void(0)" v-if="post.comments.length > 5" @click="loadLessComments(post)">LoadLess Comments</a>
                            <img src="images/page-img/page-load-loader.gif"  alt="loader" style="height: 50px;" v-if="showLoadGif == post">
                        </div>
                        <span v-if="showIsTypin == post.id" style="background-color:gray; border-radius: 5px;color: white;">Some One is Typing...</span>

                    </ul>
                    <CommentInput :post="post" :showPostForms="showPostForms"></CommentInput>
                </div>
            </div>
        </div>
    </div>
        <infinite-loading v-if="load" @distance="1"   @infinite="infiniteHandler"></infinite-loading>

    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import PostAttachments from "./PostAttachments";
    import CommentInput from "./CommentInput";
    import CommentReplayInput from "./CommentReplayInput";
    import TimeAgo from 'vue2-timeago'
    export default {
       props:['posts','lastPage','load'],
        components:{
            PostAttachments,
            CommentInput,
            CommentReplayInput,
            TimeAgo
        },
        data(){
           return{
               isliked:false,
               post:'',
               showLoadGif:null,
               showCommentForms:null,
               showPostForms:null,
               hideReplay:null,
               typing:false,
               showIsTypin:null,
               page: 2,
           }

        },
        methods:{
            translate(text,type){
                    var TextToTranslate = "";

                if(type == 'comment'){
                    var TextToTranslate = text.body;
                }else if (type == 'replay'){
                    var TextToTranslate = text.replay;
                }
                this.axios.post('/api/Translate',{text:TextToTranslate}).then((response) => {
                    console.log(response)
                    if(type == 'comment'){
                        text.body = response.data;
                    }else if (type == 'replay'){
                        text.replay = response.data;
                    }

                }).catch((error)=>{
                    console.log(error)
                })

            },
            infiniteHandler: function ($state) {
                let vm = this;
                if(this.lastPage == 1 ){
                    $state.complete();
                }else{


                if (this.posts.length != 0) {
                    axios.get('api/LoadPosts?page=' + this.page)
                        .then(response => {
                            return response.data;
                        }).then(data => {
                        //
                        if (this.page - 1 == this.lastPage) {
                            $state.complete();
                        } else {
                            setTimeout(function () {
                                $.each(data.data, function (key, value) {
                                    vm.posts.push(value);
                                });
                                $state.loaded();
                                Vue.nextTick(function () {
                                    $('[data-toggle="tooltip"]').tooltip();
                                });
                            }.bind(this), 0);
                        }

                    });
                    this.page = this.page + 1;
                } else {
                    $state.complete();
                }
                }

            },
            addCommentReplayEvent(e){
                this.posts.forEach((post,key) => {
                   post.comments.forEach(comment=>{
               if(comment.id == e.post_id){//post_id here is comment_id
                    comment.replay.push(e.comment[0])
               }
                   })
                });
            },
            heidOrReplays(replay,type){
                if(type == 'hide'){
                    this.hideReplay = null;
                }else{
                    this.hideReplay = replay;
                }
            },
            HideCommentForm(){
                this.showCommentForms = null
                this.showPostForms = null
            },
            showCommentForm(comment,post){
                    this.showCommentForms = comment
                    this.showPostForms = post
            },
            loadMoreComments(post){
                this.showLoadGif = post;
                post.loadmoreNumber = post.loadmoreNumber +5;
                this.axios.post('/api/LoadMoreComment',{post_id:post.id,loadmoreNumber:post.loadmoreNumber}).then((response) => {
                    post.comments = response.data.data
                    this.showLoadGif = null
                }).catch((error)=>{
                    console.log(error)
                })
            },
            loadLessComments(post){
                this.showLoadGif = post;
                post.loadmoreNumber = post.loadmoreNumber - 5;
                this.axios.post('/api/LoadMoreComment',{post_id:post.id,loadmoreNumber:post.loadmoreNumber}).then((response) => {
                    post.comments = response.data.data
                    this.showLoadGif = null
                }).catch((error)=>{
                    console.log(error)
                })
            },
           LikePost(type,post_id,post){
               if( post.isLiked){
                   post.isLiked = false
                   post.likes.splice(this.posts.indexOf(post.likes),1);
                   post.likeCount--;
               }else {
                   post.likeCount++;
                   post.likes.push({user:this.getUserInfo})
                   post.isLiked = true
               }
               this.axios.post('/api/LikePost',{type:type,post_id:post_id}).then((response) => {
               }).catch((error)=>{
                   console.log(error)
               })
           },
            checkLikeEvent(e) {

                this.posts.forEach(post => {
                    if(post.id == e.post){
                        if(e.type == '+'){
                            post.likeCount++;
                            post.likes.push({user:e.user})
                        }else if (e.type == '-'){
                            post.likes.splice(this.posts.indexOf(post.likes),1);
                            post.likeCount--;
                        }

                    }

                });

            },
            addCommentEvent(e){
                this.posts.forEach(post => {
                    if(post.id == e.post_id){
                            post.comments.push(e.comment[0])
                            post.commentCount++;
                    }

                });
            },
        },
        computed:{
            ...mapGetters([
                'getUserInfo'
            ]),


        },
        mounted(){
            //events for likes
            Echo.private('Likes')
                .listen('LikeEvent', (e) => {
                  this.checkLikeEvent(e)
                });
            //events for comment typing
            Echo.private('CommentTyping')
                .listen('commentTyping', (e) => {
                    if(e.type == 'comment'){
                        this.addCommentEvent(e)
                    }else{
                      this.addCommentReplayEvent(e)
                    }


                }).listenForWhisper('typing', (e) => {
                this.showIsTypin = e.post_id
                let vm = this
                // remove is typing indicator after 0.9s
                setTimeout(function() {
                    vm.showIsTypin = null
                }, 3000);
            });
        }
    }
</script>

<style scoped>

</style>

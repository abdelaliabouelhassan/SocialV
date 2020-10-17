<template>
    <div>
    <div class="iq-card-body" data-toggle="modal" data-target="#post-modal" @click="show = true">
        <div class="d-flex align-items-center">
            <div class="user-img">
                <img src="images/user/1.jpg" alt="userimg" class="avatar-60 rounded-circle">
            </div>
            <form class="post-text ml-3 w-100">
                <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
            </form>
        </div>
        <hr>
        <ul class="post-opt-block d-flex align-items-center list-inline m-0 p-0">
            <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/07.png" alt="icon" class="img-fluid"> Photo/Video</li>
            <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/08.png" alt="icon" class="img-fluid"> Tag Friend</li>
            <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/09.png" alt="icon" class="img-fluid"> Feeling/Activity</li>
            <li class="iq-bg-primary rounded p-2 pointer">
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <div class="dropdown">
                                          <span class="dropdown-toggle" id="post-option" data-toggle="dropdown" >
                                          <i class="ri-more-fill"></i>
                                          </span>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="post-option" style="">
                            <a class="dropdown-item" href="#">Check in</a>
                            <a class="dropdown-item" href="#">Live Video</a>
                            <a class="dropdown-item" href="#">Gif</a>
                            <a class="dropdown-item" href="#">Watch Party</a>
                            <a class="dropdown-item" href="#">Play with Friend</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="modal fade" id="post-modal" tabindex="-1" role="dialog" aria-labelledby="post-modalLabel" aria-hidden="true" v-show="show">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="post-modalLabel">Create Post</h5>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="show = false"><i class="ri-close-fill"></i></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <div class="user-img">
                            <img src="images/user/1.jpg" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                        </div>
                        <form class="post-text ml-3 w-100" action="#">
                            <textarea  id="" cols="30" rows="5" class="form-control rounded" placeholder="Write something here..." style="border:none;" v-model="post.body"></textarea>
                            <div>
                                <img v-for="(img,index) in  post.image" :src="img" class="img-thumbnail item" style="width: 90px;height: 90px;cursor:pointer " @click="DeleteImg(index)">
                            </div>
                            <div>
                                <video v-for="(vid,index) in post.video" :src="vid" class="embed-responsive-item item" style="width: 90px;height: 90px;cursor:pointer " @click="Deletevid(index)"></video>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
                        <li class="col-md-6 mb-3" @click="$refs.uploadImg.click()" style="cursor: pointer">
                            <input type="file" style="display:none" @change="uploadImage($event)" ref="uploadImg" alt="" multiple>
                            <div class="iq-bg-primary rounded p-2 pointer mr-3" ><a href="#" ></a><img src="images/small/07.png" alt="icon" class="img-fluid"> Photo/Video</div>
                        </li>
                        <li class="col-md-6 mb-3">
                            <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/08.png" alt="icon" class="img-fluid"> Tag Friend</div>
                        </li>
                        <li class="col-md-6 mb-3">
                            <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/09.png" alt="icon" class="img-fluid"> Feeling/Activity</div>
                        </li>
                        <li class="col-md-6 mb-3">
                            <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/10.png" alt="icon" class="img-fluid"> Check in</div>
                        </li>
                        <li class="col-md-6 mb-3">
                            <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/11.png" alt="icon" class="img-fluid"> Live Video</div>
                        </li>
                        <li class="col-md-6 mb-3">
                            <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/12.png" alt="icon" class="img-fluid"> Gif</div>
                        </li>
                        <li class="col-md-6 mb-3">
                            <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/13.png" alt="icon" class="img-fluid"> Watch Party</div>
                        </li>
                        <li class="col-md-6 mb-3">
                            <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/14.png" alt="icon" class="img-fluid"> Play with Friends</div>
                        </li>
                    </ul>
                    <hr>
                    <div class="other-option">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="user-img mr-3">
                                    <img src="images/user/1.jpg" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                                </div>
                                <h6>Your Story</h6>
                            </div>
                            <div class="iq-card-post-toolbar">
                                <div class="dropdown">
                                                   <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                                   <span class="btn btn-primary">Friend</span>
                                                   </span>
                                    <div class="dropdown-menu m-0 p-0">
                                        <a class="dropdown-item p-3" href="#">
                                            <div class="d-flex align-items-top">
                                                <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                                <div class="data ml-2">
                                                    <h6>Public</h6>
                                                    <p class="mb-0">Anyone on or off Facebook</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item p-3" href="#">
                                            <div class="d-flex align-items-top">
                                                <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                                <div class="data ml-2">
                                                    <h6>Friends</h6>
                                                    <p class="mb-0">Your Friend on facebook</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item p-3" href="#">
                                            <div class="d-flex align-items-top">
                                                <div class="icon font-size-20"><i class="ri-user-unfollow-line"></i></div>
                                                <div class="data ml-2">
                                                    <h6>Friends except</h6>
                                                    <p class="mb-0">Don't show to some friends</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item p-3" href="#">
                                            <div class="d-flex align-items-top">
                                                <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                                <div class="data ml-2">
                                                    <h6>Only Me</h6>
                                                    <p class="mb-0">Only me</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary d-block w-100 mt-3" @click="CreatePost">Post</button>
                </div>
            </div>
        </div>
    </div>
        <div  :class="{'modal-backdrop fade show':show}"></div>
    </div>
</template>

<script>

    export default {
        data(){
            return{
                post:{
                    body:'',
                    image:[],
                    video:[],
                },
                show:false,
            }
        },
        methods:{

            Deletevid(index){
                this.$Progress.start()
                this.post.video.splice(index,1);
                this.$Progress.finish();
            },
            DeleteImg(index){
                this.$Progress.start()
              this.post.image.splice(index,1);
                this.$Progress.finish();
            },
            uploadImage(event){

                for (let file of event.target.files) {
                    this.$Progress.start()
                    try {
                        let reader = new FileReader();
                        if(file['type']==='image/jpeg' || file['type']==='image/png'){
                            if(file['size'] < 2111775){
                                reader.onloadend = (file) =>{
                                    this.post.image.push(reader.result);
                                }
                            }else{
                                this.$Progress.fail();
                            }
                        }else if( file['type']==='video/mp4'){

                            reader.onloadend = (file) =>{
                                this.post.video.push(reader.result);
                            }
                        }else{
                            this.$Progress.fail();
                        }

                        reader.readAsDataURL(file);
                    } catch {
                        this.$Progress.fail();
                    }
                    this.$Progress.finish();
                }

            },
            CreatePost(){
                this.$Progress.start();
                    if(this.post.body == "" && this.post.image.length == 0  && this.post.video.length == 0 ){
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'error',
                            title: 'Please Try Again... X.X',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.$Progress.fail()
                        return;
                    }else{
                       this.axios.post('/api/CreatePost',this.post).then((response) => {
                           console.log(response)
                           if(response.status == 200){
                               this.post.body = "";
                               this.post.image = [];
                               this.post.video = [];
                               Swal.fire({
                                   position: 'bottom-end',
                                   icon: 'success',
                                   title: response.data,
                                   showConfirmButton: false,
                                   timer: 1500
                               })
                           }else{
                               this.$Progress.fail()
                               Swal.fire({
                                   position: 'bottom-end',
                                   icon: 'success',
                                   title: 'Please Try Again... X.X',
                                   showConfirmButton: false,
                                   timer: 1500
                               })
                           }
                           something.$emit('StoreNewPost');
                           this.$Progress.finish();
                       }).catch((error)=>{

                           Swal.fire({
                               position: 'bottom-end',
                               icon: 'error',
                               title: 'Please Try Again... X.X',
                               showConfirmButton: false,
                               timer: 1500
                           })
                           this.$Progress.fail()
                       })
                    }
            },
        }
    }
</script>

<style scoped>


    .item:hover {
        background: #ff443d;
    }
</style>

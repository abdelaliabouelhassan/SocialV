<template>
    <form class="comment-text d-flex align-items-center mt-3"  action="javascript:void(0);" v-if="showCommentForms == comment">
        <input type="text" class="form-control" v-model="commentReplayText" @keyup="isTyping(post)" @keyup.enter="createReplayComment(comment.id)">
        <div class="comment-attagement d-flex">
            <a href="javascript:void(0);"><i class="ri-link mr-3"></i></a>
            <a href="javascript:void(0);"><i class="ri-user-smile-line mr-3"></i></a>
            <a href="javascript:void(0);"><i class="ri-camera-line mr-3"></i></a>
        </div>
    </form>
</template>

<script>
    export default {
        props:['post','showCommentForms','comment'],
        name: "CommentReplayInput",
        data(){
            return{
                commentReplayText:"",
            }
        },
        methods:{
            isTyping(post){
                let channel = Echo.private('CommentTyping');
                setTimeout(function() {
                    channel.whisper('typing', {
                        post_id:post.id
                    });
                }, 100);
            },
            createReplayComment(comment_id){
                if(this.commentReplayText == ""){
                    return
                }
                this.axios.post('/api/CreateCommentReplay',{comment_id:comment_id,replay:this.commentReplayText}).then((response) => {
                    this.commentReplayText = "";
                }).catch((error)=>{
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>

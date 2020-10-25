<template>
    <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);"   v-if="showPostForms != post" >
        <input type="text" class="form-control rounded" v-model="commentText" @keyup="isTyping(post)" @keyup.enter="createComment()">
        <div class="comment-attagement d-flex">
            <a href="javascript:void(0);"><i class="ri-link mr-3"></i></a>
            <a href="javascript:void(0);"><i class="ri-user-smile-line mr-3"></i></a>
            <a href="javascript:void(0);"><i class="ri-camera-line mr-3"></i></a>
        </div>
    </form>
</template>

<script>

    export default {
        props:['post','showPostForms'],
        name: "CommentInput",
        data(){
            return{
                commentText:'',
            }
        },
        methods:{
            createComment(){
                if(this.commentText == ""){
                    return
                }else{
                    this.axios.post('/api/CreateComment',{comment:this.commentText,post_id:this.post.id}).then((response) => {
                        this.commentText = "";
                    }).catch((error)=>{
                    })
                }
            },
            isTyping(post){
                let channel = Echo.private('CommentTyping');
                setTimeout(function() {
                    channel.whisper('typing', {
                        post_id:post.id
                    });
                }, 100);
            }
        },


    }
</script>

<style scoped>

</style>

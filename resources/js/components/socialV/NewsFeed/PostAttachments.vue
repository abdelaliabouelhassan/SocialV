<template>
        <div>
            <div class="user-post"  v-if="images.length  != 0">
                <FbImageLibrary  :images="images" style="cursor: pointer"></FbImageLibrary>
            </div>
            <div class="user-post" v-if="videos.length  != 0">
                <video controls  class="img-fluid rounded w-100" >
                    <source :src="videos" type="video/mp4">
                </video>
            </div>
        </div>
</template>

<script>
    export default {
        props:['files'],
        name: "PostAttachments",
        data(){
            return {
                images:[],
                videos:[],
            }
        },
        created() {
            this.files.forEach(file => {
                if(file.type == "image"){
                        this.images.push(file.path)
                }else{
                    this.videos.push(file.path)
                }
            });
         }
    }
</script>

<style scoped>

</style>

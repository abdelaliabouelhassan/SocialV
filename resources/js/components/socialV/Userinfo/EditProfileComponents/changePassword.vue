<template>
      <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                              <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Change Password</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                   
                                       <div class="form-group">
                                          <label for="cpass">Current Password:</label>
                                          <a href="javascripe:void();" class="float-right">Forgot Password</a>
                                          <input type="Password" class="form-control" id="cpass"  v-model="user.current_password">
                                       </div>
                                       <div class="form-group">
                                          <label for="npass">New Password:</label>
                                          <input type="Password" class="form-control" id="npass" v-model="user.password">
                                       </div>
                                       <div class="form-group">
                                          <label for="vpass">Verify Password:</label>
                                          <input type="Password" class="form-control" id="vpass" v-model="user.repassword">
                                       </div>
                                       <button type="submit" class="btn btn-primary mr-2" @click="updatePassword" :disabled="checkForm">Submit</button>
                                       <!-- <button type="reset" class="btn iq-bg-danger">Cancle</button> -->
                                    
                                 </div>
                              </div>
                           </div>
</template>
<script>
export default {
    data(){
       return{
            user:{
               current_password:'',
               password:'',
               repassword:'',
            }
       }
    },
   computed:{
checkForm(){
   if(this.user.current_password == "" || this.user.password == "" || this.user.repassword == ""  ){
      return true;
   }else if ( this.user.password != this.user.repassword ){
         return true
   }
   return false
}
   },
    methods:{
       updatePassword(){




            this.axios
          .post("/api/ChangePassword/",{user:this.user})
          .then((response) => {
            console.log(response)
             Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: response.data,
              showConfirmButton: false,
              timer: 1500,
            });
          })
          .catch((error) => {
   
             Swal.fire({
          position: "bottom-end",
          icon: "error",
          title: "The provided password does not match your current password.",
          showConfirmButton: false,
          timer: 1500,
        });
          });
       }
    }
}
</script>


<style scoped>

</style>
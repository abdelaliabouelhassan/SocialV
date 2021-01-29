<template>
     <div id="content-page" class="content-page">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-body p-0">
                           <div class="iq-edit-list">
                              <ul class="iq-edit-profile d-flex nav nav-pills">
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                    Personal Information
                                    </a>
                                 </li>
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                    Change Password
                                    </a>
                                 </li>
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#emailandsms">
                                    Email and SMS
                                    </a>
                                 </li>
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                    Manage Contact
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="iq-edit-list-data">
                        <div class="tab-content">

                          <!-- Personal Info Components -->
                          <personalInfo></personalInfo>
                          <!-- End Personal Info Components -->


                          <!-- Change Password Components -->
                           <changePassword></changePassword>  
                          <!-- End Change Password Components-->


                         <!-- Email and SMS Components-->
                            <emailandsms></emailandsms>
                         <!--End Email and SMS Components  -->

                           <!-- Manage Contact Components-->
                            <manageContact></manageContact>
                            <!--End Manage Contact Components  -->
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
</template>


<script>

import personalInfo from './EditProfileComponents/personalInfo'
import changePassword from './EditProfileComponents/changePassword'
import emailandsms from './EditProfileComponents/emailandsms'
import manageContact from './EditProfileComponents/manageContact'

export default {
    name:"accountSetting",
    components:{
        personalInfo,
        changePassword,
        emailandsms,
        manageContact
    },
  
}
</script>


<style scoped>

</style>
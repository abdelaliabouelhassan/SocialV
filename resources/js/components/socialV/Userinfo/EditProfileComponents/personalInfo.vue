<template>
  <div
    class="tab-pane fade active show"
    id="personal-information"
    role="tabpanel"
  >
    <div class="iq-card">
      <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
          <h4 class="card-title">Personal Information</h4>
        </div>
      </div>
      <div class="iq-card-body">
        <div class="form-group row align-items-center">
          <div class="col-md-12">
            <div class="profile-img-edit">
              <img
                class="profile-pic"
                :src="
                  $store.state.user.profile_photo_path == null
                    ? $store.state.user.profile_photo_url
                    : $store.state.user.profile_photo_path
                "
                :alt="$store.state.user.name"
              />
              <img class="gifLoading" src="images/page-img/page-load-loader.gif" v-show="loadingGif" alt="loader">

              <div class="p-image">
                <i
                  class="ri-pencil-line upload-button"
                  @click="$refs.profileImg.click()"
                ></i>
                <input
                  class="file-upload"
                  @change="GetImage($event)"
                  ref="profileImg"
                  type="file"
                  accept="image/*"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="form-group col-sm-6">
            <label for="fname">Full Name:</label>
            <input
              type="text"
              class="form-control"
              id="fname"
              v-model="$store.state.user.name"
            />
          </div>

          <div class="form-group col-sm-6">
            <label class="d-block">Gender:</label>
            <div class="custom-control custom-radio custom-control-inline">
              <input
                type="radio"
                id="customRadio6"
                name="customRadio1"
                value="Male"
                v-model="$store.state.user.gender"
                class="custom-control-input"
              />
              <label class="custom-control-label" for="customRadio6">
                Male
              </label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input
                type="radio"
                id="customRadio7"
                name="customRadio1"
                value="Female"
                v-model="$store.state.user.gender"
                class="custom-control-input"
              />
              <label class="custom-control-label" for="customRadio7">
                Female
              </label>
            </div>
          </div>
          <div class="form-group col-sm-6">
            <label for="dob">Date Of Birth:</label>
            <input
              type="date"
              class="form-control"
              id="dob"
              v-model="$store.state.user.dateofbirth"
            />
          </div>
          <div class="form-group col-sm-6">
            <label>Marital Status:</label>
            <select
              class="form-control"
              id="exampleFormControlSelect1"
              v-model="$store.state.user.maritalstatus"
            >
              <option value="null">...</option>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Widowed">Widowed</option>
              <option value="Divorced">Divorced</option>
              <option value="Separated">Separated</option>
            </select>
          </div>

          <div class="form-group col-sm-6">
            <label>Country:</label>
            <select
              class="form-control"
              id="exampleFormControlSelect3"
              @change="OnChangegetCity"
              v-model="$store.state.user.country"
            >
              <option :value="item" v-for="item in country">{{ item }}</option>
            </select>
          </div>
          <div class="form-group col-sm-6">
            <label>City:</label>
            <select
              class="form-control"
              id="exampleFormControlSelect4"
              v-model="$store.state.user.city"
            >
              <option v-for="item in city" :value="item">{{ item }}</option>
            </select>
          </div>
          <div class="form-group col-sm-12">
            <label>Address:</label>
            <textarea
              class="form-control"
              name="address"
              rows="5"
              style="line-height: 22px"
              v-model="$store.state.user.address"
            >
            </textarea>
          </div>
        </div>
        <button
          type="submit"
          class="btn btn-primary mr-2"
          @click="updateInfo"
          :disabled="checkForm"
        >
          Submit
        </button>
        <button type="reset" class="btn iq-bg-danger" @click="resetForm">
          Reset
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "personalInfo",
  data() {
    return {
      country: [],
      city: [],
      loadingGif:false,
    };
  },
  computed: {
    checkForm() {
      if (
        this.$store.state.user.name == "" ||
        this.$store.state.user.gender == null ||
        this.$store.state.user.country == null ||
        this.$store.state.user.dateofbirth == null ||
        this.$store.state.user.city == null
      ) {
        return true;
      } else if (
        this.$store.state.user.gender == "" ||
        this.$store.state.user.country == "" ||
        this.$store.state.user.dateofbirth == "" ||
        this.$store.state.user.city == ""
      ) {
        return true;
      }
      return false;
    },
  },
  methods: {
    GetImage(event) {
       this.loadingGif = true
     
      let file = event.target.files[0];
       let reader = new FileReader();
      if (file["type"] === "image/jpeg" || file["type"] === "image/png") {
        if (file["size"] < 2111775) {
          reader.onloadend = (file) => {
           
         this.axios
        .post("/api/UpdateProfileImage" ,{image:reader.result})
        .then((response) => {
           console.log(response)
           this.$store.state.user.profile_photo_path = reader.result;
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: response.data,
              showConfirmButton: false,
              timer: 1500,
            });
             this.loadingGif = false
        })
        .catch((error) => {
           //error in upload 
          this.loadingGif = false
          console.log(error);
           Swal.fire({
          position: "bottom-end",
          icon: "error",
          title: "Please Try Again... X.X",
          showConfirmButton: false,
          timer: 1500,
        });
        });
          };
        }else{
            //size
            this.loadingGif = false
             Swal.fire({
          position: "bottom-end",
          icon: "error",
          title: "Image Size Must be <= 2mb",
          showConfirmButton: false,
          timer: 1500,
        });

        }
      }else{
         //not image
         this.loadingGif = false
          Swal.fire({
          position: "bottom-end",
          icon: "error",
          title: "Please Upload only Images",
          showConfirmButton: false,
          timer: 1500,
        });
      }

      reader.readAsDataURL(file);
    
    },
    resetForm() {
      something.$emit("loadUser");
      this.loadCity();
    },
    loadCity() {
      if (this.$store.state.user.city != null) {
        this.axios
          .get("/api/Getcities/" + this.$store.state.user.country)
          .then((response) => {
            this.city = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    OnChangegetCity() {
      this.axios
        .get("/api/Getcities/" + this.$store.state.user.country)
        .then((response) => {
          this.city = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadCountry() {
      this.axios
        .get("/api/Getcountries")
        .then((response) => {
          this.country = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateInfo() {
      if (
        this.$store.state.user.name == "" ||
        this.$store.state.user.gender == null ||
        this.$store.state.user.country == null ||
        this.$store.state.user.dateofbirth == null ||
        this.$store.state.user.city == null
      ) {
        Swal.fire({
          position: "bottom-end",
          icon: "error",
          title: "Please Try Again... X.X",
          showConfirmButton: false,
          timer: 1500,
        });
      } else {
        this.axios
          .post("/api/UpdateInfo", this.$store.state.user)
          .then((response) => {
            console.log(response);
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: response.data,
              showConfirmButton: false,
              timer: 1500,
            });
          })
          .catch((error) => {
            console.log(error);
            Swal.fire({
              position: "bottom-end",
              icon: "error",
              title: "Please Try Again... X.X",
              showConfirmButton: false,
              timer: 1500,
            });
          });
      }
    },
  },
  created() {
    this.loadCountry();
    this.loadCity();
  },
};
</script>


<style scoped>
.profile-pic {
  max-width: 77%;
}
.gifLoading{
     height: 112px;
    top: 2px;
    left: 21px;
    position: absolute;
}
</style>
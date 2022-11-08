<template>
    <v-app>
        <div>
            <v-container fluid>
                <v-form @Submit.prevent ref="form" lazy-validation>
                    <v-row>
                        <v-col cols="12" md="12" class="mt-5">
                            <v-chip class="mb-2">Player Personal Details</v-chip>
                        </v-col>

                        <v-col cols="12" sm="6" md="3">
                            <v-text-field
                                label="Name"
                                solo
                                dense
                                v-model="playerName"
                                :rules="[(v) => !!v || 'Name is required']"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="3">
                            <v-text-field
                                label="NIC Number"
                                v-model="playerNIC"
                                solo
                                dense
                                :rules="[(v) => !!v || 'ID Number is required']"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="3">
                            <v-text-field
                                label="Phone No"
                                solo
                                dense
                                v-model="playerPhone"
                                :rules="[(v) => !!v || 'Phone No is required']"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="3">
                            <v-autocomplete
                            v-model="selectProvince"
                            :items="allprovince"
                            item-text="name"
                            item-value="name"
                            dense
                            solo
                            filled
                            clearable
                            label="Province"
                            color="black"
                            outlined
                            @change="getAllDistrictAccProv(selectProvince)"
                            background-color="#FFFFFF"
                            >
                            </v-autocomplete>
                        </v-col>


                        <v-col cols="12" sm="6" md="3">
                           <v-autocomplete
                            :loading="loadingDiscrtict"
                            v-model="selectDistrict"
                            :items="alldistrict"
                            item-text="name"
                            item-value="name"
                            dense
                            solo
                            filled
                            clearable
                            label="District"
                            color="black"
                            outlined
                            background-color="#FFFFFF"
                            >
                            </v-autocomplete>
                        </v-col>

                        <v-col cols="12" sm="6" md="3">
                            <v-text-field
                                label="Address"
                                solo
                                dense
                                v-model="playerAddress"
                                :rules="[(v) => !!v || 'Address is required']"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="3">
                            <v-text-field
                                label="Birthday"
                                solo
                                dense
                                v-model="playerBrithDay"
                                :rules="[(v) => !!v || 'Birthday is required']"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="3">
                            <v-autocomplete
                            v-model="playerGender"
                            :items="allPlayerGender"
                            item-text=""
                            item-value=""
                            dense
                            solo
                            filled
                            clearable
                            label="Gender"
                            color="black"
                            outlined
                            background-color="#FFFFFF"
                            >
                            </v-autocomplete>
                        </v-col>
                        </v-row>

                        <!--------------------------------------------------------------------------------------------->
                        

                     

                        <v-col cols="12" md="12" class="mt-5">
                            <v-chip class="mb-2">Player Game Details</v-chip>
                        </v-col>

                        <v-col cols="12" md="12">
                              <v-card>
                                <v-card-text>
                                  <v-simple-table solo dense>
                                    <template v-slot:default>
                                      <thead>
                                        <tr>
                                          <th class="text-left">Game</th>
                                          <th class="text-left">Event</th>
                                          <th class="text-left">Best Preformance</th>

                                          <th class="text-left">
                                            Add / Remove
                                          </th>
                                        </tr>
                                      </thead>
                                      <tbody class="mt-1">
                                        <tr
                                          v-for="(input, k) in inputs"
                                          :key="k"
                                         
                                          
                                        >
                                          <td>
                                            <v-autocomplete
                                            class="mt-2 mb-2"
                                            v-model="input.selectGame"
                                            :items="allGame"
                                            item-text="game_name"
                                            item-value="id"
                                            dense
                                            solo
                                            filled
                                            clearable
                                            label="Game"
                                            color="black"
                                            @change="getAllEvent(input.selectGame)"
                                            outlined
                                            background-color="#FFFFFF"
                                            >
                                            </v-autocomplete>
                                          </td>
                                          <td>
                                            <v-autocomplete
                                                class="mt-2 mb-2"
                                                :loading="loadingEvent"
                                                v-model="input.selectEvent"
                                                :items="allEvent"
                                                item-text="event.event_name"
                                                item-value="event.id"
                                                dense
                                                solo
                                                filled
                                                clearable
                                                label="Event"
                                                color="black"
                                                outlined
                                                background-color="#FFFFFF"
                                                >
                                                </v-autocomplete>
                                          </td>
                                          <td>
                                            <v-autocomplete
                                                class="mt-2 mb-2"
                                                v-model="input.selectBestPreformance"
                                                :items="allBestPreformancer"
                                                dense
                                                solo
                                                filled
                                                clearable
                                                label="Best Preformance"
                                                color="black"
                                                outlined
                                                background-color="#FFFFFF"
                                                >
                                            </v-autocomplete>
                                          </td>
                                          <td>
                                            <v-btn
                                              x-small
                                              fab
                                              dark
                                              color="red darken-4"
                                              @click="remove(k)"
                                              v-show="
                                                k || (!k && inputs.length > 1)
                                              "
                                            >
                                              <v-icon small
                                                >mdi-minus-circle-outline</v-icon
                                              >
                                            </v-btn>
                                            <v-btn
                                              x-small
                                              fab
                                              dark
                                              color="green darken-4"
                                              @click="add(k)"
                                              v-show="k == inputs.length - 1"
                                            >
                                              <v-icon small
                                                >mdi-plus-circle-outline</v-icon
                                              >
                                            </v-btn>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </template>
                                  </v-simple-table>
                                </v-card-text>
                              </v-card>
                        </v-col>

                        <v-col cols="4" sm="4" md="4">
                            <v-btn
                                class="mb-4"
                                color="primary"
                                @click="savePlayerDetails()"
                                dark
                            >
                                Submit
                            </v-btn>
                            <v-btn
                                color="red"
                                class="mb-4"
                                @click="clear()"
                                dark
                            >
                                Clear
                            </v-btn>
                        </v-col>
                   

                    <!-- <v-row>
                        <v-col cols="12">
                            <template>
                                <v-data-table
                                    :headers="headers"
                                    :items="user_details"
                                    :items-per-page="5"
                                    class="elevation-1"
                                ></v-data-table>
                            </template>
                        </v-col>
                    </v-row> -->
                </v-form>
            </v-container>
            <v-overlay :value="overlay">
                <v-progress-circular
                    indeterminate
                    size="64"
                ></v-progress-circular>
            </v-overlay>
        </div>
        <v-snackbar v-model="snackbar" :multi-line="false" :color="snackColor">{{ snackMessage }}</v-snackbar>
    </v-app>
</template>
<script>
export default {
    created() {
        this.get_all_details_data();
        this.getAllProvince();
        this.getAllGameDetails();
        
    },
    data() {
        return {
            loadingDiscrtict:false,
            loadingEvent: false,
            search: "",
            headers: [
                { text: "ID Number", value: "ID_NO" },
                { text: "Province", value: "Province" },
                { text: "Distric", value: "Distric" },
                { text: "D Secretariat", value: "D_Secretariat" },
                { text: "Name", value: "Name" },
                { text: "Birthday", value: "Birth_Day" },
                { text: "Address", value: "Address" },
                { text: "Gender", value: "Gender" },
                { text: "Game", value: "Game" },
                { text: "Event", value: "Event" },
                { text: "phone No", value: "Phone_NO" },
                { text: "Best Performance", value: "Best_Performrnce" },
            ],
            user_details: [],

            overlay: false,

            playerName: "",
            playerNIC: "",
            playerPhone: "",
            selectProvince: "",
            selectDistrict: "",
            playerAddress: "",
            playerBrithDay: "",
            playerGender: "",
            playerGender: "",
            inputs: [
                {
                selectGame:"",
                selectEvent:"",
                selectBestPreformance:"",
                },
            ],

            allprovince:[],
            alldistrict:[],
            allGame:[],
            allEvent:[],
            allPlayerGender:[
                'Male',
                'Female',
            ],
            allBestPreformancer:[
                'National Level',
                'Distric Level',
                'Provincial Level',
            ],

            snackbar:"",
            snackColor: "",
            snackMessage: "",

            

  
        };
    },
    methods: {

      savePlayerDetails() {
       let laravel = JSON.parse(window.Laravel);

       const header = {
        "X-CSRF-TOKEN": laravel.csrfToken,
        "X-Requested-With": "XMLHttpRequest",
        "content-type": "multipart/form-data",
      };

      let formData = new FormData();

      // formData.append("userID", laravel.user.id);
      formData.append("playerName",this.playerName);
      formData.append("playerNIC", this.playerNIC);
      formData.append("playerPhone",this.playerPhone);
      formData.append("selectProvince",this.selectProvince);
      formData.append("selectDistrict",this.selectDistrict);
      formData.append("playerAddress",this.playerAddress);
      formData.append("playerBrithDay",this.playerBrithDay);
      formData.append("playerGender",this.playerGender);

      formData.append("inputs", JSON.stringify(this.inputs));

      
    //   formData.append("selectEvent",this.selectEvent);
    //   console.log('fuker----------------',this.selectEvent);
    //   formData.append("selectBestPreformance",this.selectBestPreformance);
      
      axios
        .post("/api/player/savePlayerDetails",formData,header)
        .then((response) => {
          if (response.data.http_status == "success") {
            this.snackMessage = "Player Details Save Completed ";
            this.snackColor = "success";
            this.snackbar = true;
            this.playerName = "";
            this.playerNIC = "";
            this.playerPhone = "";
            this.selectProvince = "";
            this.selectDistrict = "";
            this.playerAddress = "";
            this.playerBrithDay = "";
            this.playerGender = "";
            this.inputs = "";
           
          } else {
            this.snackMessage = "Player Details Save  falid ";
            this.snackColor = "error";
            this.snackbar = true;
          }
        })
        .catch((error) => {
          
        });
      },



        get_all_details_data() {
            axios
                .post("/api/get-all-details")
                .then((response) => {
                    this.user_details = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        clear() {
            this.UserData.id_number = null;
            this.UserData.province = null;
            this.UserData.distric = null;
            this.UserData.d_secretariat = null;
            this.UserData.name = null;
            this.UserData.birthday = null;
            this.UserData.address = null;
            this.UserData.gender = null;
            this.UserData.game = null;
            this.UserData.event = null;
            this.UserData.phone_no = null;
            this.UserData.best_performance = null;
        },

        // Get Province---------------------------------------------------
    getAllProvince(){  
        this.allprovince = [];
      let laravel = JSON.parse(window.Laravel);
            console.log(laravel);
    //   this.allAgrarinCenter = [];   
    //   let provinceDetails = this.selectProvince;
      const header = {
                'X-CSRF-TOKEN': laravel.csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'content-type': 'multipart/form-data',
      };
      axios.post("/api/player/getAllProvince",header)
                    .then(response => {
                        if (response.data.http_status == 'success'){
                          let responceData = response.data.data;
                          responceData.forEach(element => {
                            this.allprovince.push({
                                name: element.PROVINCE_N,
                            });
                          });
                          console.log('allprovince',this.allprovince);
                            
                        }else{

                        }
                    }).catch((error) => {

                });
    },

    // Get All Districts 
    getAllDistrictAccProv(province){
        this.alldistrict = [];
        this.loadingDiscrtict = true;
      let laravel = JSON.parse(window.Laravel);
            // console.log(laravel);
      const header = {
                'X-CSRF-TOKEN': laravel.csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'content-type': 'multipart/form-data',
      };

      axios.post('/api/player/getAllDistrictAccProv',{province:province},header)
                    .then(response => {
                        if (response.data.http_status == 'success'){
                          let responceData = response.data.data;
                          this.loadingDiscrtict = false;
                          console.log('allDistrictDetails',response.data.data);
                          responceData.forEach(element => {
                            this.alldistrict.push({
                                name: element.District,
                            });
                          });
                        }
                          
                    }).catch((error) => {
                      
                });
    },

    // Get Game Details--------------------------------------------------
    getAllGameDetails(){  
      let laravel = JSON.parse(window.Laravel);
            console.log(laravel);
      const header = {
                'X-CSRF-TOKEN': laravel.csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'content-type': 'multipart/form-data',
      };
      axios.post("/api/player/getAllGameDetails",header)
                    .then(response => {
                        if (response.data.http_status == 'success'){
                          this.allGame = response.data.data;
                          console.log('games........',response.data.data);
                            
                        }else{

                        }
                    }).catch((error) => {

                });

    },

    // Get All Event
    getAllEvent(Game){
      let laravel = JSON.parse(window.Laravel);
      this.loadingEvent = true;
            // console.log(laravel);
      const header = {
                'X-CSRF-TOKEN': laravel.csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'content-type': 'multipart/form-data',
      };

      axios.post('/api/player/getAllEvent',{Game:Game},header)
                    .then(response => {
                        if (response.data.http_status == 'success'){
                          this.allEvent = response.data.data;
                          this.loadingEvent = false;
                          console.log('allEvent--------',response.data.data);
                        }
                          
                    }).catch((error) => {
                      
                });
        
    },


    add(index) {
      this.inputs.push({
        selectGame: "",
        selectEvent: "",
        selectBestPreformance: "",
      });
      console.log(this.inputs);
    },
    remove(index) {
      this.inputs.splice(index, 1);
    },







    },
};
</script>
<template>
    <v-row>
        <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
        <!-- <v-card v-bind:style="{ height: '1000px', 'overflow-y': 'auto' }"> -->
            <v-card>
                <v-card-title class="display-2 justify-center">
                    <v-img
                        class="mr-4""
                        max-height="100"
                        max-width="50"
                        src="/img/logo/1.png"
                    ></v-img>
                    MINISTRY OF SPORT & YOUTH AFFAIRS
                    <v-img
                        class="ml-4"
                        max-height="150"
                        max-width="100"
                        src="/img/logo/2.png"
                    ></v-img>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>

                            <v-col cols="12" md="4">
                                <v-select
                                                class="mt-2 mb-2"
                                                outlined
                                                attach
                                                dense
                                                color="#2E7D32"
                                                clearable
                                                :items="['Gender','Game', 'Game and Event', 'Province', 'District', 'All']"
                                                v-model="selectFilterCategory"
                                                label="Fiter Category"
                                                
                                            ></v-select>
                                            
                            </v-col>

                            <v-col cols="12" md="8" v-if="selectFilterCategory">
                                <v-row>
                                    <v-col cols="12" md="4" v-if="selectFilterCategory == 'Gender'">
                                        <v-select
                                                class="mt-2 mb-2"
                                                outlined
                                                attach
                                                dense
                                                color="#2E7D32"
                                                clearable
                                                :items="allGender"
                                                v-model="gender"
                                                label="Gender"
                                                
                                            ></v-select>
                                        </v-col>

                                        <v-col cols="12" md="4" v-if="selectFilterCategory == 'Game and Event' ||   selectFilterCategory == 'Game'">
                                        <v-select
                                                class="mt-2 mb-2"
                                                outlined
                                                dense
                                                item-text="game_name"
                                                item-value="id"
                                                attach
                                                color="#2E7D32"
                                                clearable
                                                :items="allGame"
                                                v-model="selectGame"
                                                @change="getAllEvent(selectGame)"
                                                label="Game"
                                                solo
                                            ></v-select>
                                        </v-col>
                                        
                                        <v-col cols="12" md="4" v-if="selectFilterCategory == 'Game and Event'">
                                        <v-select
                                                :loading="loadingEvent"
                                                class="mt-2 mb-2"
                                                outlined
                                                dense
                                                attach
                                                color="#2E7D32"
                                                clearable
                                                item-text="event.event_name"
                                                item-value="event.id"
                                                :items="allEvent"
                                                v-model="event"
                                                label="Event"
                                            ></v-select>
                                        </v-col>
                                </v-row>

                                    <v-row>

                                        <v-col cols="12" md="4" v-if="selectFilterCategory == 'Province' || selectFilterCategory =='District'">
                                            <v-autocomplete
                                                v-model="selectProvince"
                                                :items="allprovince"
                                                item-text="name"
                                                item-value="name"
                                                dense
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

                                        <v-col cols="12" md="4" v-if="selectFilterCategory == 'District'">
                                        <v-autocomplete
                                                :loading="loadingDiscrtict"
                                                v-model="selectDistrict"
                                                :items="alldistrict"
                                                item-text="name"
                                                item-value="name"
                                                dense
                                                filled
                                                clearable
                                                label="District"
                                                color="black"
                                                outlined
                                                background-color="#FFFFFF"
                                                >
                                        </v-autocomplete>
                                        </v-col>

                                        <v-col cols="12" md="4" v-if="selectFilterCategory != 'All'">
                                        <v-btn
                                        @click="filterDetails()"
                                        block
                                        depressed
                                        color="primary"
                                        >
                                        Search Here
                                    </v-btn>
                                        </v-col>
                                </v-row>
                            </v-col>

                            <v-col cols="12" md="8" v-if="selectFilterCategory == 'All'">
                                <v-row>
                                    <v-col cols="12" md="4">
                                        <v-select
                                                class="mt-2 mb-2"
                                                outlined
                                                attach
                                                dense
                                                color="#2E7D32"
                                                clearable
                                                :items="allGender"
                                                v-model="gender"
                                                label="Gender"
                                                
                                            ></v-select>
                                        </v-col>

                                        <v-col cols="12" md="4">
                                        <v-select
                                                class="mt-2 mb-2"
                                                outlined
                                                dense
                                                item-text="game_name"
                                                item-value="id"
                                                attach
                                                color="#2E7D32"
                                                clearable
                                                :items="allGame"
                                                v-model="selectGame"
                                                @change="getAllEvent(selectGame)"
                                                label="Game"
                                                solo
                                            ></v-select>
                                        </v-col>
                                        
                                        <v-col cols="12" md="4">
                                        <v-select
                                                class="mt-2 mb-2"
                                                outlined
                                                dense
                                                attach
                                                color="#2E7D32"
                                                clearable
                                                item-text="event.event_name"
                                                item-value="event.id"
                                                :items="allEvent"
                                                v-model="event"
                                                label="Event"
                                            ></v-select>
                                        </v-col>
                                </v-row>

                                    <v-row>

                                        <v-col cols="12" md="4">
                                            <v-autocomplete
                                                v-model="selectProvince"
                                                :items="allprovince"
                                                item-text="name"
                                                item-value="name"
                                                dense
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

                                        <v-col cols="12" md="4">
                                        <v-autocomplete
                                                v-model="selectDistrict"
                                                :items="alldistrict"
                                                item-text="name"
                                                item-value="name"
                                                dense
                                                filled
                                                clearable
                                                label="District"
                                                color="black"
                                                outlined
                                                background-color="#FFFFFF"
                                                >
                                        </v-autocomplete>
                                        </v-col>

                                        <v-col cols="12" md="4">
                                        <v-btn
                                        @click="filterDetails()"
                                        block
                                        depressed
                                        color="primary"
                                        >
                                        Search Here
                                    </v-btn>
                                        </v-col>
                                </v-row>
                            </v-col>

                            
                        </v-row>

                        <template>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div id="chartdiv"></div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-row>
                               
                                <v-col cols="4" >
                                <v-card
                                    elevation="4"
                                    class="mx-auto rounded-lg"
                                    max-width="250"
                                    outlined
                                >
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <v-list-item-title
                                                class="text-h5 mb-1"
                                            >
                                                Total Players
                                            </v-list-item-title>
                                            <v-list-item-subtitle
                                                >{{ this.totalPlayer }}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-card>
                                </v-col>

                                <v-col cols="4" >
                                <v-card
                                    elevation="4"
                                    class="mx-auto rounded-lg"
                                    max-width="250"
                                    outlined
                                >
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <v-list-item-title
                                                class="text-h5 mb-1"
                                            >
                                                Province
                                            </v-list-item-title>
                                            <v-list-item-subtitle
                                                >{{ this.provinceCount }}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-card>
                                </v-col>

                                

                                <v-col cols="4" >
                                <v-card
                                    elevation="4"
                                    class="mx-auto rounded-lg"
                                    max-width="250"
                                    outlined
                                >
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <v-list-item-title
                                                class="text-h5 mb-1"
                                            >
                                                District
                                            </v-list-item-title>
                                            <v-list-item-subtitle
                                                >{{ this.districtCount }}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-card>
                                </v-col>

                                 <v-col cols="4" >
                                <v-card
                                    elevation="4"
                                    class="mx-auto rounded-lg"
                                    max-width="250"
                                    outlined
                                >
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <v-list-item-title
                                                class="text-h5 mb-1"
                                            >
                                                   Game
                                            </v-list-item-title>
                                            <v-list-item-subtitle
                                                >{{ this.totalGame }}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-card>
                                </v-col>

                                 <v-col cols="4">
                                <v-card
                                    elevation="4"
                                    class="mx-auto rounded-lg"
                                    max-width="250"
                                    outlined
                                >
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <v-list-item-title
                                                class="text-h5 mb-1"
                                            >
                                                   Events
                                            </v-list-item-title>
                                            <v-list-item-subtitle
                                                >{{ this.totalEvent }}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-card>
                                </v-col>
                                </v-row>

                                <v-row>
                               
                                    
                             <!-- <v-col cols="4">
                                <v-card
                                    elevation="4"
                                    class="mx-auto rounded-lg"
                                    max-width="250"
                                    outlined
                                >
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <v-list-item-title
                                                class="text-h5 mb-1"
                                            >
                                              District Level
                                            </v-list-item-title>
                                            <v-list-item-subtitle
                                                >{{  this.distric }}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-card>
                                </v-col> -->
                                </v-row>



                                </v-col>

                                
                            </v-row>
                                

                                  
                               
                        </template>

                        

                        <template>
                            <V-row>
                                    <v-col cols="12" md="12">
                                    <div class="hello" ref="chartxy"></div>
                                    </v-col>
                                </V-row>  

                        </template>

                        
                         
                    </v-container>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import { mapState } from "vuex";
import { store } from "../store/store.js";

import OpsDSD from "./CMCLineChart";

import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";



am4core.useTheme(am4themes_animated);
// function am4themes_myTheme(target) {
//     if (target instanceof am4core.ColorSet) {
//         target.list = [
//             am4core.color("#FF3D00"),
//             am4core.color("#068101"),
//             am4core.color("#651FFF"),
//             am4core.color("#00B0FF"),
//             am4core.color("#D32F2F"),
//             am4core.color("#304FFE"),
//             am4core.color("#00BCD4"),
//             am4core.color("#00BFA5"),
//             am4core.color("#43A047"),
//             am4core.color("#009688"),
//             am4core.color("#9C27B0"),
//             am4core.color("#607D8B"),
//             am4core.color("#FF5722"),
//         ];
//     }
// }
// am4core.useTheme(am4themes_myTheme);

export default {
    components: {
        OpsDSD,
        store,
        mapState,
    },

    data() {
        return {
            loadingDiscrtict: false,
            loadingEvent: false,  
            totalPlayer:"",
            games: "",
            events: "",
            provinceCount: "",
            districtCount: "",
            provinceList: "",
            totalGame: "",
            totalEvent: "",



            selectFilterCategory:"",
            gender: "",
            game: "",
            event: "",
            selectProvince: "",
            selectDistrict: "",


            selectGame: "",
            allGender: [
                'Male',
                'Female',
            ],
            allGame: [],
            allEvent: [],
            allprovince: [],
            alldistrict: [],

            filterdetails:[],

        };
    },
    computed: {
        ...mapState({
            httpheader: (state) => state.httpheader,
        }),
    },

    watch: {},

    mounted() {
        // this.totalPlayers();
        this.getAllGameDetails();
        this.pieChart();
        this.xyChart();
       

       

        
        
    },

    created() {
        this.getComboboxData();
        this.getAllProvince();
        this.getGender();
        this.getAllGameDetails();
    },

    methods: {

        pieChart(){
             var chart = am4core.create("chartdiv", am4charts.PieChart);

                // Add data
                chart.data = [{
                "name": "Total Player",
                "litres": 501.9
                }, {
                "name": "Province",
                "litres": 301.9
                }, {
                "name": "District",
                "litres": 201.1
                }, {
                "name": "Game",
                "litres": 165.8
                }, {
                "name": "Event",
                "litres": 139.9
                }];

                // Add and configure Series
                var pieSeries = chart.series.push(new am4charts.PieSeries());
                pieSeries.dataFields.value = "litres";
                pieSeries.dataFields.category = "name";

                // Let's cut a hole in our Pie chart the size of 40% the radius
                chart.innerRadius = am4core.percent(40);

                // Put a thick white border around each Slice
                pieSeries.slices.template.stroke = am4core.color("#4a2abb");
                pieSeries.slices.template.strokeWidth = 2;
                pieSeries.slices.template.strokeOpacity = 1;


                // Add a legend
                chart.legend = new am4charts.Legend();
        },

        xyChart(){
                    // ----------------------------------------------------------------------------------------------------------
            let chart = am4core.create(this.$refs.chartxy, am4charts.XYChart);

            chart.paddingRight = 20;

            let data = [];
            let visits = 10;
            for (let i = 1; i < 366; i++) {
            visits += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
            data.push({ date: new Date(2018, 0, i), name: "name" + i, value: visits });
            }

            chart.data = data;

            let dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.grid.template.location = 0;

            let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.tooltip.disabled = true;
            valueAxis.renderer.minWidth = 35;

            let series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.dateX = "date";
            series.dataFields.valueY = "value";

            series.tooltipText = "{valueY.value}";
            chart.cursor = new am4charts.XYCursor();

            let scrollbarX = new am4charts.XYChartScrollbar();
            scrollbarX.series.push(series);
            chart.scrollbarX = scrollbarX;

            this.chart = chart;
        },

  beforeDestroy() {
    if (this.chart) {
      this.chart.dispose();
    }

        },

        // Get Game Details--------------------------------------------------
    getAllGameDetails(){  
        // alert('dfsdfiu')
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

    filterDetails(){
        this.totalPlayer = "";
        this.provinceCount = "";
        this.districtCount = "";
        let laravel = JSON.parse(window.Laravel);
       const header = {
        "X-CSRF-TOKEN": laravel.csrfToken,
        "X-Requested-With": "XMLHttpRequest",
        "content-type": "multipart/form-data",
      };

      let formData = new FormData();

      // formData.append("userID", laravel.user.id);
      formData.append("gender",this.gender);
      formData.append("selectGame", this.selectGame);
      formData.append("event",this.event);
      formData.append("selectProvince",this.selectProvince);
      formData.append("selectDistrict",this.selectDistrict); 
      formData.append("selectFilterCategory",this.selectFilterCategory);
      
      axios
        .post("/api/player/filterDetails",formData,header)
        .then((response) => {
          if (response.data.http_status == "success") {
            this.filterdetails = response.data.data;
            this.totalPlayer = response.data.totalPlayer;
            this.provinceCount = response.data.provinceCount;
            this.provinceList = response.data.provinceList;
            this.districtCount = response.data.districtCount;
            this.districtList = response.data.districtList;
            this.totalGame = response.data.totalGame;
            this.totalEvent = response.data.totalEvent;

            this.total_players = response.data.totalProvince;
            this.total_players = response.data.totalDistricy;

            

            
            console.log('filterdetails-----------------------', response.data.data);
            
          } else {
            
          }
        })
        .catch((error) => {
          
        });

    },


        
















    getComboboxData(){  
      let laravel = JSON.parse(window.Laravel);
            // console.log(laravel);
      //this.event_data = [];   
      let eventDetails = this.event;
      const header = {
                'X-CSRF-TOKEN': laravel.csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'content-type': 'multipart/form-data',
      };
      axios.post("/api/dashboard/get-box-data",{eventCatagary:eventDetails},header)
                    .then(response => {
                        if (response.data.http_status == 'success'){
                          this.event_data = response.data.data
                         // console.log('aaaaaaaaasssssssssdddd',response.data.data[0]['Event']);
                            
                        }else{

                        }
                    }).catch((error) => {

                });
    },


        // getComboboxData() {
        //     axios
        //         .post("/api/dashboard/get-box-data", store.state.httpheader)
        //         .then((response) => {
        //             this.event_data = response.data.event_data;
        //             this.game_data = response.data.game_data;
        //             this.distric_data = response.data.distric_data;
        //             this.gender_data = response.data.gender_data;
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },

        // totalPlayers() {
        //     axios
        //         .post("/api/dashboard/allPlayers", store.state.httpheader)
        //         .then((response) => {
        //             this.total_players = response.data.totalPlayer
                    
        //             this.games = response.data.game;
        //             this.events = response.data.events;
                    
        //             this.maleCount = response.data.maleCount;
        //             this.totalGame = response.data.totalGame;
        //             this.totalProvince = response.data.totalProvince;
        //             this.totalDistrict = response.data.totalDistrict;
        //             this.gameList = response.data.gameList;     



        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },

        clear() {
            this.totalPlayers();
            this.event= null
            this.game= null
            this.district= null
            this.gender= null
        },
    },

    name: "PlanningHome",
};
</script>

<style scoped>
#chartdiv {
  width: 100%;
  height: 400px;
}
  
#chartxy{
  width: 100%;
  height: 400px;
}
</style>
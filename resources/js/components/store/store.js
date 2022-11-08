import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {
    gmap:null,
    httpheader:{},
    districtData:null,
    kmlList:[],
    search:'',
    searchBar:false,
    statBar:false,
    statCard:false,

    selectedGISLayers:[],
    legendPanel:false,
    analysePanel:false,
    userBarPanel:false,


    crops:[],
    geocode:{},

    mapContextMenu:{
      x:0,
      y:0,
      visible:false
    },

    drawingManagerOptions:{
      drawingMode: null,
      drawingControl: false,
      markerOptions: {
        draggable: false,
        optimized: false,
      },
      circleOptions: {
        fillColor: '#0537F3F7',
        fillOpacity: 0.9,
        strokeWeight: 2,
        clickable: true,
        editable: false,
        draggable: false
      },
      rectangleOptions: {
        fillColor: '#0537F3F7',
        fillOpacity: 0.9,
        strokeWeight: 2,
        clickable: true,
        editable: false,
        draggable: false
      },
      polylineOptions: {
        editable: false,
        draggable: false,
        strokeWeight: 2,
        strokeColor: '#0537F3F7',
      },
      polygonOptions: {
        editable: false,
        fillColor: '#0537F3F7',
        fillOpacity: 0.9,
        strokeWeight: 2,
        draggable: false
      },
    },
    drawingManager:null,
    drawingToolBearing:null,
    drawingToolMeasurementText:null  ,
    selectedDrawingTool:null,

    currentLocation:null,
    currentGNDData:null,
    getAllTempFarmers:[],


  },
  mutations: {
    changeMap(state, gmap) {
      state.gmap = gmap;
    },
    setALlTempFarmers(state, payload){
      state.getAllTempFarmers = payload;
    },
    setHttpHeader(state, payload) {
      state.httpheader = payload;
    },
    setDistrictData(state, data) {
      state.districtData = data;
    },




    addToKMLToList(state,{name,type, kml}) {
      state.kmlList.push({
        name:name,
        type:type,
        kml:kml
      });
    },

    showAnalyse(state,value){
      state.analysePanel = value;
    },

    showHideStatCard(state,value){
      state.statCard = value;
    },
    changeSearch(state, search) {
      state.search = search;
    },

    setSearchBar(state, status) {
      state.searchBar = status;
    },
    setStatBar(state, status) {
      state.statBar = status;
    },

    showMapContextMenu(state,payload){
      state.mapContextMenu = {
        x:payload.datax,
        y:payload.datay,
        latLng:payload.latLng,
        address:payload.address,
        visible:true
      }
    },



    initDrawingManager(state,payload){
      state.drawingManager = payload;
    },
    setDrawingManagerOptions(state,payload){
      if (payload.action === 'changeColor' ){
        switch (payload.shape) {
          case 'polygon': state.drawingManagerOptions.polygonOptions.fillColor = payload.color;
            break;
          case 'rectangle': state.drawingManagerOptions.rectangleOptions.fillColor = payload.color;
            break;
          case 'circle': state.drawingManagerOptions.circleOptions.fillColor = payload.color;
            break;
          case 'polyline': state.drawingManagerOptions.polylineOptions.strokeColor = payload.color;
            break;
          case 'all':   state.drawingManagerOptions.polylineOptions.strokeColor = payload.color;
            state.drawingManagerOptions.circleOptions.fillColor = payload.color;
            state.drawingManagerOptions.rectangleOptions.fillColor = payload.color;
            state.drawingManagerOptions.polygonOptions.fillColor = payload.color;
            console.log(state.drawingManagerOptions);
            break;
        }
        state.drawingManager.setOptions(state.drawingManagerOptions);
      }
    },
    setDrawingManagerOverlayComplete(state,payload){
      state.selectedDrawingTool = payload.selectedDrawingTool;
      state.drawingToolMeasurementText = payload.drawingToolMeasurementText;
      state.drawingToolBearing = payload.drawingToolBearing;
    },


    setGeocode(state,payload){
      state.geocode = payload;
    },
    setPatients(state,payload){
      state.crops = payload;
    },
    setcurrentLocation(state,payload){
      state.currentLocation = payload;
    },
    setcurrentGNDData(state,payload){
      state.currentGNDData = payload;
    },


  },
  getters: {
    gmap: state => state.gmap,
    httpheader: state => state.httpheader,
    search: state => state.search,
    districtData: state => state.districtData,
    mapContextMenu: state => state.mapContextMenu,
    searchBar: state => state.searchBar,
    statBar: state => state.statBar,
    geocode: state => state.geocode,
    crops: state => state.crops,
    currentLocation: state => state.currentLocation,
    currentGNDData: state => state.currentGNDData,
    getAllTempFarmers: state => state.getAllTempFarmers
  }
});

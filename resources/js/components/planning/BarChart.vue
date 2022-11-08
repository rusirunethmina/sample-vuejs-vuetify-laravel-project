<template>
    <div v-ripple="{ center: true }" class="bachart_anual" ref="chartdivBachart_anual"></div>
</template>

<script>
    import * as am4core from "@amcharts/amcharts4/core";
    import * as am4charts from "@amcharts/amcharts4/charts";
    import am4themes_animated from "@amcharts/amcharts4/themes/animated";
    import {store} from '../store/store';
    import {mapState} from 'vuex';
    am4core.useTheme(am4themes_animated);

    export default {
        name: "BarChart",
        data() {
            return {
                chartData2020:{
                    Colombo:0,
                    Kalutara:0,
                    Gampaha:0
                }
            }
        },
        computed: {
            ...mapState({
                allPatients: state => state.allPatients,
                whoPatients: state => state.whoPatients,
                ransPatients: state => state.ransPatients,
                visibleRansPatients: state => state.visibleRansPatients,
                visibleWHOPatients: state => state.visibleWHOPatients,
                ransClusterLocations: state => state.ransClusterLocations,
                whoClusterLocations: state => state.whoClusterLocations,
                gmap: state => state.gmap,
                pageload: state => state.pageload,
                weekDengueLoader: state => state.weekDengueLoader,
            }),
            patientData(){
                return store.state.allPatients;
            }
        },
        watch:{
            patientData(data){
                let allPatients = data;
                let colombo = _.filter(allPatients,{District:'Colombo'});
                let gampaha = _.filter(allPatients,{District:'Gampaha'});
                let kalutara = _.filter(allPatients,{District:'Kalutara'});

                this.chartData2020.kalutara = kalutara.length;
                this.chartData2020.Gampaha = gampaha.length;
                this.chartData2020.Colombo = colombo.length;
                console.log('------------------------------BAR CHART-----------------');
                console.log(allPatients);

                this.initChart();

                // console.log(this.chartData);
            }
        },
        methods: {
            initChart() {
                let chart = am4core.create(
                    this.$refs.chartdivBachart_anual,
                    am4charts.XYChart
                );
                chart.fontSize = 10;
                chart.logo.disabled = true;
                chart.colors.list = [
                    am4core.color("#FF3D00"),
                    am4core.color("#651FFF"),
                    am4core.color("#00B0FF"),
                    am4core.color("#004D40"),
                    am4core.color("#D32F2F"),
                ];
                // Add data
                chart.data = [{
                    year: 2018,
                    Colombo: 10258,
                    Gampaha: 5857,
                    Kaluthara: 3155
                },{
                    year: 2019,
                    Colombo: 20718,
                    Gampaha: 16573,
                    Kaluthara: 8395
                },{
                    year: 2020,
                    Colombo: this.chartData2020.Colombo,
                    Gampaha: this.chartData2020.Gampaha,
                    Kaluthara: this.chartData2020.kalutara
                }];


                let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "year";
                categoryAxis.numberFormatter.numberFormat = "#";
                categoryAxis.renderer.inversed = true;
                categoryAxis.renderer.grid.template.location = 10;
                categoryAxis.renderer.cellStartLocation = 0.1;
                categoryAxis.renderer.cellEndLocation = 0.9;

                let  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                let series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueY = "Colombo";
                series.dataFields.categoryX = "year";
                series.name = "Colombo";
                series.columns.template.tooltipText = "Colombo {categoryX}: [bold]{valueY}[/]";

                let series1 = chart.series.push(new am4charts.ColumnSeries());
                series1.dataFields.valueY = "Gampaha";
                series1.dataFields.categoryX = "year";
                series1.name = "Gampaha";
                series1.columns.template.tooltipText = "Gampaha {categoryX}: [bold]{valueY}[/]";

                let series2 = chart.series.push(new am4charts.ColumnSeries());
                series2.dataFields.valueY = "Kaluthara";
                series2.dataFields.categoryX = "year";
                series2.name = "Kaluthara";
                series2.columns.template.tooltipText = "Kaluthara {categoryX}: [bold]{valueY}[/]";
                chart.legend = new am4charts.Legend();
                chart.legend.useDefaultMarker = true;
                let marker = chart.legend.markers.template.children.getIndex(0);
                marker.cornerRadius(12, 12, 12, 12);
                marker.padding(2, 2, 2, 2);
                marker.strokeWidth = 2;
                marker.strokeOpacity = 1;
                marker.stroke = am4core.color("#ccc");
            }
        },
        mounted() {

        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .bachart_anual {
        width: 100%;
        height: 252px;
    }
</style>

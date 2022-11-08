<template>
    <div
        v-ripple="{ center: true }"
        class="CMCLineChart"
        ref="chartdiv_CMCLineChart"
    ></div>
</template>

<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
am4core.useTheme(am4themes_animated);

export default {
    name: "CMCLineChart",
    mounted() {
        let chart = am4core.create(
            this.$refs.chartdiv_CMCLineChart,
            am4charts.XYChart
        );
        chart.fontSize = 10;
        chart.logo.disabled = true;
        // Add percent sign to all numbers
        chart.data = [];
        chart.colors.list = [
            am4core.color("#FF3D00"),
            am4core.color("#651FFF"),
            am4core.color("#00B0FF"),
            am4core.color("#004D40"),
            am4core.color("#D32F2F"),
        ];

        // Data for both series
        let data = [
            {
                year: "Jan",
                //"2015": 6.15322335795972,
                2016: 3.84684201109322,
                2017: 1.86146933535625,
                2018: 3.44121661142523,
                2019: 1.22598706438845,
            },
            {
                year: "Feb",
                //"2015": 3.29926120837972,
                2016: 1.75940836166279,
                2017: 1.26334831067281,
                2018: 1.49151881458374,
                2019: 0.627473694372044,
            },
            {
                year: "Mar",
                // "2015": 1.45734237425362,
                2016: 0.632194190970358,
                2017: 1.6805741961837,
                2018: 1.01384285435757,
                2019: 0.830195964861473,
            },
            {
                year: "Apr",
                //"2015": 0.941200283372128,
                2016: 1.04371682471521,
                2017: 1.52885569236156,
                2018: 1.14057321115227,
                2019: 0.52128583840139,
            },
            {
                year: "May",
                //"2015": 1.78119623519887,
                2016: 0.918470805749389,
                2017: 1.24000700239248,
                2018: 1.25755507896276,
                2019: 0.888116613572739,
            },
            {
                year: "Jun",
                //"2015": 1.44722194109908,
                2016: 2.26039243752609,
                2017: 1.82353970940071,
                2018: 3.48995905634627,
                2019: 1.04257167680278,
            },
            {
                year: "Jul",
                //"2015": 1.94312316567149,
                2016: 3.47706805033697,
                2017: 2.92349886211122,
                2018: 3.82140768180932,
                2019: 1.55420407375229,
            },
            {
                year: "Aug",
                //"2015": 1.4775832405627,
                2016: 1.56855728514344,
                2017: 1.38005485207446,
                2018: 2.32988886722558,
                2019: 1.46732310068539,
            },
            {
                year: "Sep",
                //"2015": 0.71855075397227,
                2016: 1.71765968867418,
                2017: 0.452237847931377,
                2018: 0.799376096705011,
                2019: 1.12945264986968,
            },
            {
                year: "Oct",
                //"2015": 1.49782410687177,
                2016: 0.495019979722073,
                2017: 0.496002800956994,
                2018: 0.692142717878729,
                2019: 2.98774012935612,
            },
            {
                year: "Nov",
                //"2015": 3.16769557737071,
                2016: 0.912506709608159,
                2017: 0.761510182645737,
                2018: 2.15441606550985,
                2019: 4.416449464234,
            },
            {
                year: "Dec",
                //"2015": 3.37010424046149,
                2016: 4.3239697023916,
                2017: 1.36546653439925,
                2018: 2.56385260284656,
                2019: 3.87103002220292,
            },
        ];

        /* Create axes */
        let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "year";
        categoryAxis.renderer.minGridDistance = 30;

        /* Create value axis */
        let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        let lineSeries1 = chart.series.push(new am4charts.LineSeries());
        lineSeries1.name = "2016";
        lineSeries1.dataFields.valueY = "2016";
        lineSeries1.dataFields.categoryX = "year";

        lineSeries1.stroke = am4core.color("#43A047");
        lineSeries1.strokeWidth = 1;
        lineSeries1.propertyFields.strokeDasharray = "lineDash";
        lineSeries1.tooltip.label.textAlign = "middle";

        let lineSeries2 = chart.series.push(new am4charts.LineSeries());
        lineSeries2.name = "2017";
        lineSeries2.dataFields.valueY = "2017";
        lineSeries2.dataFields.categoryX = "year";

        lineSeries2.stroke = am4core.color("#E65100");
        lineSeries2.strokeWidth = 1;
        lineSeries2.propertyFields.strokeDasharray = "lineDash";
        lineSeries2.tooltip.label.textAlign = "middle";

        let lineSeries3 = chart.series.push(new am4charts.LineSeries());
        lineSeries3.name = "2018";
        lineSeries3.dataFields.valueY = "2018";
        lineSeries3.dataFields.categoryX = "year";

        lineSeries3.stroke = am4core.color("#fdd400");
        lineSeries3.strokeWidth = 1;
        lineSeries3.propertyFields.strokeDasharray = "lineDash";
        lineSeries3.tooltip.label.textAlign = "middle";

        let lineSeries4 = chart.series.push(new am4charts.LineSeries());
        lineSeries4.name = "2019";
        lineSeries4.dataFields.valueY = "2019";
        lineSeries4.dataFields.categoryX = "year";

        lineSeries4.stroke = am4core.color("#6200EA");
        lineSeries4.strokeWidth = 1;
        lineSeries4.propertyFields.strokeDasharray = "lineDash";
        lineSeries4.tooltip.label.textAlign = "middle";

        // let lineSeries5 = chart.series.push(new am4charts.LineSeries());
        // lineSeries5.name = "2019";
        // lineSeries5.dataFields.valueY = "2019";
        // lineSeries5.dataFields.categoryX = "year";
        //
        // lineSeries5.stroke = am4core.color("#00B0FF");
        // lineSeries5.strokeWidth =2;
        // lineSeries5.propertyFields.strokeDasharray = "lineDash";
        // lineSeries5.tooltip.label.textAlign = "middle";

        let bullet1 = lineSeries1.bullets.push(new am4charts.Bullet());
        bullet1.fill = am4core.color("#43A047"); // tooltips grab fill from parent by default
        bullet1.tooltipText =
            "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff]{additional}[/]";
        let circle1 = bullet1.createChild(am4core.Circle);
        circle1.radius = 1;
        circle1.fill = am4core.color("#fff");
        circle1.strokeWidth = 1;

        let bullet2 = lineSeries2.bullets.push(new am4charts.Bullet());
        bullet2.fill = am4core.color("#E65100"); // tooltips grab fill from parent by default
        bullet2.tooltipText =
            "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff]{additional}[/]";
        let circle2 = bullet2.createChild(am4core.Circle);
        circle2.radius = 1;
        circle2.fill = am4core.color("#fff");
        circle2.strokeWidth = 1;

        let bullet3 = lineSeries3.bullets.push(new am4charts.Bullet());
        bullet3.fill = am4core.color("#fdd400"); // tooltips grab fill from parent by default
        bullet3.tooltipText =
            "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff]{additional}[/]";
        let circle3 = bullet3.createChild(am4core.Circle);
        circle3.radius = 1;
        circle3.fill = am4core.color("#fff");
        circle3.strokeWidth = 1;

        let bullet4 = lineSeries4.bullets.push(new am4charts.Bullet());
        bullet4.fill = am4core.color("#6200EA"); // tooltips grab fill from parent by default
        bullet4.tooltipText =
            "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff]{additional}[/]";
        let circle4 = bullet4.createChild(am4core.Circle);
        circle4.radius = 1;
        circle4.fill = am4core.color("#fff");
        circle4.strokeWidth = 1;

        // Add legend
        chart.legend = new am4charts.Legend();
        chart.legend.fontSize = 9;
        chart.data = data;
    },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.CMCLineChart {
    width: 100%;
    height: 100%;
}
</style>

var Hackathon_HealthCheck = {

    init : function(url) {
        this.url = url;
    },

    showData : function(checkIdentifier) {
        jQuery.getJSON(this.url, {checkIdentifier: checkIdentifier} , function(data) {

            /*
             *   TYPE TABLE
             */
            if(data['type'] == "table") {
                jQuery.jsontotable(data['content'], {
                    header: false,
                    id: '#' + checkIdentifier,
                    className: "health-table"
                });
            }
            /*
             *   TYPE PLAINTEXT
             */
            else if(data['type'] == "plaintext") {
                jQuery('#' + checkIdentifier).append(data['content']);
            }
            /*
             *   TYPE PIECHART
             */
            else if(data['type'] == "piechart") {
                var pieChartSource = [];
                jQuery.each(data['content'], function(key, value) {
                    pieChartSource.push({ type: key, value: parseFloat(value)});
                });

                jQuery(function () {
                    jQuery('#' + checkIdentifier).dxPieChart({
                        dataSource: pieChartSource ,
                        series: {
                            argumentField: 'type',
                            valueField: 'value',
                            border: {
                                visible: true
                            },
                            label: {
                                visible: false
                            }
                        },
                        legend: {
                            horizontalAlignment: 'right',
                            //verticalAlignment: 'bottom',
                            font: {
                                size: 15
                            }
                        },
                        tooltip: {
                            enabled: true
                        }
                    });
                });
            }
            /*
             *   TYPE BARCHART
             */
            else if(data['type'] == "barchart") {
                var barChartSource = [];
                jQuery.each(data['content'], function(key, value) {
                    barChartSource.push({ name: key, value: parseFloat(value)})
                });

                jQuery('#' + checkIdentifier).dxChart({
                    rotated: true,
                    dataSource: barChartSource,
                    series: {
                        argumentField: "name",
                        valueField: "value",
                        name: "Size in KB",
                        type: "bar",
                        color: '#16a085'
                    },
                    tooltip: { enabled: true }
                });
            }
            /*
             *   TYPE DONUT
             */
            else if(data['type'] == "donutchart") {
                var donutChartSource = [];
                jQuery.each(data['content'], function(key, value) {
                    donutChartSource.push({ name: key, value: parseFloat(value)})
                });

                $('#' + checkIdentifier).dxPieChart({
                    dataSource: donutChartSource,
                    tooltip: {
                        enabled: true,
                        percentPrecision: 2,
                        customizeText: function() {
                            return this.valueText + " - " + this.percentText;
                        }
                    },
                    legend: {
                        horizontalAlignment: "right",
                        verticalAlignment: "top",
                        margin: 0
                    },
                    series: [{
                        type: "doughnut",
                        argumentField: "region",
                        label: {
                            visible: true,
                            format: "millions",
                            connector: {
                                visible: true
                            }
                        }
                    }]
                });
            }
        })
    }
}
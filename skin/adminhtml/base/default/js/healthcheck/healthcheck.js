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
             *   TYPE DONUT
             */
            else if(data['type'] == "donutchart") {

            }
        })
    }
}
var Hackathon_HealthCheck = {

    showData : function(checkIdentifier, domId) {
        jQuery.getJSON("check/ajax", {checkIdentifier: checkIdentifier} , function(data) {
            /*
             *   TYPE TABLE
             */
            if(data['type'] == "table") {
                jQuery.jsontotable(data['content'], {
                    header: false,
                    id: domId,
                    className: "health-table"
                });
            }
            /*
             *   TYPE PLAINTEXT
             */
            else if(data['type'] == "plaintext") {
                jQuery(domId).append(data['content']);
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
                    jQuery(domId).dxPieChart({
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
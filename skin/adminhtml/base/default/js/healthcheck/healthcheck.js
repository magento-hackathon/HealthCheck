var Hackathon_HealthCheck = {
    showData : function(checkIdentifier, domId) {
        $.getJSON("http://mage.local/magento/index.php/healthcheck/check/ajax", {checkIdentifier: checkIdentifier} , function(data) {
            /*
             *   TYPE TABLE
             */
            if(data['type'] == "table") {
                $.jsontotable(data['content'], {
                    header: false,
                    id: domId,
                    className: "health-table"
                });
            }
            /*
             *   TYPE PLAINTEXT
             */
            else if(data['type'] == "plaintext") {
                $(domId).append(data['content']);
            }
            /*
             *   TYPE PIECHART
             */
            else if(data['type'] == "piechart") {
                var pieChartSource = [];
                $.each(data['content'], function(key, value) {
                    pieChartSource.push({ type: key, value: parseFloat(value)});
                });

                $(function () {
                    $(domId).dxPieChart({
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
                            horizontalAlignment: 'center',
                            verticalAlignment: 'bottom',
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
<div style=" margin-top:3rem; display:flex; flex-direction:row; justify-content:space-between; align-items:center;">
<div id="yearStaffNo" style="width:30%; height:400px; margin-top:3rem;"></div>
<div id="durationStaffNo" style="width:30%; height:400px; margin-top:3rem;"></div>
<div id="programStaffNo" style="width:30%; height:450px; margin-top:3rem;"></div>
</div>


<script src="https://code.highcharts.com/dashboards/dashboards.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/dashboards/modules/dashboards-plugin.js"></script>
<script>
$(document).ready(function() {
    $.ajax({
        url: '<?php echo URL; ?>casuals/yearStaffNoData', 
        dataType: 'json',
        success: function(data) {
            var yearStaffNoJson = data;
            var year = [];
            var staffNumbers = [];
            yearStaffNoJson.forEach(function(item) {
                if (item.year_worked !== null){
                    year.push(parseInt(item.year_worked));
                    staffNumbers.push(parseInt(item.staff_no)); 
                }
               
            });
            year.sort()
            Highcharts.chart('yearStaffNo', {
                chart: {
                    type: 'column',
                    backgroundColor: 'transparent' 
                },
                title: {
                    text: 'Number of casuals hired per year'
                },
                yAxis: {
                    title: {
                            text: null
                        },
                        gridLineWidth: 0, 
                        labels: {
                            enabled: false 
                        }
                },
                xAxis: {
                    categories: year,
                    title: {
                        text: 'Year'
                    }
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            format: '{y}', 
                            style: {
                                color: 'black'
                            }
                        }
                    }
                },
                  series: [{
                    name: null,
                    data: staffNumbers,
                    color: '#E600A0',
                    showInLegend: false
                }]
            });
        },
        error: function(xhr, status, error) {
        
            console.error('Error fetching data:', error);
        }
    });
    $.ajax({
        url: '<?php echo URL; ?>casuals/durationStaffNoData', 
        dataType: 'json',
        success: function(data) {
         
            var durationStaffNoJson = data;
            var duration = [];
            var staffNumbers = [];
            durationStaffNoJson.forEach(function(item) {
                if (item.duration_worked !== null){
                    duration.push(parseInt(item.duration_worked));
                    staffNumbers.push(parseInt(item.staff_no)); 
                }
               
            });
           duration.sort(function(a, b) {
                 return a - b;
            });
            Highcharts.chart('durationStaffNo', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Number of casuals hired by duration worked',
                    style: {
                        color: '#20253A' 
                    }
                },
                yAxis: {
                    title: {
                            text: null
                        },
                        gridLineWidth: 0, 
                        labels: {
                            enabled: false 
                        }
                },
                xAxis: {
                    categories: duration,
                    title: {
                        text: 'Duration Worked (days)'
                    }
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            format: '{y}', 
                            style: {
                                color: 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: null,
                    data: staffNumbers,
                    color: '#E600A0',
                    showInLegend: false
                }]
            });
        },
        error: function(xhr, status, error) { 
        console.error('Error fetching data:', error);
        }
    });
    $.ajax({
        url: '<?php echo URL; ?>casuals/programStaffNoData', 
        dataType: 'json',
        success: function(data) {
            
            var programStaffNoJson = data;
            var program = [];
            var staffNumbers = [];
            console.log(programStaffNoJson);
            programStaffNoJson.forEach(function(item) {
                if (item.name !== null){
                    program.push(item.name);
                    staffNumbers.push(parseInt(item.staff_no)); 
                }
               
            });
           
            Highcharts.chart('programStaffNo', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Number of casuals Hired by program worked'
                },
                yAxis: {
                    title: {
                            text: null
                        },
                        gridLineWidth: 0, 
                        labels: {
                            enabled: false 
                        }
                },
                xAxis: {
                    categories: program,
                    title: {
                        text: 'program'
                    }
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            format: '{y}', 
                            style: {
                                color: 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: null,
                    data: staffNumbers,
                    color: '#E600A0',
                    showInLegend: false
                }],
                bacgroundColor: '#ffffff'
            });
        },
        error: function(xhr, status, error) { 
        console.error('Error fetching data:', error);
         }
    })
});


</script>
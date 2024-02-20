<div style="display:flex; flex-direction:column; align-items:center;">
<div id="yearStaffNo" style="width:50%; height:400px; margin-top:3rem;background-color: white"></div>
<div id="durationStaffNo" style="width:50%; height:400px; margin-top:3rem;background-color: white"></div>
<div id="programStaffNo" style="width:50%; height:400px; margin-top:3rem;background-color: white"></div>
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
                    type: 'column'
                },
                title: {
                    text: 'Number of Casuals Hired per year'
                },
                yAxis: {
                    title: {
                        text: 'Number of Staff'
                    }
                },
                xAxis: {
                    categories: year,
                    title: {
                        text: 'Year'
                    }
                },
               
                series: [{
                    name: 'Staff Hired',
                    data: staffNumbers,
                    color: '#E600A0'
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
           
            Highcharts.chart('durationStaffNo', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Number of Casuals Hired by duration worked'
                },
                yAxis: {
                    title: {
                        text: 'Number of Staff'
                    }
                },
                xAxis: {
                    categories: duration,
                    title: {
                        text: 'Duration Worked (days)'
                    }
                },
               
                series: [{
                    name: 'Staff Duration Hired',
                    data: staffNumbers,
                    color: '#E600A0'
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
                    program.push(parseInt(item.name));
                    staffNumbers.push(parseInt(item.staff_no)); 
                }
               
            });
           
            Highcharts.chart('programStaffNo', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Number of Casuals Hired by program worked'
                },
                yAxis: {
                    title: {
                        text: 'Number of Staff'
                    }
                },
                xAxis: {
                    categories: program,
                    title: {
                        text: 'program'
                    }
                },
               
                series: [{
                    name: 'Staff Program Hired',
                    data: staffNumbers,
                    color: '#E600A0'
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
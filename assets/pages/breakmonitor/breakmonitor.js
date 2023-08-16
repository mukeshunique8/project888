// breakmonitor.js

function updateBreakCounts() {
    $.ajax({
        url: 'get_break_count.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log(data);

            // Clear previous data rows
            $('#breakCounts tr:gt(0)').remove();

            // Append updated break counts
            for (var employeeName in data) {
                var breakCountDiv = $('<div>').text("Total Breaks: " + data[employeeName]);
                var row = $('<tr>');
                row.append($('<td>').text(employeeName));
                row.append($('<td>').text(data[employeeName]));
                $('#breakCounts').append(row);
            }
        },
        error: function () {
            console.log('Error fetching break counts from server.');
        }
    });


    $.ajax({
        url: 'get_break_data.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var table = $('#breakTable');
            table.find('tr:gt(0)').remove(); // Clear previous data rows

            for (var i = 0; i < data.length; i++) {
                var row = $('<tr>');
                row.append($('<td>').text(data[i].id));
                row.append($('<td>').text(data[i].employee_name));
                row.append($('<td>').text(data[i].check_type));
                row.append($('<td>').text(data[i].timestamp));
                table.append(row);
            }
        },
        error: function () {
            console.log('Error fetching data from server.');
        }
    });
}

function updateBreakTable() {
    
}

// Update the counts table initially and then every 5 seconds
$(document).ready(function () {
    updateBreakCounts();
    setInterval(updateBreakCounts, 5000); // Refresh every 5 seconds
});

// Update the data table initially and then every 5 seconds
$(document).ready(function () {
    updateBreakTable();
    setInterval(updateBreakTable, 5000); // Refresh every 5 seconds
});
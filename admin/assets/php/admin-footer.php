			</div>
		</div>
	</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    
    // Check Notification
        checkNotification();
        function checkNotification(){
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: { action: 'checkNotification' },
                success: function(response){
                    
                    $("#checkNotification").html(response);
                }
            });

        }


    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(pieChart);

    function pieChart() {

        var data = google.visualization.arrayToDataTable([
            ['Gender', 'Number'],
            <?php
		        $gender = $count->genderPer();
			    foreach ($gender as $row) {
				    echo '["'.$row['gender'].'",'.$row['number'].'],';
			    }
		    ?>
        ]);

        var options = {
            is3D: false
        };

        var chart = new google.visualization.PieChart(document.getElementById('chartOne'));

        chart.draw(data, options);
    }

	google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(colChart);

    function colChart() {
        var data = google.visualization.arrayToDataTable([
            ['Verified', 'Number'],
            <?php
		        $verified = $count->verifiedPer();
			    foreach ($verified as $row) {
				    if ($row['verified'] == 0) {
					    $row['verified'] = 'Unverified';
				    }
				    else {
					    $row['verified'] = 'Verified';
				    }
				    echo '["'.$row['verified'].'",'.$row['number'].'],';
			    }
		    ?>
        ]);
        var options = {
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('chartTwo'));
        chart.draw(data, options);
    }




    
</script>
</body>
</html>
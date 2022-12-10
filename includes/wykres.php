<?php

$wypozyczenia=$cms->getWypozyczenie()->getAllSort();
 
$dataPoints = array( 
	
);

foreach($wypozyczenia as $pojedynczo){



    $d=strtotime($pojedynczo['Data_wypozyczenia']);
    $data=date("Y-m-d ", $d);

    $count =$cms->getWypozyczenie()->liczDlaDaty($pojedynczo['Data_wypozyczenia']);
    $liczba=strtotime($pojedynczo['Data_wypozyczenia']);
    
    array_push( $dataPoints, array("label" => $data, "y" => $count));
}
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
    CanvasJS.addColorSet("greenShades",
                [
                   " #674400"               
                ]);
   
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light5",
    colorSet: "greenShades",
    backgroundColor: "rgb(255, 238, 207)",
	title:{
        fontFamily: 'Montserrat', 
		text: "Tabela wypożyczeń"
	},
	axisY: {
		title: "Liczba książek"
        
	},
	data: [{
		type: "splineArea",
		yValueFormatString: "#,##0.##",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 60%;" ></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 
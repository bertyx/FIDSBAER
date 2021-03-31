<?php

	$type = $_GET['type']; 		
	require ('connect.php');	
	require ('settings.php');	
	ini_set('display_errors', 'Off');		



echo ('<!DOCTYPE html>');
echo ('<html>');
echo ('<head>');
echo ('<meta http-equiv="refresh" content="10">');
echo ('<link rel="stylesheet" type="text/css" href="depstyle.css">');
echo ('<meta name="google" value="notranslate">');
echo ('<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">');
echo ('</head>');
echo ('<body>');


$isnum = is_numeric($type);

if ($type=='i') {
				$tquery = 'SELECT * FROM `departures` WHERE `type`="i" ORDER BY `departs`, `departstime` LIMIT 7';
				}

elseif ($type=='d') {
					$tquery = 'SELECT * FROM `departures` WHERE `type`="d" ORDER BY `departs`, `departstime` LIMIT 7';
					}


elseif ($isnum=='1') {
					$tquery = 'SELECT * FROM `departures` ORDER BY `departs`, `departstime` LIMIT '.$type.'';
					}


else {
	 $tquery = 'SELECT * FROM `departures` ORDER BY `departs`, `departstime` LIMIT 7';
	 }




$ttable = mysqli_query($conn, $tquery);


if(!$ttable){

	echo('<p>Oops, Intentar de nuevo</p>');
} else {

	
	echo ('<div style="position: fixed; bottom: 0px; left: 0px; width: 100%; height:6%; background-color: rgb(00,40,34); text-align: center; vertical-align: middle; line-height: 200%;">  Hora Local / Local Time : '.date("H:i").' &nbsp; </div>');
	echo '<table border="0" cellpadding="1" cellspacing="2" width="100%">';
	echo '<tr>';
	echo '<td style=text-align:center;>Salidas  /  Departures</td>';
	echo '</tr>';
	echo '</table>';




	echo '<table border="0" cellpadding="2" cellspacing="10" width="100%">';

	echo '<colgroup>
    <col style="width:15%">
    <col style="width:10%">
    <col style="width:5%">
    <col style="width:15%">
    <col style="width:15%">
    <col style="width:10%">
    <col style="width:15%">
 	 </colgroup> ';

	echo '<tr>';
	echo '<td></td>';	
	echo '<td>Aerolinea<br>Airline</br></td>';		
	echo '<td>Vuelo<br>Flight</br> </td>';
	echo '<td>Destino<br>Destination</br></td>';
	echo '<td>Hora de Salida<br>Departure Time</br></td>';

	if ($type=='c') {
		echo '<td>Check In</td>';
	}

	else {
		echo '<td>Puerta<br>Gate</br></td>';
	}
	


	echo '<td>Estado <br>Status</br></td>';
	echo '</tr>';



	while (list($airlinecode,$flightno,$departs,$departstime,$airport,$registration,$slottime,$edt,$bay,$gate,$aircraft,$checkin,$status)=mysqli_fetch_row($ttable)){
	


$airquery = "SELECT `airlinename` FROM `airlines` WHERE `airlinecode`='".$airlinecode."'";
if ($airresult = mysqli_query($conn, $airquery)) {
    while ($airrow = mysqli_fetch_row($airresult)) {
        $airlinename = $airrow[0];
    }

}


$destquery = "SELECT `airportname` FROM `airports` WHERE `airportcode` = '".$airport."'";
if ($destresult = mysqli_query($conn, $destquery)) {
    while ($destrow = mysqli_fetch_row($destresult)) {
        $destinationname = $destrow[0];
    }

}



	$timescheduled = date('H:i', strtotime($departstime));
	$timeactual = date('H:i', strtotime($edt));

	echo '<tr>';

    
    if (file_exists('airlinelogos/'.$airlinecode.'.png')) {
    echo '<td><img src="airlinelogos/'.$airlinecode.'.png" style="width:200px;height:60px" ></td>';	
	} 

	else {
    echo '<td><img src="airlinelogos/default.png" style="width:200px;height:60px" ></td>';	
	}	
		

	echo '<td>'.$airlinename.'</td>';
	echo '<td>'.$airlinecode.$flightno.'</td>';
	echo '<td>'.$destinationname.'</td>';

	if ($timescheduled==$timeactual) {
		echo '<td>'.$timescheduled.'</td>';
		$delay = '0';
	}

	else{
		echo '<td><old style="color:grey;">'.$timescheduled.'</old><br><delay style="color:red;">'.$timeactual.'</delay></td>';
		$delay = '1';
	}




	if ($type=='c') {
		echo '<td>'.$checkin.'</td>';
					}

	else {
		
			if ($gate=='0') {
			echo '<td></td>';
			}

			else {
			echo '<td>'.$gate.'</td>';
			}

		}



	if ($status=='Embarcando') {
		echo '<td><boarding style="color:rgb(0,226,85);">'.$status.'</boarding></td>';
	}

	elseif ($status=='Ultimo Llamado/Final Call') {
		echo '<td><delay style="color:red;">'.$status.'</delay></td>';
	}

	elseif ($status=='Salió/Departed') {
		echo '<td><delay style="color:red;">'.$status.'</delay></td>';
	}

	elseif ($status=='Cancelado/Canceled') {
		echo '<td><delay style="color:red;">'.$status.'</delay></td>';
	}

	elseif ($status=='Cerrado/Closed') {
		echo '<td><delay style="color:red;">'.$status.'</delay></td>';
	}


	elseif ($delay=='1') {
		echo '<td><delay style="color:red;">'.$status.'</delay></td>';
	}


	else {
		echo '<td>'.$status.'</td>';
	}
	

	echo '</tr>';



}}


echo '</table>';


echo ('</body>');
echo ('</html>');





?>
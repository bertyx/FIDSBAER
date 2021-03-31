<?php

	require ('connect.php');	
	require ('settings.php');	


echo ('<!DOCTYPE html>');
echo ('<html>');
echo ('<head>');
echo ('<link rel="stylesheet" type="text/css" href="staff.css">');
echo ('<meta name="google" value="notranslate">');
echo ('</head>');
echo ('<body>');


	echo ('<div style="text-align: left; position:fixed;  ">Añadir Nuevo Vuelo  -  LLEGADAS</div><div style="text-align: right;  ">Ultima Actualización : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';


	echo '<tr>';
	echo '<td>Aerolinea</td>';		
	echo '<td>Numero de Vuelo</td>';
	echo '<td>Desde</td>';
	echo '<td>Fecha Programada</td>';
	echo '<td>Hora Programada</td>';
	echo '<td>Slot</td>';
	echo '<td>ETA</td>';
	echo '<td>Rego</td>';
	echo '<td>Bay</td>';
	echo '<td>Puerta</td>';
	echo '<td>A/C</td>';
	echo '<td>Carrusel</td>';
	echo '<td>Status</td>';
	echo '<td>Tipo</td>';
	echo '<td>Mensaje al AVSEC</td>';
	echo '</tr>';


	echo '<tr>';


echo ('<form name="newarrival" method="post" action="arradmin.php">');


echo ('<td><select name="airlinecode" size="10" required>');


$aquery = 'SELECT * FROM `airlines`';
$atable = mysqli_query($conn, $aquery);

while (list($airlinecode,$airlinename)=mysqli_fetch_row($atable)){

echo ('<option value="'.$airlinecode.'">'.$airlinename.'</option>');	

}

echo ('</select></td>');


echo '<td><input type="number" id="flightno" name="flightno" min="1" max="9999" value="" required></td>';


echo ('<td><select name="airportcode" size="10" required>');


$aquery = 'SELECT * FROM `airports`';
$atable = mysqli_query($conn, $aquery);

while (list($airportcode,$airportname)=mysqli_fetch_row($atable)){

echo ('<option value="'.$airportcode.'">'.$airportname.'</option>');	

}

echo ('</select></td>');
$datenow = date("Y-m-d");

echo ('<td><input type="date" id="arrives" name="arrives" value="'.$datenow.'" required></td>');
echo ('<td><input type="time" id="arrivestime" name="arrivestime" value="" required></td>');
echo ('<td><input type="time" id="slottime" name="slottime" size="8" value="00:00"></td>');
echo ('<td><input type="time" id="eta" name="eta" size="8" value="00:00" required></td>');
echo ('<td><input type="text" id="registration" name="registraion" size="7" value="Vacío"></td>');
echo ('<td><input type="text" id="bay" name="bay" size="4" value="Vacío"></td>');
echo ('<td><input type="text" id="gate" name="gate" size="4" value="Vacío"></td>');
echo ('<td><input type="text" id="aircraft" name="aircraft" size="6" value=""></td>');
echo ('<td><input type="text" id="belt" name="belt" size="5" value=""></td>');
echo ('<td><input type="text" id="status" name="status" size="15" value=""></td>');


	echo ('<td><select name="type" required>');
	echo ('<option value="d">NAC</option>');	
	echo ('<option value="i">INTERNACIONAL</option>');	
	echo ('<option value="o">OTRO</option>');	

echo ('<td><input type="text" id="staffmsg" name="staffmsg" size="10" value=""></td>');


echo '</table>';


echo ('<input type="submit" value="Añadir Nuevo Vuelo" name="newarrival">');


echo '</form>';
echo ('<a href="arradmin.php"><button>Adminstrar pantallas de vuelo</button></a>');





echo ('</body>');
echo('</html>');



?>
<?php

	$type = $_GET['type']; 	
	$delete = $_GET['delete'];	
	require ('connect.php');		
	require ('settings.php');	


if (isset($_POST['deleteairline'])){

$airlinecode= $_GET['delete'];


$removesql = "DELETE FROM `fids`.`airlines` WHERE `airlines`.`airlinecode` = '".$airlinecode."'";


if (mysqli_query($conn, $removesql)) {
		header("Location: airlines.php");

}

}


if (isset($_POST['updateairline'])){
$airlinecode= $_POST['airlinecode'];
$airlinename= $_POST['airlinename'];


$updatesql = "UPDATE `fids`.`airlines` SET `airlinename` = '".$airlinename."' WHERE `airlines`.`airlinecode` = '".$airlinecode."';";


if (mysqli_query($conn, $updatesql)) {
echo ('');
}

}


if (isset($_POST['newairline'])){

$airlinecode= $_POST['airlinecode'];
$airlinename= $_POST['airlinename'];

$upairlinecode = strtoupper ($airlinecode);


$newsql = "INSERT INTO `fids`.`airlines` (`airlinecode`, `airlinename`) VALUES ('".$upairlinecode."', '".$airlinename."');";


if (mysqli_query($conn, $newsql)) {
echo ('');
}

}




echo ('<!DOCTYPE html>');
echo ('<html>');
echo ('<head>');
echo ('<link rel="stylesheet" type="text/css" href="staff.css">');
echo ('<meta name="google" value="notranslate">');
echo ('</head>');
echo ('<body>');



$tquery = 'SELECT * FROM `airlines` ORDER BY `airlinecode`';


$ttable = mysqli_query($conn, $tquery);


if(!$ttable){

	echo('<p>Oops, Hay un problema, intenta nuevamente</p>');
} else {

		
	echo ('<div style="text-align: left; position:fixed;  ">Aerolineas - Modo Administrador</div><div style="text-align: right;  ">Ultima Actualizacion : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';


	echo '<tr>';
	echo '<td>Código de la Aerolinea</td>';		
	echo '<td>Nombre de la Aerolinea</td>';
	echo '<td>Imagen de la Aerolinea</td>';
	echo '<td><a href="index.html"><button>Página Principal</button></a></td>';

	echo '</tr>';


	echo '<tr>';
	echo ('<form name="newairline" method="post" action="airlines.php">');	
	echo '<td><input type="text" id="airlinecode" name="airlinecode"  size="3" maxlength="3" value="" ></td>';
	echo '<td><input type="text" id="airlinename" name="airlinename"  size="25" value="" ></td>';
	echo '<td><input type="submit" value="Añadir Aerolinea" name="newairline"></td>';
	echo ('</form>');
	echo '</tr>';





	while (list($airlinecode,$airlinename)=mysqli_fetch_row($ttable)){
	

	$airlinenow = $airlinecode;

	echo '<tr>';
	echo ('<form name="updateairline" method="post" action="airlines.php">');	
	echo '<td>'.$airlinecode.'</td>';
	echo '<td><input type="text" id="airlinename" name="airlinename"  size="25" value="'.$airlinename.'" >';


	
	echo ('<input type="text" id="airlinecode" name="airlinecode" value="'.$airlinecode.'" hidden>');
	echo ' <input type="submit" value="Actualizar nombre de Aerolinea" name="updateairline"></td>';
	echo ('</form>');


	echo ('<form name="deleteairline" method="post" action="airlines.php?delete='.$airlinecode.'">');
	echo ('<input type="text" id="airlinecode" name="airlinecode" value="'.$airlinenow.'" hidden>');
	echo '<td><input type="submit" value="Borrar Aerolinea" name="deleteairline"></td>';


	echo '</tr>';
	

	echo '<tr>';
	echo '</tr>';


}}


echo '</table>';


echo ('</body>');
echo ('</html>');





?>
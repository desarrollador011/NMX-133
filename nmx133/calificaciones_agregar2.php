<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	$d =$_POST['d'];

	$sql ="INSERT INTO TS_Calificacion(Des,FC)";
	$sql.="VALUES('$d',now());";
	$rs=mysql_query($sql,$link) or die("Error: <b>$sql</b>");

	mysql_close ($link);
	header("Location:calificaciones.php");
?>

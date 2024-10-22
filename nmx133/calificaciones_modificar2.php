<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$id=$_POST['id'];
	$d =$_POST['d'];


	$sql ="UPDATE TS_Calificacion SET ";
	$sql.="Des='$d',FM=now() ";
	$sql.=" WHERE CalificaId=$id ";
	$rs = mysql_query($sql,$link) or die("Error : <b>$sql</b>");

	mysql_close ($link);
	header("Location:calificaciones.php");
?>
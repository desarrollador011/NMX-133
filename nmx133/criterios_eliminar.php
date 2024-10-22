<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$id=$_GET['id'];
	$ni=$_GET['n'];
	$pa=$_GET['p'];

	$sql="DELETE FROM TS_Preguntas WHERE Numeral='$id' ";
	$rsl = mysql_query($sql,$link) or die("Error : <b>$sql</b>");
	mysql_close ($link);

	header("Location:criterios.php?n=$ni&p=$pa");
?>
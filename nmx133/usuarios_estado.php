<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	$idu=$_GET['idu'];
	$es=(($_GET['est']==0)?1:0);

	$sql ="UPDATE iusuario SET est=$es WHERE idu=$idu";
	$rsl=mysql_query($sql, $link) or die("Error : <b>$sql</b>");

	mysql_close ($link);
	header("Location:usuarios.php");
?>
<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	$id=$_GET['id'];
	$es=(($_GET['est']==0)?1:0);

	$sql ="UPDATE TS_Admin SET Est=$es WHERE AdminId=$id";
	$rsl=mysql_query($sql, $link) or die("Error : <b>$sql</b>");

	mysql_close ($link);
	header("Location:evaluadores.php");
?>
<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	if(trim($_POST['c'])<>''){
		$c=md5(trim($_POST['c']));
		$sql ="UPDATE iusuario SET cla='$c' WHERE idu=$usu_idu";
		$rs = mysql_query($sql,$link) or die("Error : <b>$sql</b>");
	}
	mysql_close ($link);
	header("Location:home.php");
?>
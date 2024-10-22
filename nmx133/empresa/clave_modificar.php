<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	if(trim($_POST['c'])<>''){
		$c=md5(trim($_POST['c']));
		$sql ="UPDATE TS_Empresas SET Psw='$c' WHERE Est=1 AND EmpresaId=$usu_idu";
		$rs = mysql_query($sql,$link) or die("Error : <b>$sql</b>");
	}
	mysql_close ($link);
	header("Location:index.php");
?>
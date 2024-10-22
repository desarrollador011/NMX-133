<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	$e=$_GET['e'];
	$p=$_GET['p'];

	$sql ="SELECT Doc FROM TS_EmpresaPreguntas WHERE EmpresaId=$e AND Numeral='$p' ";
	$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
	$DOC ="../nmx133/files/".mysql_result($rsl,0,"Doc");
	mysql_freeresult($rsl);

	if(file_exists("$DOC")){
		if(unlink("$DOC")){
			$sql ="UPDATE TS_EmpresaPreguntas SET ";
			$sql.="Doc='',FM=now() ";
			$sql.="WHERE EmpresaId=$e AND Numeral='$p' ";
			$rsl = mysql_query($sql,$link) or die("Error : <b>$sql</b>");

			$sql="UPDATE TS_Eventos SET Est=3,FM=now() WHERE EmpresaId=$e AND Numeral='$p' AND Est=0 ";
			$rsU = mysql_query($sql,$link) or die("Error 17 : $sql ");

		}else{
		//	echo "<font color='red'><b>".$DOC."</b>: Error! You may not have enough permission to delete this file.</font>";
		}
	}else{
		//echo "<font color='red'><b>".$DOC."</b>: Error! Could not delete file. File does not exist.</font>";
	}
	mysql_close ($link);

	header("Location:Anexar_modificar.php?id=$e");
?>

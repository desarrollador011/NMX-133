<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	$d=$_GET['id'];

	$sql ="SELECT Doc FROM TS_Documentos WHERE DocId=$d ";
	$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
	$DOC ="../nmx133/download/".mysql_result($rsl,0,"Doc");
	mysql_freeresult($rsl);

	if(file_exists("$DOC")){
		if(unlink("$DOC")){
		}else{
			//echo "<font color='red'><b>".$DOC."</b>: Error! You may not have enough permission to delete this file.</font>";
		}
	}else{
		//echo "<font color='red'><b>".$DOC."</b>: Error! Could not delete file. File does not exist.</font>";
	}
	$sql="DELETE FROM TS_Documentos WHERE DocId=$d ";
	$rsl = mysql_query($sql,$link) or die("Error : <b>$sql</b>");

	mysql_close ($link);
	header("Location:Ayuda.php");
?>
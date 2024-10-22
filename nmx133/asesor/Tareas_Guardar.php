<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$TID=$_POST['idt'];
	$rsp=trim($_POST['resp']);

	$sql ="UPDATE TS_Tareas SET ";
	$sql.="Est=1,Respuesta='$rsp',FM=now() ";
	$sql.="WHERE Tipo=1 AND Est=0 AND TareaId=$TID ";
	$rsU = mysql_query($sql,$link) or die("Error : <b>$sql</b>");

	mysql_close ($link);
	header("Location:Tareas.php");
?>
<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$ase=$_POST['eval'];
	$emp=$_POST['emp'];
	$p="";
	$cal=0;
	$tx1=trim($_POST['txt1']);
	$tx2=trim($_POST['txt2']);
	$tx3=trim($_POST['txt3']);
	$tx4=trim($_POST['txt4']);
	$res=$_POST['res'];

	$sql ="INSERT INTO TS_Tareas(AdminId,Tipo,EmpresaId,AsesorId,Numeral,";
	$sql.="Comentario,ActividEntreg,QueNecesito,CuanEntrega,Responsable,Est,FC,Respuesta)";
	$sql.="VALUES($usu_idu,1,$emp,$ase,'$p',";
	$sql.="'$tx1','$tx2','$tx3','$tx4',$res,0,now(),'');";
	$rsl =mysql_query($sql,$link) or die("Error 35 : <b>$sql</b>");	

	mysql_close ($link);

	header("Location:Tareas.php");
?>
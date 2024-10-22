<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	$emp=$_POST['emp'];
	$chx=$_POST['pre'];

	$sqD="UPDATE TS_EmpresaPreguntas SET Est=0 WHERE EmpresaId=$emp AND Cerrado=0 ";
	$rsD= mysql_query($sqD,$link) or die("Error 9 : $sqD ");

	while( list($key,$pre)=@each($chx) ){

		$sql ="SELECT * FROM TS_EmpresaPreguntas WHERE EmpresaId=$emp AND Numeral='$pre' ";
		$rsl =mysql_query($sql,$link) or die("Error 14 : <b>$sql</b>");
		$ttr =mysql_num_rows($rsl);
		mysql_freeresult($rsl);
		if($ttr>0){
			$sqD="UPDATE TS_EmpresaPreguntas SET Est=1 WHERE EmpresaId=$emp AND Numeral='$pre' AND Cerrado=0  ";
			$rsD= mysql_query($sqD,$link) or die("Error 19 : $sql ");
		}else{
			$sqI ="INSERT INTO TS_EmpresaPreguntas(EmpresaId,Numeral,Doc,CalificaId,Est,Comentario,";
			$sqI.="ActividEntreg,QueNecesito,CuanEntrega,Responsable,FC)";
			$sqI.="VALUES($emp,'$pre','',0,1,'','','','','',now());";
			$rsI =mysql_query($sqI,$link) or die("Error 24 : $sqI ");
		}
	}

	$sqD="DELETE FROM TS_EmpresaPreguntas WHERE EmpresaId=$emp AND Est=0 AND Cerrado=0 ";
	$rsD=mysql_query($sqD,$link) or die("Error 29 : $sqD ");

	mysql_close ($link);

	header("Location:balotario.php");
?>
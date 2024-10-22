<?	session_start(); 
	include("conexion.php");
	$link = Conectarse();

	$IDP =$_POST['PREG'];
	$_SESSION['cmp1']=trim($_POST['txt1']);
	$_SESSION['cmp2']=trim($_POST['txt2']);
	$_SESSION['cmp3']=trim($_POST['inp1']);
	$_SESSION['cmp4']=trim($_POST['inp2']);
	$_SESSION['cmp5']=trim($_POST['inp3']);
	$_SESSION['cmp6']=trim($_POST['inp4']);
	$_SESSION['cmp7']=trim($_POST['inp5']);	

	if($_POST['captcha'] == $_SESSION['cap_code']) { 
		$IP  =$_SERVER["REMOTE_ADDR"];
		$tx1=$_SESSION['cmp1'];
		$tx2=$_SESSION['cmp2'];
		$in1=$_SESSION['cmp3'];
		$in2=$_SESSION['cmp4'];
		$in3=$_SESSION['cmp5'];
		$in4=$_SESSION['cmp6'];
		$in5=$_SESSION['cmp7'];
		$sql ="SELECT Des FROM TS_Preguntas2 WHERE IdN=$IDP ";
		$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$PDES=mysql_result($rsl,0,"Des");
		mysql_freeresult($rsl);

		$sql ="INSERT INTO TS_Comentarios(IdN,Des,";
		$sql.="Debe,Just,Nom,Ape,Ema,Tlf,Rso,FC,FM,IP)";
		$sql.="VALUES($IDP,'$PDES',";
		$sql.="'$tx1','$tx2','$in1','$in2','$in3','$in4','$in5',now(),now(),'$IP');";
		$rsl =mysql_query($sql,$link) or die("Error 24 : <b>$sql</b>");	

		$resultado=1000;
	}else{
		$resultado=999;
	}

	mysql_close ($link);
	header("Location:NuevosCriterios.php?s=$resultado");
?>
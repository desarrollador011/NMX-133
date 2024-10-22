<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	$n=trim($_POST['nom']);
	$u=trim($_POST['usu']);
	$c=trim($_POST['pss']);
	$c=md5($c);
	$i=trim($_POST['ema']);
	$Dir=trim($_POST['dir']);
	$Tel=trim($_POST['tel']);
	$Cel=trim($_POST['cel']);
	$Sky=trim($_POST['sky']);

	$sql ="INSERT INTO TS_Admin(Nom,Usu,Psw,Ema,Prf,Lmt,Est,FC,Dir,Tel,Cel,Sky)";
	$sql.="VALUES('$n','$u','$c','$i',0,0,1,now(),'$Dir','$Tel','$Cel','$Sky');";
	$rs=mysql_query($sql,$link) or die("Error: <b>$sql</b>");

	mysql_close ($link);
	header("Location:evaluadores.php");
?>

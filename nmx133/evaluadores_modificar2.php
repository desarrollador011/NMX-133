<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$id=$_POST['id'];
	$n=trim($_POST['nom']);
	$u=trim($_POST['usu']);
	$c1=trim($_POST['pss']);
	$i=trim($_POST['ema']);
	$Dir=trim($_POST['dir']);
	$Tel=trim($_POST['tel']);
	$Cel=trim($_POST['cel']);
	$Sky=trim($_POST['sky']);

	$sql ="UPDATE TS_Admin SET ";
	$sql.="Usu='$u',Nom='$n',";
	if($c1<>''){
		$c=md5($c1);
		$sql.="Psw='$c',";
	}
	$sql.="Ema='$i',Dir='$Dir',Tel='$Tel',Cel='$Cel',Sky='$Sky',FM=now() ";
	$sql.=" WHERE AdminId=$id";
	$rs = mysql_query($sql,$link) or die("Error : <b>$sql</b>");

	mysql_close ($link);
	header("Location:evaluadores.php");
?>
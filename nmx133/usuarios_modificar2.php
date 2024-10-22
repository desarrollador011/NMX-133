<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$idx=$_POST['uid'];
	$p=$_POST['prf'];
	$n=trim($_POST['nom']);
	$a=trim($_POST['ape']);
	$c1=trim($_POST['pss']);
	$r=trim($_POST['emp']);
	$i=trim($_POST['ema']);
	$g=trim($_POST['car']);
	$t=trim($_POST['tel']);
	$x=((isset($_POST['noti']))?1:0);

	$sql ="UPDATE iusuario SET ";
	$sql.="nom='$n',ape='$a',";
	if($c1<>''){
		$c=md5($c1);
		$sql.="cla='$c',";
	}
	$sql.="prf=$p,emp='$r',ema='$i',car='$g',tel='$t',notificar=$x ";
	$sql.="WHERE idu=$idx";

	$rs = mysql_query($sql,$link) or die("Error : <b>$sql</b>");
	mysql_close ($link);

	header("Location:usuarios.php");
?>
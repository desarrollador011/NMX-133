<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	$p=$_POST['prf'];
	$n=trim($_POST['nom']);
	$a=trim($_POST['ape']);
	$u=trim($_POST['usu']);
	$c=trim($_POST['pss']);
	$c=md5($c);
	$r=trim($_POST['emp']);
	$i=trim($_POST['ema']);
	$g=trim($_POST['car']);
	$f=trim($_POST['tel']);
	$x=((isset($_POST['noti']))?1:0);

	$sql ="INSERT INTO iusuario(usu,cla,nom,ape,prf,emp,ema,car,tel,fch,est,notificar)";
	$sql.="VALUES('$u','$c','$n','$a',$p,'$r','$i','$g','$f',now(),0,$x);";
	$rs=mysql_query($sql,$link) or die("Error: <b>$sql</b>");

	mysql_close ($link);
	header("Location:usuarios.php");
?>

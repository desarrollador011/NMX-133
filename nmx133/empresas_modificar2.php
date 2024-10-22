<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$img="";
	if( isset($_FILES['img']) ){
		$imgtmp = $_FILES['img']['name']; 
		$Orig = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ",",","$","?","!","#","@","^","(",")","{","}","[","]","'",">");
		$Reem = array("a","e","i","o","u","A","E","I","O","U","n","N","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_");
		$imgtmp = str_replace($Orig,$Reem,$imgtmp);
	    if (move_uploaded_file($_FILES['img']['tmp_name'],"/home/daimex/public_html/nmx133/empresaimg/".$imgtmp)){
			$img=$imgtmp;
		}
	}
	$id=$_POST['id'];
	$ev=$_POST['eval'];
	$no=trim($_POST['nom']);
	$us=trim($_POST['usu']);
	$cl=trim($_POST['pss']);
	$em=trim($_POST['ema']);
	$es=trim($_POST['ubi1']);
	$mu=trim($_POST['ubi2']);
	$lo=trim($_POST['ubi3']);
	$si=trim($_POST['sit']);

	$sql ="UPDATE TS_Empresas SET ";
	$sql.="AdminId=$ev,Usu='$us',Nom='$no',";
	if($cl<>''){
		$c=md5($cl);
		$sql.="Psw='$c',";
	}
	if($img<>''){
		$sql.="Img='$img',";
	}
	$sql.="Ubg1='$es', ";
	$sql.="Ubg2='$mu', ";
	$sql.="Ubg3='$lo', ";
	$sql.="Ema='$em',Site='$si',FM=now() ";
	$sql.="WHERE EmpresaId=$id";

	$rs = mysql_query($sql,$link) or die("Error : <b>$sql</b>");

	mysql_close ($link);

	header("Location:empresas.php");
?>
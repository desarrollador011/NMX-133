<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	$ni=$_POST['niv'];
	$pa=$_POST['pad'];

	$nu=trim($_POST['num']);
	$pr=trim($_POST['cri']);
	$ay=trim($_POST['ayu']);
	$pu=((trim($_POST['pun'])=='')?0:trim($_POST['pun']));

	$sql ="INSERT INTO TS_Preguntas(Numeral,Nivel,Des,Puntaje,Ayuda)";
	$sql.="VALUES('$nu',$ni,'$pr',$pu,'$ay');";
	$rs=mysql_query($sql,$link) or die("Error: <b>$sql</b>");

	mysql_close ($link);

	header("Location:criterios.php?n=$ni&p=$pa");
?>
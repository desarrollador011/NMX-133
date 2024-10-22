<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$id=$_POST['idp'];
	$ni=$_POST['niv'];
	$pa=$_POST['pad'];
	$nu=trim($_POST['num']);
	$pr=trim($_POST['cri']);
	$ay=trim($_POST['ayu']);
	$pu=((trim($_POST['pun'])=='')?0:trim($_POST['pun']));

	$sql ="UPDATE TS_Preguntas SET ";
	$sql.="Numeral='$nu',Des='$pr',Ayuda='$ay',Puntaje=$pu ";
	$sql.="WHERE Numeral='$id' ";

	$rsl = mysql_query($sql,$link) or die("Error : <b>$sql</b>");

	mysql_close ($link);

	header("Location:criterios.php?n=$ni&p=$pa");
?>
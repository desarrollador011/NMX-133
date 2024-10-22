<?	include "conexion.php";
	$link = Conectarse();

	$id=$_GET['id'];

	$sq3 ="SELECT E.EmpresaId ID,E.Nom N ";
	$sq3.="FROM TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId ";
	$sq3.="WHERE A.AdminId=$id ";
	$sq3.="ORDER BY E.Nom ";
	$rsl=mysql_query($sq3, $link) or die("Error: <b>$sq3</b>");

	header('Content-Type: text/xml');
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	echo "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?>\n";
	echo "<modelos>\n";
	while($row=mysql_fetch_object($rsl)){
		echo "<modelo>";
		echo "<codigo>".$row->ID."</codigo>";
		echo "<nombre>".$row->N."</nombre>";
		echo "</modelo>\n";
	}
	echo "</modelos>";

	mysql_free_result($rsl);
	mysql_close ($link);
?>
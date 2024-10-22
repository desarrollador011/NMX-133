<?	include "mb_session.php";
	include("conexion.php");
	$link=Conectarse();

	if(isset($_FILES['doc'])){
		$d=$_POST['des'];
		$nom_art = $_FILES['doc']['name'];
		$Orig = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ",",","$","?","!","#","@","^","(",")","{","}","[","]","'",">");
		$Reem = array("a","e","i","o","u","A","E","I","O","U","n","N","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_");
		$nom_ar = str_replace($Orig,$Reem,$nom_art);
	    if (move_uploaded_file($_FILES['doc']['tmp_name'],"/home/daimex/public_html/nmx133/download/".$nom_ar)){
			$sql ="INSERT INTO TS_Documentos(Des,Doc,Est,Obs,FC)";
			$sql.="VALUES('$d','$nom_ar',1,'',now());";
			$rsl =mysql_query($sql,$link) or die("Error 14 : <b>$sql</b>");
	    } 
	}

	mysql_close ($link);

	header("Location:Ayuda.php");
?>
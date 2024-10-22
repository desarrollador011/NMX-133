<?	include "conexion.php";
	$link = Conectarse();
	$dir="/home/daimex/public_html/nmx133/download/";
	$up=0;
	$url="importar.php";
	if(isset($_FILES['fil'])){
		$doc=$_FILES['fil']['name']; 
	    if(move_uploaded_file($_FILES['fil']['tmp_name'],$dir.$doc)){
		 	$up=1;
			$url="importar_exitoso.php";
	    }
	}
	if($up==1){
		$filas=file("download/".$doc); 
		$i=0; // La Fila 1 es la cabecera
		$i=0; // Inicio de la Fila 1
		while($filas[$i]!=NULL){
			$fila = $filas[$i]; 
			$data = explode("|",$fila); //Separado por |, Aqui se cambia el tipo de separador
			$i++;
			$c1	=trim($data[0]);
			$c2	=trim($data[1]);

			$sql ="INSERT INTO TS_Preguntas2 (Numeral,Des)";
			$sql.="VALUES('$c1','$c2');";
			$rsl =mysql_query($sql,$link) or die("Error: <b>$sql</b>");
		}
	}
	mysql_close ($link);
	header("Location:".$url);
?>
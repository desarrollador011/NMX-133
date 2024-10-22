<?	include("conexion.php");
	$link = Conectarse();

	$p=trim($_POST['num']);
	$e=$_POST['e'];
	if($p<>"" AND isset($_FILES['nom'])){
		$nom_art = $_FILES['nom']['name'];
		$Orig = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ",",","$","?","!","#","@","^","(",")","{","}","[","]","'",">");
		$Reem = array("a","e","i","o","u","A","E","I","O","U","n","N","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_");
		$nom_ar = str_replace($Orig,$Reem,$nom_art);

	    if (move_uploaded_file($_FILES['nom']['tmp_name'],"/home/daimex/public_html/nmx133/files/".$nom_ar)){

			$sql ="SELECT AdminId,Nom FROM TS_Empresas WHERE EmpresaId=$e";
			$rsl =mysql_query($sql,$link) or die("Error 41 : <b>$sql</b>");
			$AS =mysql_result($rsl,0,"AdminId");
			$EMP =mysql_result($rsl,0,"Nom");
			mysql_freeresult($rsl);

			$sql="UPDATE TS_EmpresaPreguntas SET Doc='$nom_ar',CalificaId=1 WHERE EmpresaId=$e AND Numeral='$p' ";
			$rsl = mysql_query($sql,$link) or die("Error 15 : $sql ");

			$sql="UPDATE TS_Eventos SET Est=2,FM=now() WHERE EmpresaId=$e AND Numeral='$p' AND Est=0 ";
			$rsU = mysql_query($sql,$link) or die("Error 18 : $sql ");

			$sql ="UPDATE TS_Tareas SET Est=1,FM=now() ";
			$sql.="WHERE Tipo=0 AND Numeral='$p' AND Est=0 AND AsesorId=$AS ";//Responsable=1 AND 
			$rsU = mysql_query($sql,$link) or die("Error 18 : $sql ");

			$sql ="INSERT INTO TS_Eventos(AdminId,AsesorId,EmpresaId,Numeral,FC,Est)";
			$sql.="VALUES(0,$AS,$e,'$p',now(),0);";
			$rsl =mysql_query($sql,$link) or die("Error 22 : <b>$sql</b>");

			$sq3 ="SELECT ema FROM iusuario WHERE prf=1 AND est=1 AND notificar=1 AND ema<>'' ";
			$rs3 =mysql_query($sq3,$link) or die("Error 25 : <b>$sq3</b>");
			$z=0;
			$ema="";
			while($row=mysql_fetch_object($rs3)){
				$tmp=trim($row->ema);
				if($tmp<>""){
					if($z>0){
						$ema.=" , ";
					}
					$ema.=$tmp;
					$z++;
				}
			}
			mysql_free_result($rs3);
			if($z>0){
	
				$sql="SELECT Nom FROM TS_Admin WHERE AdminId=$AS";
				$rsl=mysql_query($sql,$link) or die("Error 47 : <b>$sql</b>");
				$ASE=mysql_result($rsl,0,"Nom");
				mysql_freeresult($rsl);
	
			    $cuerpo  = "Asesor : " . $ASE . "\n"; 
			    $cuerpo .= "Empresa : " . $EMP . "\n"; 
			    //$cuerpo .= "Email : " . $ema . "\n"; 
			    $cuerpo .= "Disposicion : " .$p . "\n";
			    $cuerpo .= "Fecha y Hora : " . date('d-m-Y H:i') . "\n";
			
				$headers.="From: notificador@daimexico.com\r\n";
				$destino = $ema;
				$asunto  ="NUEVA DISPOSICION CON ADJUNTO";
			
			    mail($destino,$asunto,$cuerpo,$headers);
			}
	    }
	}
	mysql_close ($link);

	header("Location:Anexar_modificar.php?id=$e");
?>
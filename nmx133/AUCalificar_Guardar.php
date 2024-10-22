<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$n=$_POST['NUM'];
	$e=$_POST['EMP'];
	$p=$_POST['PREG'];
	$c=$_POST['cal'];
	$tx1=trim($_POST['txt1']);

	$sq0 ="SELECT * FROM TS_EmpresaPreguntas WHERE EmpresaId=$e AND Numeral='$p' AND Cerrado=0 ";
	$rs0 =mysql_query($sq0,$link) or die("Error 12 : <b>$sq0</b>");
	$ttr =mysql_num_rows($rs0);
	mysql_free_result($rs0);

	if($ttr>0){
		$sql="UPDATE TS_Eventos SET Est=1,FM=now() WHERE EmpresaId=$e AND Numeral='$p' AND Est=0 ";
		$rsU = mysql_query($sql,$link) or die("Error 12 : $sql ");
	
		if($c==2){
			$sql ="UPDATE TS_EmpresaPreguntas SET ";
			$sql.="Cerrado=1,FM=now() ";
			$sql.="WHERE EmpresaId=$e AND Numeral='$p' AND Cerrado=0 ";
			$rsU = mysql_query($sql,$link) or die("Error 18 : <b>$sql</b>");
		}else{
			$sql ="UPDATE TS_EmpresaPreguntas SET ";
			$sql.="CalificaId=$c,FM=now() ";
			$sql.="WHERE EmpresaId=$e AND Numeral='$p' AND Cerrado=0 ";
			$rsU = mysql_query($sql,$link) or die("Error 23 : <b>$sql</b>");
	
			$sq3 ="SELECT ema FROM iusuario WHERE prf=1 AND est=1 AND notificar=1 AND ema<>'' ";
			$rs3 =mysql_query($sq3,$link) or die("Error 26 : <b>$sq3</b>");
			$z=0;
			$ADMEMA="";
			while($row=mysql_fetch_object($rs3)){
				$tmp=trim($row->ema);
				if($tmp<>""){
					if($z>0){
						$ADMEMA.=" , ";
					}
					$ADMEMA.=$tmp;
					$z++;
				}
			}
			mysql_free_result($rs3);
			if($z>0){
				$sql ="SELECT AdminId,Nom,Ema FROM TS_Empresas WHERE EmpresaId=$e";
				$rsl =mysql_query($sql,$link) or die("Error 42 : <b>$sql</b>");
				$AS =mysql_result($rsl,0,"AdminId");
				$EMP =mysql_result($rsl,0,"Nom");
				$EMPEMA =mysql_result($rsl,0,"Ema");
				mysql_freeresult($rsl);
	
				$sql="SELECT Nom FROM TS_Admin WHERE AdminId=$AS";
				$rsl=mysql_query($sql,$link) or die("Error 49 : <b>$sql</b>");
				$ASE=mysql_result($rsl,0,"Nom");
				mysql_freeresult($rsl);
	
			    $cuerpo  = "Asesor : " . $ASE . "\n"; 
			    $cuerpo .= "Empresa : " . $EMP . "\n"; 
			    $cuerpo .= "Pregunta : " .$p . "\n";
			    $cuerpo .= "Mensaje : " . $tx1 . "\n"; 
			    $cuerpo .= "Fecha y Hora : " . date('d-m-Y H:i') . "\n";
			
				$headers.="From: notificador@daimexico.com\r\n";
				if(trim($EMPEMA)<>""){
					$headers.="Cc: ".$EMPEMA." \r\n";
				}
				$destino = $ADMEMA;
				$asunto  ="NUEVA OBSERVACION DE AUDITOR";
			    mail($destino,$asunto,$cuerpo,$headers);
			}
		}
	}

	mysql_close ($link);

	header("Location:AUCalificar.php?e=$e&n=$n");
?>
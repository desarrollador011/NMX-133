<?	include "mb_session.php";
	include("conexion.php");
	$link = Conectarse();

	$e=$_POST['EMP'];
	$p=$_POST['PREG'];
	$cal=$_POST['cal'];
	$tx1=trim($_POST['txt1']);
	$tx2=trim($_POST['txt2']);
	$tx3=trim($_POST['txt3']);
	$tx4=trim($_POST['txt4']);
	$res=$_POST['res'];
	if($cal<>1){
		$sql ="UPDATE TS_EmpresaPreguntas SET ";
		$sql.="Est=0,CalificaId=$cal,Comentario='$tx1',ActividEntreg='$tx2', ";
		$sql.="QueNecesito='$tx3',CuanEntrega='$tx4',Responsable='$tx5',FM=now() ";
		$sql.="WHERE EmpresaId=$e AND Numeral='$p' ";
		$rsU = mysql_query($sql,$link) or die("Error 18 : <b>$sql</b>");
	
		$sql="UPDATE TS_Eventos SET AdminId=$usu_idu,Est=1,FM=now() WHERE EmpresaId=$e AND Numeral='$p' AND Est=0 ";
		$rsU = mysql_query($sql,$link) or die("Error 17 : $sql ");

		// Email para Asesor o Empresa
		if($cal==3 OR $cal==4){ // 3:Oportunidad de mejora | 4:Inadecuado
			$as=0;
			if($res==1){ // Asesor
				$sql ="SELECT AdminId,Nom,Ema FROM TS_Empresas WHERE EmpresaId=$e";
				$rsl=mysql_query($sql,$link) or die("Error 27 : <b>$sql</b>");
				$as =mysql_result($rsl,0,"AdminId");
				$EmpNom =mysql_result($rsl,0,"Nom");
				mysql_freeresult($rsl);

				$sql="SELECT Nom,Ema FROM TS_Admin WHERE AdminId=$as";
				$rsl=mysql_query($sql,$link) or die("Error 47 : <b>$sql</b>");
				$AseNom =mysql_result($rsl,0,"Nom");
				$destino=mysql_result($rsl,0,"Ema");
				mysql_freeresult($rsl);
	
			    $cuerpo  = "Asesor : " . $AseNom . "\n"; 
			    $cuerpo .= "Empresa : " . $EmpNom . "\n"; 
			    $cuerpo .= "Disposicion : " .$p . "\n";
			    $cuerpo .= "Fecha y Hora : " . date('d-m-Y H:i') . "\n";

				$asunto  ="CDI - DISPOSICION A REVISAR POR ASESOR";
			}else{	// Empresa

				$sql ="SELECT Nom,Ema FROM TS_Empresas WHERE EmpresaId=$e";
				$rsl=mysql_query($sql,$link) or die("Error 27 : <b>$sql</b>");
				$EmpNom =mysql_result($rsl,0,"Nom");
				$destino=mysql_result($rsl,0,"Ema");
				mysql_freeresult($rsl);

			    $cuerpo  = "Empresa : " . $EmpNom . "\n"; 
			    $cuerpo .= "Disposicion : " .$p . "\n";
			    $cuerpo .= "Fecha y Hora : " . date('d-m-Y H:i') . "\n";

				$asunto  ="CDI - DISPOSICION A REVISAR POR EMPRESA";
			}
			$sql ="INSERT INTO TS_Tareas(AdminId,Tipo,EmpresaId,AsesorId,Numeral,";
			$sql.="Comentario,ActividEntreg,QueNecesito,CuanEntrega,Responsable,Est,FC,Respuesta)";
			$sql.="VALUES($usu_idu,0,$e,$as,'$p',";
			$sql.="'$tx1','$tx2','$tx3','$tx4',$res,0,now(),'');";
			$rsl =mysql_query($sql,$link) or die("Error 35 : <b>$sql</b>");

			$headers.="From: notificador@daimexico.com\r\n";

		    mail($destino,$asunto,$cuerpo,$headers);
		}
		// Email para Auditores
		if($cal==2){ // 2:Adecuado

			$sq3 ="SELECT ema FROM iusuario WHERE prf=0 AND est=1 AND ema<>'' ";
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
				$sql ="SELECT AdminId,Nom FROM TS_Empresas WHERE EmpresaId=$e";
				$rsl=mysql_query($sql,$link) or die("Error 27 : <b>$sql</b>");
				$AsId =mysql_result($rsl,0,"AdminId");
				$EmpNom =mysql_result($rsl,0,"Nom");
				mysql_freeresult($rsl);

				$sql="SELECT Nom FROM TS_Admin WHERE AdminId=$AsId";
				$rsl=mysql_query($sql,$link) or die("Error 47 : <b>$sql</b>");
				$AseNom =mysql_result($rsl,0,"Nom");
				mysql_freeresult($rsl);

			    $cuerpo  = "Asesor : " . $AseNom . "\n"; 
			    $cuerpo .= "Empresa : " . $EmpNom . "\n";
			    $cuerpo .= "Disposicion : " .$p . "\n";
			    $cuerpo .= "Fecha y Hora : " . date('d-m-Y H:i') . "\n";

				$headers.="From: notificador@daimexico.com\r\n";
				$destino = $ema;
				$asunto  ="NUEVA DISPOSICION EN ESTADO ADECUADO";

			    mail($destino,$asunto,$cuerpo,$headers);
			}
		}
	}
	mysql_close ($link);

	header("Location:Calificar_modificar.php?id=$e");
?>
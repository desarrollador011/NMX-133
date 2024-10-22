<?	include "mb_cab.php";
	$EMP = $usu_idu;
	$sql="SELECT * FROM TS_Admin WHERE AdminId=$EMP";
	$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
	$A_No=mysql_result($rsl,0,"Nom");
	$A_em=mysql_result($rsl,0,"Ema");
	$A_di=mysql_result($rsl,0,"Dir");
	$A_te=mysql_result($rsl,0,"Tel");
	$A_ce=mysql_result($rsl,0,"Cel");
	$A_sk=mysql_result($rsl,0,"Sky");
	mysql_freeresult($rsl);
?>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td valign="top" align="left">
				<table border="0" cellpadding="1" cellspacing="0">
				<tr><td><span class="EMP_PRE_Ase"><?=$A_No?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase">Asesor Local</span></td></tr>
				<tr><td><span class="EMP_PRE_Ase"><?=$A_di?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase">Tel: <?=$A_te?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase">Cel: <?=$A_ce?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase"><?=$A_em?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase">Skype: <?=$A_sk?></span></td></tr>
			    </table>
			</td>
			<td>
<?	$sq3 ="SELECT A.Nom EVA,E.EmpresaId ID,E.Nom N,E.Usu U,E.Ema EM,E.Est ES,E.Site SIT,DATE_format(E.FC,'%d-%m-%Y') as FCR ";
	$sq3.="FROM TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId ";
	$sq3.="WHERE E.AdminId=$usu_idu ";
	$sq3.="ORDER BY E.AdminId,E.Nom ";
	$rs3 =mysql_query($sq3,$link) or die("Error 16 : $sq3 ");
?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>EMPRESAS</h1></td></tr>
			<tr><td valign="top" align="center">
					<table border="0" cellpadding="3" cellspacing="1">
					<tr bgcolor="<?=CLR_CAB_DET?>">
						<td align="center" width="30" height="30"><font class="textcampo">#</td>
						<td align="center"><font class="textcampo">Empresa</td>
						<td align="center"><font class="textcampo">E-mail</td>
						<td align="center"><font class="textcampo">Creado</td>
						<td align="center" width="60" colspan="2"><font class="textcampo">Reporte</td>
					</tr>
					<?	$i=0;
						$y=0;
						$esta=array("off.gif","on.gif");
						while($row=mysql_fetch_object($rs3)){
							$i++;
							$ide=$row->ID;
							$eva=$row->EVA;
							$nom=$row->N;
							$sit=$row->SIT;
							$usu=$row->U;
							$ema=$row->EM;
							$fch=$row->FCR;
							$est=$row->ES;
							if($y==0){	$y=1;	}
							else{		$y=0;	}
					?>
					<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
						<td align="right"><font class="textdetalle"><?=$i?></td>
						<td><font class="textdetalle"><?=$nom?></td>
						<td><font class="textdetalle"><?=$ema?></td>
						<td align="center"><font class="textdetalle"><?=$fch?></td>
						<td align="center"><a href="Reportes.php?e=<?=$ide?>"><img border="0" src="../img/balotario.png"></a></td>
					</tr>
					<?	}
						mysql_free_result($rs3);
					?>
					</table>
				</td>
			</tr>
		    </table>
			</td>
		</tr>
	    </table>
		</td>
	</tr>
<?	$sq3 = "SELECT *,DATE_format(FC,'%d-%m-%Y') as FCR ";
	$sq3.= "FROM TS_Tareas ";
	$sq3.= "WHERE Responsable=1 AND Est=0 AND Tipo=1 AND AsesorId=$EMP ";
	$sq3.= "ORDER BY FC desc LIMIT 0,5 ";
	$rs3 = mysql_query($sq3,$link) or die("Error 83 : <b>$sq3</b>");
	$ttt = mysql_num_rows($rs3);	
	if($ttt>0){
?>
	<tr><td valign="top">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td height="30px" valign="bottom"><h1>TAREAS ADMINISTRATIVAS</h1></td>
					<td align="right"><a href="Tareas.php">[ ver m&aacute;s tareas ]</a></td>
				</tr>
				<tr><td valign="top" align="center" colspan="2">
					<table border=0 cellpadding=3 cellspacing=1>
					<tr bgcolor="<?=CLR_CAB_DET?>">
						<td align="center"><font class="textcampo">C&oacute;digo</td>
						<td align="center"><font class="textcampo">Creador</td>
						<td align="center" colspan="2"><font class="textcampo">Dirigido a</td>
						<td align="center"><font class="textcampo">Estado</td>
						<td align="center"><font class="textcampo">Creado</td>
						<td align="center">&nbsp;</td>
					</tr>
					<?	$i=0;
						$y=0;
						while($row=mysql_fetch_object($rs3)){
	
							$i++;
							$y=(($y==0)?1:0);
	
							$IdT   =$row->TareaId;
							$IdCrea=$row->AdminId;
							$Tipo  =$row->Tipo;
							$IdEmp =$row->EmpresaId;
							$IdAse =$row->AsesorId;
							$IdResp=$row->Responsable;
							$Est   =$row->Est;
							$FCR   =$row->FCR;
	
							$sql="SELECT CONCAT(nom,' ',ape) N FROM iusuario WHERE idu=$IdCrea";
							$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
							$CREADOR=mysql_result($rsl,0,"N");
							mysql_freeresult($rsl);
	
							$NOMBRE="";
							if($IdResp==0){
								$sql ="SELECT Nom N FROM TS_Empresas WHERE EmpresaId=$IdEmp";
								$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
								$NOMBRE =mysql_result($rsl,0,"N");
								mysql_freeresult($rsl);
							}else{
								$sql="SELECT Nom N FROM TS_Admin WHERE AdminId=$IdAse";
								$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
								$NOMBRE=mysql_result($rsl,0,"N");
								mysql_freeresult($rsl);
							}
	
							$CLR01="#c0fa92";
							$CLR02="#d7ffb7";
	
							$COLOR=(($y==1)?$CLR01:$CLR02);
					?>
					<tr bgcolor="<?=$COLOR?>">
						<td align="center"><font class="textdetalle"><?=sprintf("%07d",$IdT)?></td>
						<td><font class="textdetalle"><?=$CREADOR?></td>
						<td><font class="textdetalle"><?=(($IdResp==0)?'Empresa':'Asesor')?></td>
						<td><font class="textdetalle"><?=$NOMBRE?></td>
						<td><font class="textdetalle"><?=(($Est==0)?'Nuevo':'Respondido')?></td>
						<td><font class="textdetalle"><?=$FCR?></td>
						<td valign="top"><a href="Tareas.php?idt=<?=$IdT?>"><img border="0" src="../img/btn_ver.png"></a></td>
					</tr>
					<?	}
						mysql_free_result($rs3);
					?>
					</table>
					</td>
				</tr>
				</table>
		</td>
	</tr>
<?	}
	$sq3 = "SELECT *,DATE_format(FC,'%d-%m-%Y') as FCR ";
	$sq3.= "FROM TS_Tareas ";
	$sq3.= "WHERE Responsable=1 AND Est=0 AND Tipo=0 AND AsesorId=$EMP ";
	$sq3.= "ORDER BY FC desc LIMIT 0,5 ";
	$rs3 = mysql_query($sq3,$link) or die("Error 27 : <b>$sq3</b>");
	$ttt = mysql_num_rows($rs3);	
	if($ttt>0){
?>
	<tr><td valign="top">

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td height="30px" valign="bottom"><h1>TAREAS DISPOSICIONES</h1></td>
				<td align="right"><a href="TareasDisposiciones.php">[ ver m&aacute;s tareas ]</a></td>
			</tr>
			<tr><td valign="top" align="center" colspan="2">
				<table border=0 cellpadding=3 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">Disposici&oacute;n</td>
					<td align="center"><font class="textcampo">Empresa</td>
					<td align="center"><font class="textcampo">Comentario de no conformidad</td>  
					<td align="center"><font class="textcampo">¿Qué actividades tengo que realizar?</td>
					<td align="center"><font class="textcampo">¿Qué necesito entregar?  </td>
					<td align="center"><font class="textcampo">¿Cuándo lo tengo que entregar?</td>
					<td align="center"><font class="textcampo">Creado</td>
				</tr>
				<?	$i=0;
					$y=0;
					while($row=mysql_fetch_object($rs3)){

						$i++;
						$y=(($y==0)?1:0);

						$IdT   =$row->TareaId;
						$IdCrea=$row->AdminId;
						$Tipo  =$row->Tipo;
						$IdEmp =$row->EmpresaId;
						$IdAse =$row->AsesorId;
						$IdResp=$row->Responsable;
						$Resp1 =$row->Comentario;
						$Resp2 =$row->ActividEntreg;
						$Resp3 =$row->QueNecesito;
						$Resp4 =$row->CuanEntrega;
						$Est   =$row->Est;
						$FCR   =$row->FCR;
						$NUM   =$row->Numeral;

						$sql="SELECT CONCAT(nom,' ',ape) N FROM iusuario WHERE idu=$IdCrea";
						$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
						$CREADOR=mysql_result($rsl,0,"N");
						mysql_freeresult($rsl);

						$sql ="SELECT Nom N FROM TS_Empresas WHERE EmpresaId=$IdEmp";
						$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
						$EMPRESA =mysql_result($rsl,0,"N");
						mysql_freeresult($rsl);

						if($IdResp==0){
							$NOMBRE =$EMPRESA;
						}else{
							$sql="SELECT Nom N FROM TS_Admin WHERE AdminId=$IdAse";
							$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
							$NOMBRE=mysql_result($rsl,0,"N");
							mysql_freeresult($rsl);
						}

						$CLR01="#c0fa92";
						$CLR02="#d7ffb7";

						$COLOR=(($y==1)?$CLR01:$CLR02);
				?>
				<tr bgcolor="<?=$COLOR?>">
					<td align="right"><font class="textdetalle"><?=$NUM?></td>
					<td><font class="textdetalle"><?=$EMPRESA?></td>
					<td><font class="textdetalle"><?=$Resp1?></td>
					<td><font class="textdetalle"><?=$Resp2?></td>
					<td><font class="textdetalle"><?=$Resp3?></td>
					<td align="center"><font class="textdetalle"><?=$Resp4?></td>
					<td width="60px"><font class="textdetalle"><?=$FCR?></td>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
			</td>
		</tr>
		</table>
		</td>
	</tr>
<?	} ?>
	</table>
<? include "mb_pie.php" ?>
<?	include "mb_cab.php";
	$mes = array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	$hoyd = date("j");
	$hoym = date("n");

	$sq3 = "SELECT Numeral ID,Des PRE,Puntaje PUN,Nivel NI ";
	$sq3.= "FROM TS_Preguntas ";
	$sq3.= "WHERE Nivel=1 ";
	$sq3.= "ORDER BY Numeral ";
	$rs3 = mysql_query($sq3,$link) or die("Error 3: <b>$sq3</b>");
?>
	<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr><td valign="top" width="50%">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr><td valign="top">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr><td><h1>SITUACION GENERAL DE LAS EMPRESAS AL DIA <?=$hoyd?> DE <?=$mes[$hoym]?> :</h1></td>
					</tr>
					<tr><td valign="top" align="center">
						<table border=0 cellpadding=3 cellspacing=1>
						<?	$i=0;
							$y=0;
							while($row=mysql_fetch_object($rs3)){
								$i++;
								$Num=$row->ID;
								$pre=$row->PRE;
								$PROMEDIO=0;
								$sq4 ="SELECT EmpresaId IDE FROM TS_EmpresaPreguntas GROUP BY EmpresaId ";
								$rs4 =mysql_query($sq4,$link) or die("Error 28 : $sq4 ");
								$NUMEMP=mysql_num_rows($rs4);
								while($ro4=mysql_fetch_object($rs4)){
									$ide=$ro4->IDE;
									$sq5="SELECT Numeral FROM TS_EmpresaPreguntas WHERE EmpresaId=$ide ";
									$rs5=mysql_query($sq5,$link) or die("Error 30 : $sq5 ");
									$tpr=mysql_num_rows($rs5);
									mysql_free_result($rs5);
									if($tpr>0){
										$sql ="SELECT SUM(Puntaje) PUN FROM TS_EmpresaPreguntas EP INNER JOIN ";
										$sql.="TS_Preguntas P ON EP.Numeral=P.Numeral ";
										$sql.="WHERE EP.EmpresaId=$ide AND EP.Numeral LIKE '$Num.%' ";
										$rs5 =mysql_query($sql,$link) or die("Error 40 : <b>$sql</b>");
										$PUNMAX=mysql_result($rs5,0,"PUN");
										mysql_freeresult($rs5);
										$sql ="SELECT SUM(P.Puntaje) PUN FROM TS_Preguntas P INNER JOIN ";
										$sql.="TS_EmpresaPreguntas EP ON P.Numeral=EP.Numeral ";
										$sql.="WHERE EmpresaId=$ide AND EP.Numeral LIKE '$Num.%' AND EP.CalificaId IN (2,3) ";
										$rs5 =mysql_query($sql,$link) or die("Error 47 : <b>$sql</b>");
										$PUNOBT  =((mysql_num_rows($rs5)>0)?mysql_result($rs5,0,"PUN"):0);
										mysql_freeresult($rs5);
										if($PUNMAX>0){
											$PROMEDIO+=($PUNOBT/$PUNMAX)*100;
										}
									}
								}
								mysql_free_result($rs4);						
								$PUNOBTENIDO=round(($PROMEDIO/$NUMEMP),0);
								$W=3*$PUNOBTENIDO;
								$y=(($y==0)?1:0);
						?>
						<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
							<td align="left"><font class="TxtReporte">Cumplimiento de <?=$pre?></font></td>
							<td align="right"><font class="TxtReporte"><?=$PUNOBTENIDO?>% de 100%</font></td>
							<td align="left" bgcolor="white">
								<table width="<?=$W?>px" border="0" cellpadding="0" cellspacing="0">
									<tr><td class="barraimg"></td></tr></table>
							</td>
						</tr>
						<?	}
							mysql_free_result($rs3);
						?>
						</table>
						</td>
					</tr>
					</table>
				</td>
<?	if(	$usu_prf<>1 ){
	$sq3 ="SELECT EmpresaId ID,Nom N FROM TS_Empresas ORDER BY Nom ";
	$rs3 =mysql_query($sq3,$link) or die("Error 78 : $sq3 ");
?>
				<td valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td><h1>EMPRESAS :</h1></td>	</tr>
		<tr><td valign="top" align="center">
				<table border="0" cellpadding="3" cellspacing="1">
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center" height="30"><font class="textcampo">#</td>
					<td align="center" colspan="2"><font class="textcampo">Empresa</td>
				</tr>
				<?	$i=0;
					$y=0;
					$esta=array("off.gif","on.gif");
					while($row=mysql_fetch_object($rs3)){
						$i++;
						$ide=$row->ID;
						$nom=$row->N;

						if($y==0){	$y=1;	}
						else{		$y=0;	}
				?>
				<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td align="center"><a href="AUEmpresa.php?id=<?=$ide?>"><img border="0" src="img/btn_ver.png"></a></td>
					<td><a href="AUEmpresa.php?id=<?=$ide?>"><?=$nom?></a></td>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
			</td>
		</tr>
		</table>
				</td>
<?	}	?>
			</tr>
<?	if(	$usu_prf==1 ){	?>
			<tr><td>
<?	$sq3 = "SELECT *,DATE_format(FC,'%d-%m-%Y') as FCR ";
	$sq3.= "FROM TS_Tareas ";
	$sq3.= "WHERE Est=0 AND Tipo=1 ";
	$sq3.= "ORDER BY FC desc LIMIT 0,5 ";
	$rs3 = mysql_query($sq3,$link) or die("Error 83 : <b>$sq3</b>");
?>
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
<?	}	?>
			</table>
			</td>
<?	if(	$usu_prf==1 ){	?>
			<td valign="top">

<?	$sq3 ="SELECT E.Nom N,V.Numeral NUM,DATE_format(V.FC,'[%H:%i] %d-%m-%Y') as FCR ";
	$sq3.="FROM TS_Empresas E INNER JOIN TS_Eventos V ON V.EmpresaId=E.EmpresaId ";
	$sq3.="WHERE V.Est=0 ";
	$sq3.="ORDER BY V.FC desc ";
	$rs3 =mysql_query($sq3,$link) or die("Error 8 : $sq3 ");
?>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td><h1>ACTIVIDADES DE LA PLATAFORMA</h1></td>	</tr>
				<tr><td valign="top" align="center">
<div style="overflow:auto;width:600px;height:250px;border:5px;" >
						<table width="100%" border="0" cellpadding=3 cellspacing=1 >
						<tr bgcolor="<?=CLR_CAB_DET?>">
							<td align="center"><font class="textcampo">#</td>
							<td align="center"><font class="textcampo">Empresa</td>
							<td align="center"><font class="textcampo">Actividad</td>
							<td align="center"><font class="textcampo">Creado</td>
						</tr>
						<?	$i=0;
							$y=0;
							while($row=mysql_fetch_object($rs3)){
								$i++;
								$nom=$row->N;
								$NUM=$row->NUM;
								$fch=$row->FCR;
								if($y==0){	$y=1;	}
								else{		$y=0;	}
						?>
						<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
							<td align="right"><font class="textdetalle"><?=$i?></td>
							<td><b><font class="textdetalle"><?=$nom?></b></td>
							<td><font class="textdetalle">Adjunto un documento a la disposici&oacute;n <b><?=$NUM?></b></td>
							<td align="center"><font class="textdetalle"><?=$fch?></td>
						</tr>
						<?	}
							mysql_free_result($rs3);
						?>
						</table>
</div>
					</td>
				</tr>
				</table>
			</td>
<?	}	?>
		</tr>
<?	if(	$usu_prf==1 ){	?>
		<tr><td valign="top" colspan="2">
<?	$sq3 = "SELECT *,DATE_format(FC,'%d-%m-%Y') as FCR ";
	$sq3.= "FROM TS_Tareas ";
	$sq3.= "WHERE Est=0 AND Tipo=0 ";
	$sq3.= "ORDER BY FC desc LIMIT 0,5 ";
	$rs3 = mysql_query($sq3,$link) or die("Error 27 : <b>$sq3</b>");
?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td height="30px" valign="bottom"><h1>TAREAS DISPOSICIONES</h1></td>
				<td align="right"><a href="TareasDisposiciones.php">[ ver m&aacute;s tareas ]</a></td>
			</tr>
			<tr><td valign="top" align="center" colspan="2">
				<table border=0 cellpadding=3 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">Disposici&oacute;n</td>
					<td align="center" colspan="2"><font class="textcampo">Dirigido a</td>
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
					<td><font class="textdetalle"><?=(($IdResp==0)?'Empresa':'Asesor')?></td>
					<td><font class="textdetalle"><?=$NOMBRE?></td>
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
<?	}	?>
	</table>
<? include "mb_pie.php" ?>
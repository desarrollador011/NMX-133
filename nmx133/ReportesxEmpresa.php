<?	include "mb_cab.php";

	$ASE=0;
	$EMP=0;
	If(isset($_POST['eval'])){
		$ASE=$_POST['eval'];
		$EMP=((trim($_POST['emp'])<>"")?$_POST['emp']:0);
	}
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td valign=top >
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>REPORTE POR EMPRESA</h1></td>
				<td valign="top">
<form method="post" action="ReportesxEmpresa.php" name="Reporte">
					<table border="0" cellpadding="3" cellspacing="1">
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>">
						<font class="textcampo">Asesor : </font></td>
						<td bgcolor="<?=BG1_FIL_DET?>">
							<select name="eval" id="eval" size="1" class="sele02" onclick="ActivarSelectSubTemas(this.value,'emp')">
							<?	$sql="SELECT AdminId ID,Nom N FROM TS_Admin WHERE Prf=0 ";
								$rsl=mysql_query($sql, $link) or die("Error: <b>$sql</b>");
								while($row=mysql_fetch_object($rsl)){
									$IdE=$row->ID;
							?>	<option value="<?=$IdE?>" <?=(($IdE==$ASE)?'selected':'')?>><?=$row->N?></option>
							<?	}
								mysql_free_result($rsl);
							?>
							</select>
						</td>
						<td rowspan="2">
							<input name="buscar" type="submit" value="Buscar" class="btn00">
						</td>
					</tr>
					<tr>
						<td align="right" bgcolor="<?=CLR_CAB_DET?>">
						<font class="textcampo">Empresa : </font></td>
						<td bgcolor="<?=BG1_FIL_DET?>">
							<select name="emp" id="emp" size="1" class="sele02">
<?	if($ASE<>0){
		$sq3 ="SELECT E.EmpresaId ID,E.Nom N ";
		$sq3.="FROM TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId ";
		$sq3.="WHERE A.AdminId=$ASE ";
		$sq3.="ORDER BY E.Nom ";
		$rsl=mysql_query($sq3, $link) or die("Error: <b>$sq3</b>");
		while($row=mysql_fetch_object($rsl)){
			$IdE=$row->ID;
?>
	<option value="<?=$IdE?>" <?=(($IdE==$EMP)?'selected':'')?>><?=$row->N?></option>
<?		}
		mysql_free_result($rsl);
	} ?>
							</select>
						</td>
					</tr>
					</table>
</form>
				</td>
			</tr>
<?	if($ASE<>0 AND $EMP<>0){ ?>
			<tr><td height="10" colspan="2">
				</td>
			</tr>
			<tr><td height="2px" colspan="2" bgcolor="maroon">
				</td>
			</tr>
			<tr><td height="10" colspan="2">
				</td>
			</tr>
			<tr><td valign="top" align="center" rowspan="3">
<?	$sql ="SELECT * FROM TS_Empresas WHERE EmpresaId=$EMP ";
	$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
	$E_n =mysql_result($rsl,0,"Nom");
	$E_m =mysql_result($rsl,0,"Ema");
	$E_u1=mysql_result($rsl,0,"Ubg1");
	$E_u2=mysql_result($rsl,0,"Ubg2");
	$E_u3=mysql_result($rsl,0,"Ubg3");
	$E_si=mysql_result($rsl,0,"Site");
	mysql_freeresult($rsl);
?>
					<table class="tablelista" border="0" cellpadding="3" cellspacing="1">
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nombre :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><?=$E_n?></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">E-mail :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><?=$E_m?></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Estado :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><?=$E_u1?></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Municipio :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><?=$E_u2?></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Localidad :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><?=$E_u3?></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Site :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><?=$E_si?></td>
					</tr>
					</table>
				</td>
				<td valign="top" align="center">
<?
	$sq3 ="SELECT A.Nom EVA,E.EmpresaId ID,E.Nom N,COUNT(*) TP ";
	$sq3.="FROM (TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId) INNER JOIN ";
	$sq3.="TS_EmpresaPreguntas EP ON EP.EmpresaId=E.EmpresaId ";
	$sq3.="WHERE A.AdminId=$ASE AND EP.EmpresaId=$EMP ";
	$sq3.="GROUP BY A.Nom,E.EmpresaId,E.Nom ";
	$rs3 =mysql_query($sq3,$link) or die("Error 16 : $sq3 ");
?>
					<table border="0" cellpadding="3" cellspacing="1">
					<tr bgcolor="<?=CLR_CAB_DET?>">
						<td align="center"><font class="textcampo">Puntaje<br>M&aacute;ximo</td>
						<td align="center"><font class="textcampo">Puntaje<br>Obtenido</td>
						<td align="center"><font class="textcampo">Porcentaje</td>
						<td align="center"><font class="textcampo">Avance</td>
					</tr>
					<?	$i=0;
						$y=0;
						while($row=mysql_fetch_object($rs3)){
							$i++;
							$ide=$row->ID;
							$eva=$row->EVA;
							$nom=$row->N;
							$tpr=$row->TP;

							$sql ="SELECT SUM(P.Puntaje) PUN FROM TS_Preguntas P INNER JOIN ";
							$sql.="TS_EmpresaPreguntas EP ON P.Numeral=EP.Numeral ";
							$sql.="WHERE EmpresaId=$ide";
							$rsl =mysql_query($sql,$link) or die("Error 36 : <b>$sql</b>");
							$PUNMAX=mysql_result($rsl,0,"PUN");
							mysql_freeresult($rsl);

							$sql ="SELECT SUM(P.Puntaje) PUN,COUNT(*) PREAPRO FROM TS_Preguntas P INNER JOIN ";
							$sql.="TS_EmpresaPreguntas EP ON P.Numeral=EP.Numeral ";
							$sql.="WHERE EmpresaId=$ide AND EP.CalificaId IN (2,3) ";
							$rsl =mysql_query($sql,$link) or die("Error 43 : <b>$sql</b>");
							$PUNOBT  =((mysql_num_rows($rsl)>0)?mysql_result($rsl,0,"PUN"):0);
							mysql_freeresult($rsl);

							$W=round(((300*$PUNOBT)/$PUNMAX),0);

							$PORCENTAJE=round(($PUNOBT/$PUNMAX)*100,0);
							if($y==0){	$y=1;	}
							else{		$y=0;	}
					?>
					<tr bgcolor="<?=(($y==1)?'#ffd658':'#ffe8a2')?>">
						<td align="center"><font class="textdetalle"><?=number_format($PUNMAX,2,'.',',')?></td>
						<td align="center"><font class="textdetalle"><?=number_format($PUNOBT,2,'.',',')?></td>
						<td align="center"><font class="textdetalle"><?=$PORCENTAJE?>%</td>
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
			<tr><td height="15px"></td></tr>
			<tr><td valign="top" align="center">
<?	$sq3 = "SELECT Numeral ID,Des PRE,Puntaje PUN,Nivel NI ";
	$sq3.= "FROM TS_Preguntas ";
	$sq3.= "WHERE Nivel=1 ";
	$sq3.= "ORDER BY Numeral ";
	$rs3 = mysql_query($sq3,$link) or die("Error 3: <b>$sq3</b>");
?>
				<table border=0 cellpadding=5 cellspacing=1>
				<?	$i=0;
					$y=0;
					while($row=mysql_fetch_object($rs3)){
						$i++;
						$Num=$row->ID;
						$pre=$row->PRE;
						$PROMEDIO=0;

						$ide=$EMP;
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
								$PROMEDIO=($PUNOBT/$PUNMAX)*100;
							}
						}
						$PUNOBTENIDO=round($PROMEDIO,0);
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
<?	} ?>
			</table>
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>
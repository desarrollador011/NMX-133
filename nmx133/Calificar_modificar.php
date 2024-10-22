<?	include "mb_cab.php";

	$EMP=0;
	$IDP=0;
	if(isset($_GET['id'])){
		$EMP=$_GET['id'];
		$sql ="SELECT Nom FROM TS_Empresas WHERE EmpresaId=$EMP";
		$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$CLIE=mysql_result($rsl,0,"Nom");
		mysql_freeresult($rsl);

		if(	$usu_prf==1 ){
			if(isset($_GET['p'])){
				$IDP=$_GET['p'];
				$sql ="SELECT CalificaId,Comentario,ActividEntreg,QueNecesito,CuanEntrega,Responsable ";
				$sql.="FROM TS_EmpresaPreguntas WHERE EmpresaId=$EMP AND Numeral='$IDP' ";
				$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
				$PCAL=mysql_result($rsl,0,"CalificaId");
				$PCOM=mysql_result($rsl,0,"Comentario");
				$PACT=mysql_result($rsl,0,"ActividEntreg");
				$PNEC=mysql_result($rsl,0,"QueNecesito");
				$PENT=mysql_result($rsl,0,"CuanEntrega");
				$PRES=mysql_result($rsl,0,"Responsable");
				mysql_freeresult($rsl);
			}
		}

		$sq3 = "SELECT EP.Doc DO,EP.CalificaId CAL, P.Numeral ID,P.Des PRE,P.Puntaje PUN,Cerrado CER  ";
		$sq3.= "FROM TS_Preguntas P INNER JOIN  ";
		$sq3.= "TS_EmpresaPreguntas EP ON P.Numeral=EP.Numeral ";
		$sq3.= "WHERE EP.EmpresaId=$EMP ";
		$sq3.= "ORDER BY P.Numeral ";
		$rs3 = mysql_query($sq3,$link) or die("Error 32 : <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td align="center" valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>CALIFICACI&Oacute;N A LA EMPRESA : <?=$CLIE?></h1></td>	</tr>
			<tr><td valign="top" align="center">
				<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">#</td>
					<td align="center"><font class="textcampo">Numeral</td>
					<td align="center"><font class="textcampo">Descripci&oacute;n</td>
					<td align="center"><font class="textcampo">Puntaje</td>
					<td align="center" colspan="2"><font class="textcampo">Calificaci&oacute;n</td>
					<td align="center" colspan="2"><font class="textcampo">Evidencia</td>
<?	if(	$usu_prf==1 ){ ?>
					<td align="center" ><font class="textcampo">Evaluar</td>
<?	} ?>
				</tr>
				<?	$i=0;
					$y=0;
					$PREGNOM="";
					while($row=mysql_fetch_object($rs3)){
						$i++;
						$p=$row->ID;
						$pre=$row->PRE;
						$PUN=$row->PUN;
						$DOC=$row->DO;
						$CAL=$row->CAL;
						$CER=$row->CER;
						$y=(($y==0)?1:0);

						$CALIFIMG="calif_sinrevisar.png";
						$CALIF="SIN REVISAR";
						if($CAL<>0){
							if($CAL<>1){
								if($CAL<>4){
									$CALIFIMG="calif_adecuado.png";
								}else{
									$CALIFIMG="calif_inadecuado.png";
								}
								$sql="SELECT Des FROM TS_Calificacion WHERE CalificaId=$CAL ";
								$rsl=mysql_query($sql,$link) or die("Error : $sql");
								$CALIF=strtoupper(mysql_result($rsl,0,"Des"));
								mysql_freeresult($rsl);
							}
						}
						$data = explode(".",$p);
						$CLR=$data[0];
						switch($CLR){
							case 4:
								$CLR01="#c0fa92";
								$CLR02="#d7ffb7";
								break;
							case 5:
								$CLR01="#fade92";
								$CLR02="#fcdb67";
								break;
							case 6:
								$CLR01="#92fae0";
								$CLR02="#c4fbed";
								break;
						}
						$COLOR=(($y==1)?$CLR01:$CLR02);
						if($IDP==$p){
							$PREGNOM=$pre;
							$COLOR="#ff0000";
						}
				?>
				<tr bgcolor="<?=$COLOR?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td><font class="textdetalle"><?=$p?></td>
					<td><font class="textdetalle"><?=$pre?></td>
					<td align="right"><font class="textdetalle"><?=$PUN?></td>
					<td align="center" valign="middle"><img src="img/<?=$CALIFIMG?>" border="0"></td>
					<td align="left"><font class="textdetalle"><?=$CALIF?></td>
					<td align="center" valign="middle"><? if($DOC<>''){ ?><a target="_blank" href="files/<?=$DOC?>"><?=$DOC?></a><? } ?></td>
					<td align="center" valign="middle" bgcolor="white"><? if($DOC<>''){ ?><a target="_blank" href="files/<?=$DOC?>"><img src="img/descargar.gif" border="0"></a><? } ?></td>
<?	if(	$usu_prf==1 ){ ?>
	<? if($CER==0){ ?>
					<td align="center" valign="middle" bgcolor="white"><? if($DOC<>''){ ?><a href="Calificar_modificar.php?id=<?=$EMP?>&p=<?=$p?>"><img src="img/btn_ver.png" border="0"></a><? }else{ ?><img src="img/blanco.png" border="0"></a><? } ?></td>
	<? }else{ ?>
					<td align="center"><img src="img/<?=$CALIFIMG?>" border="0"></td>
	<? } ?>
<?	} ?>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
				</td>
			</tr>
			<tr><td align="center" height="30">
				<input type="button" class="btn00" value="Cancelar" onClick="window.location='Calificar.php'">
				</td>
			</tr>
			<tr><td align="center" height="30">
				<font class="textdetalle">Total Preguntas : <?=$i?></font>
				</td>
			</tr>
			<tr><td align="center">
				<table border=0 cellspacing=1 cellpadding=3>
				<tr><td colspan="2" height="5"></td></tr>
				<tr><td colspan="2"><font class="textdetalle"><u>LEYENDA :</u></font></td></tr>
<?	if(	$usu_prf==1 ){ ?>
				<tr><td><img src="img/descargar.gif" border="0"></td>
					<td><font class="textdetalle">Clic para descargar archivo</font></td>
				</tr>
				<tr><td><img src="img/btn_ver.png" border="0"></td>
					<td><font class="textdetalle">Clic para evaluar pregunta</font></td>
				</tr>
<?	} ?>
				<tr><td><img src="img/calif_sinrevisar.png" border="0"></td>
					<td><font class="textdetalle">Pregunta sin revisar</font></td>
				</tr>
				<tr><td><img src="img/calif_adecuado.png" border="0"></td>
					<td><font class="textdetalle">Pregunta calificada OPORTUNIDAD DE MEJORA O ADECUADA </font></td>
				</tr>
				<tr><td><img src="img/calif_inadecuado.png" border="0"></td>
					<td><font class="textdetalle">Pregunta calificada INADECUADA</font></td>
				</tr>
			    </table>
				</td>
			</tr>
			</table>
		</td>
<?	if(	$usu_prf==1 ){ ?>
		<td align="center" valign="top">
			<table width="100%" border="0" cellpadding="3" cellspacing="0">
<?	if($IDP==0){	?>
			<tr><td><h1>SELECCIONE UNA PREGUNTA PARA CALIFICAR</h1></td>	</tr>
<?	}else{	?>
			<tr><td><h1>CALIFICANDO :</h1></td>	</tr>
			<tr><td valign="top" align="center">
<form method="post" action="Calificar_Guardar.php" name="FrmCalificar">
		<input type="hidden" name="PREG" value="<?=$IDP?>">
		<input type="hidden" name="EMP" value="<?=$EMP?>">
				<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Pregunta :</td>
					<td align="left"><?=$PREGNOM?></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Calificaci&oacute;n :</td>
					<td align="left">
						<select name="cal" id="cal" size="1" class="sele02">
						<?	$sql="SELECT CalificaId ID,Des N FROM TS_Calificacion ";
							$rsl=mysql_query($sql, $link) or die("Error: <b>$sql</b>");
							while($row=mysql_fetch_object($rsl)){
								$IDC=$row->ID;
						?>	<option value="<?=$IDC?>" <?=(($PCAL==$IDC)?'selected':'')?>><?=$row->N?></option>
						<?	}
							mysql_free_result($rsl);
						?>
						</select>
					</td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Comentario de no conformidad :</td>
					<td align="left"><textarea name="txt1" class="txta01"><?=$PCOM?></textarea></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Qué actividades tengo que realizar?</td>
					<td align="left"><textarea name="txt2" class="txta01"><?=$PACT?></textarea></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Qué necesito entregar?</td>
					<td align="left"><textarea name="txt3" class="txta01"><?=$PNEC?></textarea></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Cuándo lo tengo que entregar?</td>
					<td><input type="text" name="txt4" class="caja300" value="<?=$PENT?>"></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Quién es responsable?</td>
					<td>
						<select name="res" id="res" size="1" class="sele02">
							<option value="0" >Empresa</option>
							<option value="1" >Asesor</option>
						</select>
					</td>
				</tr>
				</table>
				</td>
			</tr>
			<tr><td align="center" height="30">
				<input type="submit" class="btn00" value="Calificar">
</form>
				</td>
			</tr>
<?	}	?>
			</table>
		</td>
<?	} ?>
	</tr>
    </table>
<?	}
	include "mb_pie.php" ?>
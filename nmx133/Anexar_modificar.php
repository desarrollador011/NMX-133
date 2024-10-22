<?	include "mb_cab.php";

	$ID=0;
	if(isset($_GET['id'])){
		$ID=$_GET['id'];
		$sql ="SELECT Nom FROM TS_Empresas WHERE EmpresaId=$ID";
		$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$CLIE=mysql_result($rsl,0,"Nom");
		mysql_freeresult($rsl);
	}

	$sq3 = "SELECT EP.Doc DO,EP.CalificaId CA, P.Numeral ID,P.Des PRE,P.Puntaje PUN,Cerrado CER  ";
	$sq3.= "FROM TS_Preguntas P INNER JOIN  ";
	$sq3.= "TS_EmpresaPreguntas EP ON P.Numeral=EP.Numeral ";
	$sq3.= "WHERE EP.EmpresaId=$ID ";
	$sq3.= "ORDER BY P.Numeral ";
	$rs3 = mysql_query($sq3,$link) or die("Error 19 : <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td>
			<table width="100%" border="0" cellpadding="3" cellspacing="0">
			<tr><td valign="top"><h1>ANEXO DE EVIDENCIAS A PREGUNTAS : <?=$CLIE?></h1></td>
<?	if(	$usu_prf==1 ){ ?>
				<td valign="top" align="right"><h1>ADJUNTAR EVIDENCIA : </h1></td>
<?	} ?>
			</tr>
			<tr><td valign="top" align="center">
<?	if(	$usu_prf==1 ){ ?>
<FORM action="Anexar_Attach.php" enctype="multipart/form-data" method="POST">
<input type="hidden" name="e" value="<?=$ID?>">
<?	} ?>
				<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">#</td>
					<td align="center"><font class="textcampo">Numeral</td>
					<td align="center"><font class="textcampo">Descripci&oacute;n</td>
					<td align="center"><font class="textcampo">Puntaje</td>
					<td align="center"><font class="textcampo">Evidencia</td>
<?	if(	$usu_prf==1 ){ ?>
					<td align="center" colspan="2"><font class="textcampo">Acci&oacute;n</td>
<?	} ?>
				</tr>
				<?	$i=0;
					$y=0;
					while($row=mysql_fetch_object($rs3)){
						$i++;
						$NUM=$row->ID;
						$pre=$row->PRE;
						$PUN=$row->PUN;
						$DOC=$row->DO;
						$CAL=$row->CA;
						$CER=$row->CER;

						$data = explode(".",$NUM);
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
						$y=(($y==0)?1:0);
				?>
				<tr bgcolor="<?=(($y==1)?$CLR01:$CLR02)?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td><font class="textdetalle"><?=$NUM?></td>
					<td><font class="textdetalle"><?=$pre?></td>
					<td align="right"><font class="textdetalle"><?=$PUN?></td>
					<td align="right" valign="middle"><? if($DOC<>''){ ?><a title="Clic para descargar adjunto" target="_blank" href="files/<?=$DOC?>"><?=$DOC?></a><? } ?></td>
<?	if(	$usu_prf==1 ){ ?>
	<? if($CER==0){ ?>
					<td align="right" valign="middle"><? if($DOC<>''){ ?><a title="Eliminar adjunto" href="Anexar_AttachDel.php?e=<?=$ID?>&p=<?=$NUM?>" OnClick="return confirm('¿Seguro desea eliminar?');"><img border="0" src="img/trash.png"></a><? } ?></td>
					<td align="center"><input type="radio" name="num" value="<?=$NUM?>"></td>
	<? }else{ ?>
					<td align="center" colspan="2"><img src="img/<?=$CALIFIMG?>" border="0"></td>
	<? } ?>
<?	} ?>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
				</td>
<?	if(	$usu_prf==1 ){ ?>
				<td align="right" valign="top" rowspan="3">
	<table width="100%" border="0" cellpadding="3" cellspacing="1">
	<tr><td colspan="2" align="left"><b>Seleccione la pregunta que desea adjuntar el archivo.</b></td>
	</tr>
	<tr><td align="right"><b>Adjunto :</b></td>
		<td><input type="file" name="nom" size="25" class="stl_select"></td>
	</tr>
	<tr><td align="right"><b>L&iacute;mite :</b></td>
		<td>2 MB</td>
	</tr>
	<tr><td align="right"><b>Importante :</b></td>
		<td>El nombre del archivo debe contener<br>* letras (a...z,A...Z),<br>* n&uacute;meros (0...9) y<br>* los s&iacute;mbolos ( _ y - )</td>
	</tr>
	<tr><td height="50" colspan="2" align="center">
		<input type="submit" value="Subir" class="btn00">
		</td>
	</tr>
	</table>
</FORM>
				</td>
<?	} ?>

			</tr>
			<tr><td align="center">
				<input type="button" class="btn00" value="Cancelar" onClick="window.navigate('Anexar.php')">
				</td>
			</tr>
			<tr><td align="center">
				<font class="textdetalle">Total Preguntas : <?=$i?></font>
				</td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>
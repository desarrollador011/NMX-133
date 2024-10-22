<?	include "mb_cab.php";

	$sq3 ="SELECT DocId ID,Des N,Doc D,Obs O,DATE_format(FC,'%d-%m-%Y') as FCR ";
	$sq3.="FROM TS_Documentos ";
	$sq3.="ORDER BY Des ";
	$rs3 =mysql_query($sq3,$link) or die("Error 6 : $sq3 ");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td valign=top>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>CAJA DE HERRAMIENTAS</h1></td></tr>
			<tr><td valign="top" align="center">
					<table border="0" cellpadding="3" cellspacing="1">
					<tr bgcolor="<?=CLR_CAB_DET?>">
						<td align="center" width="30" height="30"><font class="textcampo">#</td>
						<td align="center"><font class="textcampo">Descripci&oacute;n</td>
						<td align="center"><font class="textcampo">Documento</td>
						<td align="center" width="60"><font class="textcampo">Publicado</td>
						<td align="center" colspan="2"><font class="textcampo">Acci&oacute;n</td>
					</tr>
					<?	$i=0;
						$y=0;
						while($row=mysql_fetch_object($rs3)){
							$i++;
							$ide=$row->ID;
							$des=$row->N;
							$doc=$row->D;
							$fch=$row->FCR;
							if($y==0){	$y=1;	}
							else{		$y=0;	}
					?>
					<tr bgcolor="<?=(($y==1)?'#fff842':'#fffcb2')?>">
						<td align="right"><font class="textdetalle"><?=$i?></td>
						<td><font class="textdetalle"><?=$des?></td>
						<td><font class="textdetalle"><?=$doc?></td>
						<td align="center"><font class="textdetalle"><?=$fch?></td>
						<td align="center" valign="middle"><? if($doc<>''){ ?><a target="_blank" href="download/<?=$doc?>"><img src="img/descargar.gif" border="0"></a><? } ?></td>
						<td align="center">
<?	if(	$usu_prf==1 ){ ?>
<a href="Ayuda_AttachDel.php?id=<?=$ide?>" OnClick="return confirm('¿Seguro desea eliminar?');"><img border="0" src="img/btn_del.png"></a>
<?	} ?>
						</td>
					</tr>
					<?	}
						mysql_free_result($rs3);
					?>
					</table>
				</td>
			</tr>
			<tr><td align="center"><font class="textdetalle">Total Registros : </font><font class="textdetalle"><?=$i?></font></td>
			</tr>
			<tr><td align="center">
				<table border=0 cellspacing=1 cellpadding=3>
				<tr><td colspan="2" height="5"></td></tr>
				<tr><td colspan="2"><font class="textdetalle"><u>LEYENDA :</u></font></td></tr>
				<tr><td><img src="img/descargar.gif" border="0"></td>
					<td><font class="textdetalle">Clic para descargar archivo</font></td>
				</tr>
<?	if(	$usu_prf==1 ){ ?>
				<tr><td><img border="0" src="<?=NOM_DIR_IMG.NOM_IMG_DEL?>"></td>
					<td><font class="textdetalle">Modificar</font></td>
				</tr>
<?	} ?>
			    </table>
				</td>
			</tr>
			</table>
		</td>
<?	if(	$usu_prf==1 ){ ?>
		<td valign=top >
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>AGREGAR NUEVO DOCUMENTO DE AYUDA</h1></td>	</tr>
			<tr><td valign="top" align="center">
				<FORM action="Ayuda_Attach.php" enctype="multipart/form-data" method="POST">
					<table width="100%" border="0" cellpadding="1" cellspacing="1">
					<tr><td align="right"><font class="textdetalle">Descripci&oacute;n :</td>
						<td><input type="text" name="des" class="caja03"></td>
					</tr>
					<tr><td align="right"><font class="textdetalle">Archivo :</td>
						<td><input type="file" name="doc" class="caja03"></td>
					</tr>
					<tr><td align="right"><font class="textdetalle">L&iacute;mite :</font></td>
						<td><font class="textdetalle">2 MB</font></td>
					</tr>
					<tr><td align="right"><font class="textdetalle">Importante :</font></td>
						<td><font class="textdetalle">El nombre del archivo debe contener<br>* letras (a...z,A...Z),<br>* n&uacute;meros (0...9) y<br>* los s&iacute;mbolos ( _ y - )</font></td>
					</tr>
					<tr><td></td>
						<td><input type="submit" value="Subir" class="btn00"></td>
					</tr>
					</table>
				</FORM>
				</td>
			</tr>
			</table>
		</td>
<?	} ?>
	</tr>
    </table>
<? include "mb_pie.php" ?>
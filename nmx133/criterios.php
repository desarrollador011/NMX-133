<?	include "mb_cab.php";

	$niv=((isset($_GET['n']))?$_GET['n']:1);
	$pad=((isset($_GET['p']))?$_GET['p']:0);;
	$sub=0;
	$txt="";

	if(	$usu_prf==1 ){
		// 0:Crear | 1:Modificar
		$Accion=0;
		if(isset($_GET['id'])){
			$ID=$_GET['id'];
			$Accion=1;
			$sql="SELECT Numeral,Nivel,Des,Puntaje,Ayuda FROM TS_Preguntas WHERE Numeral='$ID'";
			$rsl=mysql_query($sql,$link) or die("Error : $sql");
			$PreDes=mysql_result($rsl,0,"Des");
			$PreAyu=mysql_result($rsl,0,"Ayuda");
			$PrePun=mysql_result($rsl,0,"Puntaje");
			mysql_freeresult($rsl);
		}
	}
	if($niv>1){
		$sql="SELECT Numeral,Nivel,Des,Puntaje FROM TS_Preguntas WHERE Numeral='$pad'";
		$rsl=mysql_query($sql,$link) or die("Error : $sql");
		$txt=mysql_result($rsl,0,"Des");
		mysql_freeresult($rsl);

		switch($niv){
			case 2:
				//$data = explode(".",$pad);
				$sub=0;
				break;
			case 3:
				$data = explode(".",$pad);
				$sub=$data[0];//.'.'.$data[1];
				break;
			case 4:
				$data = explode(".",$pad);
				$sub=$data[0].'.'.$data[1];//.'.'.$data[2];
				break;
		}
	}
	$niv2=$niv+1;
	$sq3 = "SELECT Numeral ID,Des PRE,Puntaje PUN,Nivel NI ";
	$sq3.= "FROM TS_Preguntas ";
	$sq3.= "WHERE Nivel=$niv ";
	$padx="";
	if($niv>1){
		$padx=$pad.".";
		$sq3.= "AND Numeral LIKE '$pad.%' ";
	}
	$sq3.= "ORDER BY Numeral ";
	$rs3 = mysql_query($sq3,$link) or die("Error 3: <b>$sq3</b>");

?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td valign=top>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td><h1>CRITERIOS DE LA NORMA</h1></td></tr>
<? if($niv>1){ ?>
		<tr><td align="left">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr><td valign="top"><a href="criterios.php?n=<?=($niv-1)?>&p=<?=$sub?>"><img border="0" src="img/subir.png"></a></td>
			<td valign="top"><h1>(Nivel <?=$niv?>) <?=$txt?></h1></td>
		</tr>
		</table>
			</td>
		</tr>
<? } ?>
		<tr><td valign="top" align="center">
			<table class="tablelista" border=0 cellpadding=4 cellspacing=1>
			<tr bgcolor="<?=CLR_CAB_DET?>">
				<td align="center"><font class="textcampo">#</td>
				<td align="center"><font class="textcampo">Numeral</td>
				<td align="center"><font class="textcampo">Descripci&oacute;n</td>
				<td align="center"><font class="textcampo">Sumatoria</td>
				<td align="center"><font class="textcampo">Puntaje</td>
				<td align="center" colspan="2"><font class="textcampo">Items</td>
<?	if(	$usu_prf==1 ){ ?>
				<td align="center" width="50" colspan="2"><font class="textcampo">Acci&oacute;n</td>
<?	} ?>
			</tr>
			<?	$i=0;
				$y=0;
				while($row=mysql_fetch_object($rs3)){
					$i++;
					$idp=$row->ID;
					$pre=$row->PRE;
					$nvl=$row->NI;
					$PUN=$row->PUN;
					$sqI="SELECT COUNT(*) ITEMS FROM TS_Preguntas WHERE Nivel=$niv2 AND Numeral LIKE '$idp.%' ";
					$rsI=mysql_query($sqI,$link) or die("Error : $sqI");
					$Items=((mysql_num_rows($rsI)>0)?mysql_result($rsI,0,"ITEMS"):0);
					mysql_freeresult($rsI);
					$SUM=0;
					if($PUN==0){
						$sqI="SELECT SUM(Puntaje) PUN FROM TS_Preguntas WHERE Numeral LIKE '$idp.%' ";
						$rsI=mysql_query($sqI,$link) or die("Error : $sqI");
						$SUM=((mysql_num_rows($rsI)>0)?mysql_result($rsI,0,"PUN"):0);
						mysql_freeresult($rsI);
					}

					$y=(($y==0)?1:0);
			?>
			<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
				<td align="right"><font class="textdetalle"><?=$i?></font></td>
				<td align="left"><font class="textdetalle"><?=$idp?></font></td>
				<td align="left"><font class="textdetalle"><?=$pre?></font></td>
				<td align="right"><font class="textdetalle"><?=number_format($SUM,2,'.',',')?></font></td>
				<td align="right"><font class="textdetalle"><?=number_format($PUN,2,'.',',')?></font></td>
				<td align="right"><font class="textdetalle"><?=$Items?></font></td>
				<td width="24px"><? if($PUN==0){ ?><a href="criterios.php?n=<?=$niv2?>&p=<?=$idp?>"><img border="0" src="img/item.png"></a><? } ?></td>
<?	if(	$usu_prf==1 ){ ?>
				<td align="center"><a href="criterios.php?n=<?=$niv?>&p=<?=$pad?>&id=<?=$idp?>"><img border="0" src="img/btn_edi.png"></a></td>
				<td align="center" width="24px"><? if($Items==0){ ?><a href="criterios_eliminar.php?n=<?=$niv?>&p=<?=$pad?>&id=<?=$idp?>" OnClick="return confirm('¿Seguro desea eliminar?');"><img border="0" src="img/btn_del.png"></a><? } ?></td>
<?	} ?>
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
			<tr><td><img border="0" src="<?=NOM_DIR_IMG?>item.png"></td>
				<td><font class="textdetalle">Ver criterio inferiores</font></td>
			</tr>
<?	if(	$usu_prf==1 ){ ?>
			<tr><td><img border="0" src="<?=NOM_DIR_IMG.NOM_IMG_EDI?>"></td>
				<td><font class="textdetalle">Modificar</font></td>
			</tr>
			<tr><td><img border="0" src="<?=NOM_DIR_IMG.NOM_IMG_DEL?>"></td>
				<td><font class="textdetalle">Eliminar</font></td>
			</tr>
<?	} ?>
		    </table>
			</td>
		</tr>
		</table>
		</td>
<?	if(	$usu_prf==1 ){ ?>
<?	if($Accion==0){ ?>
        <td valign=top>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>AGREGAR NUEVO CRITERIO DE LA NORMA</h1></td></tr>
			<tr><td valign="top">
					<form method="post" action="criterios_agregar2.php" name="publicar1">
						<input type="hidden" name="niv" value="<?=$niv?>">
						<input type="hidden" name="pad" value="<?=$pad?>">
						<table class="tablelista" border="0" cellpadding="1" cellspacing="1">
						<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Numeral :&nbsp;</font></td>
							<td bgcolor="<?=BG1_FIL_DET?>"><input value="<?=$padx?>" name="num" type="text" class="caja01" maxlength="12"></td>
						</tr>
						<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Criterio :&nbsp;</font></td>
							<td bgcolor="<?=BG1_FIL_DET?>"><textarea name="cri" class="txta03"></textarea></td>
						</tr>
						<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Ayuda contextual :&nbsp;</font></td>
							<td bgcolor="<?=BG1_FIL_DET?>"><textarea name="ayu" class="txta03"></textarea></td>
						</tr>
						<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Puntaje :&nbsp;</font></td>
							<td bgcolor="<?=BG1_FIL_DET?>"><input name="pun" type="text" class="caja01" maxlength="6"></td>
						</tr>
						<tr><td height="25" valign="top" align="center" colspan="2">
								<input name="agregar" type="submit" value="Agregar" class="btn00">
							</td>
						</tr>
						</table>
					</form>
				</td>
			</tr>
			</table>
		</td>
<?	}else{ ?>
        <td valign=top>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>MODIFICAR CRITERIO DE LA NORMA</h1></td></tr>
			<tr><td valign="top">
					<form method="post" action="criterios_modificar2.php" name="publicar2">
						<input type="hidden" name="idp" value="<?=$ID?>">
						<input type="hidden" name="niv" value="<?=$niv?>">
						<input type="hidden" name="pad" value="<?=$pad?>">
						<table class="tablelista" border="0" cellpadding="1" cellspacing="1">
						<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Numeral :&nbsp;</font></td>
							<td bgcolor="<?=BG1_FIL_DET?>"><input name="num" value="<?=$ID?>" type="text" class="caja01" maxlength="12"></td>
						</tr>
						<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Criterio :&nbsp;</font></td>
							<td bgcolor="<?=BG1_FIL_DET?>"><textarea name="cri" class="txta03"><?=$PreDes?></textarea></td>
						</tr>
						<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Ayuda contextual :&nbsp;</font></td>
							<td bgcolor="<?=BG1_FIL_DET?>"><textarea name="ayu" class="txta03"><?=$PreAyu?></textarea></td>
						</tr>
						<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Puntaje :&nbsp;</font></td>
							<td bgcolor="<?=BG1_FIL_DET?>"><input value="<?=$PrePun?>" name="pun" type="text" class="caja01" maxlength="5"></td>
						</tr>
						<tr><td height="25" valign="top" align="center" colspan="2">
								<input name="agregar" type="submit" value="Actualizar" class="btn00">
								<input type="button" value="Cancelar" class="btn00" onClick="history.go(-1)">
							</td>
						</tr>
						</table>
					</form>
				</td>
			</tr>
			</table>
		</td>
<?	}	?>
<?	}	?>
	</tr>
    </table>
<? include "mb_pie.php" ?>
<?	include "mb_cab.php";

	$sq3 ="SELECT A.Nom EVA,E.EmpresaId ID,E.Nom N ";
	$sq3.="FROM TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId ";
	$sq3.="ORDER BY E.AdminId,E.Nom ";
	$rs3 =mysql_query($sq3,$link) or die("Error 16 : $sq3 ");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td valign=top >
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>EMPRESAS CON PREGUNTAS ASIGNADAS</h1></td>	</tr>
			<tr><td valign="top" align="center">
					<table border="0" cellpadding="3" cellspacing="1">
					<tr bgcolor="<?=CLR_CAB_DET?>">
						<td align="center" width="30" height="30"><font class="textcampo">#</td>
						<td align="center"><font class="textcampo">Asesor Local</td>
						<td align="center"><font class="textcampo">Empresa</td>
						<td align="center" colspan="2"><font class="textcampo">Preguntas</td>
						<td align="center"><font class="textcampo">Puntaje</td>
						<td align="center"><font class="textcampo">Acci&oacute;n</td>
					</tr>
					<?	$i=0;
						while($row=mysql_fetch_object($rs3)){
							$i++;
							$ide=$row->ID;
							$eva=$row->EVA;
							$nom=$row->N;
							$y=(($y==0)?1:0);

							$sq4="SELECT Numeral FROM TS_EmpresaPreguntas WHERE EmpresaId=$ide ";
							$rs4=mysql_query($sq4,$link) or die("Error 30 : $sq4 ");
							$tpr=mysql_num_rows($rs4);
							mysql_free_result($rs4);
							$pun=0;
							if($tpr>0){
								$sql ="SELECT SUM(Puntaje) PUN FROM TS_EmpresaPreguntas EP INNER JOIN ";
								$sql.="TS_Preguntas P ON EP.Numeral=P.Numeral ";
								$sql.="WHERE EP.EmpresaId=$ide";
								$rs5 =mysql_query($sql,$link) or die("Error 39 : <b>$sql</b>");
								$pun=mysql_result($rs5,0,"PUN");
								mysql_freeresult($rs5);
							}
					?>
					<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
						<td align="right"><font class="textdetalle"><?=$i?></td>
						<td><font class="textdetalle"><?=$eva?></td>
						<td><font class="textdetalle"><?=$nom?></td>
						<td align="center"><font class="textdetalle"><?=$tpr?></td>
						<td align="center"><img border="0" src="img/<?=(($tpr>0)?'balotario.png':'balotariov.png')?>"></td>
						<td align="right"><font class="textdetalle"><?=number_format($pun,2,'.',',')?></td>
<?	if(	$usu_prf==1 ){ ?>
						<td align="center"><a href="balotario_modificar.php?id=<?=$ide?>"><img border="0" src="img/btn_edi.png"></a></td>
<?	}else{ ?>
						<td align="center"><a href="balotario_modificar.php?id=<?=$ide?>"><img border="0" src="img/btn_ver.png"></a></td>
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
				<tr><td><img border="0" src="<?=NOM_DIR_IMG?>balotario.png"></td>
					<td><font class="textdetalle">Si tiene preguntas asignadas</font></td>
				</tr>
				<tr><td><img border="0" src="<?=NOM_DIR_IMG?>balotariov.png"></td>
					<td><font class="textdetalle">No tiene preguntas asignadas</font></td>
				</tr>
<?	if(	$usu_prf==1 ){ ?>
				<tr><td><img border="0" src="<?=NOM_DIR_IMG.NOM_IMG_EDI?>"></td>
					<td><font class="textdetalle">Modificar</font></td>
				</tr>
<?	}else{ ?>
				<tr><td><img border="0" src="<?=NOM_DIR_IMG?>btn_ver.png"></td>
					<td><font class="textdetalle">Ver detalles</font></td>
				</tr>
<?	} ?>
			    </table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>
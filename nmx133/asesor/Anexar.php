<?	include "mb_cab.php";

	$sq3 ="SELECT A.Nom EVA,E.EmpresaId ID,E.Nom N,COUNT(*) TP ";
	$sq3.="FROM (TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId) INNER JOIN ";
	$sq3.="TS_EmpresaPreguntas EP ON EP.EmpresaId=E.EmpresaId ";
	$sq3.="WHERE E.AdminId=$usu_idu ";
	$sq3.="GROUP BY A.Nom,E.EmpresaId,E.Nom ";
	$sq3.="ORDER BY E.AdminId,E.Nom ";
	$rs3 =mysql_query($sq3,$link) or die("Error 16 : $sq3 ");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td valign=top >
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>ANEXO DE EVIDENCIAS A PREGUNTAS</h1></td>	</tr>
			<tr><td valign="top" align="center">
					<table border="0" cellpadding="3" cellspacing="1">
					<tr bgcolor="<?=CLR_CAB_DET?>">
						<td align="center" width="30" height="30"><font class="textcampo">#</td>
						<td align="center"><font class="textcampo">Empresa</td>
						<td align="center" colspan="2"><font class="textcampo">Preguntas</td>
						<td align="center"><font class="textcampo">Acci&oacute;n</td>
					</tr>
					<?	$i=0;
						$y=0;
						while($row=mysql_fetch_object($rs3)){
							$i++;
							$ide=$row->ID;
							$eva=$row->EVA;
							$nom=$row->N;
							$tpr=$row->TP;
							if($y==0){	$y=1;	}
							else{		$y=0;	}

							$sq4="SELECT Numeral FROM TS_EmpresaPreguntas WHERE EmpresaId=$ide ";
							$rs4=mysql_query($sq4,$link) or die("Error 33 : $sq4 ");
							$tpr=mysql_num_rows($rs4);
					?>
					<tr bgcolor="<?=(($y==1)?'#ffd658':'#ffe8a2')?>">
						<td align="right"><font class="textdetalle"><?=$i?></td>
						<td><font class="textdetalle"><?=$nom?></td>
						<td align="center"><img border="0" src="../img/<?=(($tpr>0)?'balotario.png':'balotariov.png')?>"></td>
						<td align="center"><font class="textdetalle"><?=$tpr?></td>
						<td align="center"><? if($tpr>0){ ?><a href="Anexar_modificar.php?id=<?=$ide?>"><img border="0" src="../img/btn_edi.png"></a><? } ?></td>
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
				<tr><td><img border="0" src="../<?=NOM_DIR_IMG.NOM_IMG_EDI?>"></td>
					<td><font class="textdetalle">Modificar</font></td>
				</tr>
			    </table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>
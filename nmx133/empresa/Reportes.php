<?	include "mb_cab.php";

	$sq3 ="SELECT A.Nom EVA,E.EmpresaId ID,E.Nom N,COUNT(*) TP ";
	$sq3.="FROM (TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId) INNER JOIN ";
	$sq3.="TS_EmpresaPreguntas EP ON EP.EmpresaId=E.EmpresaId ";
	$sq3.="WHERE E.EmpresaId=$usu_idu ";
	$sq3.="GROUP BY A.Nom,E.EmpresaId,E.Nom ";
	$sq3.="ORDER BY E.AdminId,E.Nom ";
	$rs3 =mysql_query($sq3,$link) or die("Error 16 : $sq3 ");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td valign=top >
			<!--table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>REPORTE GENERAL</h1></td>	</tr>
			<tr><td valign="top" align="center">
					<table border="0" cellpadding="3" cellspacing="1">
					<tr bgcolor="<?=CLR_CAB_DET?>">
						<td align="center" width="30" height="30"><font class="textcampo">#</td>
						<td align="center"><font class="textcampo">Asesor Local</td>
						<td align="center"><font class="textcampo">Empresa</td>
						<td align="center"><font class="textcampo">Puntaje<br>M&aacute;ximo</td>
						<td align="center"><font class="textcampo">Puntaje<br>Obtenido</td>
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
							$rsl =mysql_query($sql,$link) or die("Error 37 : <b>$sql</b>");
							$PUNMAX=mysql_result($rsl,0,"PUN");
							mysql_freeresult($rsl);

							$sql ="SELECT SUM(P.Puntaje) PUN,COUNT(*) PREAPRO FROM TS_Preguntas P INNER JOIN ";
							$sql.="TS_EmpresaPreguntas EP ON P.Numeral=EP.Numeral ";
							$sql.="WHERE EmpresaId=$ide AND EP.CalificaId IN (2,3) ";
							$rsl =mysql_query($sql,$link) or die("Error 44 : <b>$sql</b>");
							$PUNOBT  =((mysql_num_rows($rsl)>0)?mysql_result($rsl,0,"PUN"):0);
							$PREAPROB=((mysql_num_rows($rsl)>0)?mysql_result($rsl,0,"PREAPRO"):0);
							mysql_freeresult($rsl);
							$W=round(((300*$PUNOBT)/$PUNMAX),0);
							if($y==0){	$y=1;	}
							else{		$y=0;	}
					?>
					<tr bgcolor="<?=(($y==1)?'#ffd658':'#ffe8a2')?>">
						<td align="right"><font class="textdetalle"><?=$i?></td>
						<td><font class="textdetalle"><?=$eva?></td>
						<td><font class="textdetalle"><?=$nom?></td>
						<td align="center"><font class="textdetalle"><?=number_format($PUNMAX,2,'.',',')?></td>
						<td align="center"><font class="textdetalle"><?=number_format($PUNOBT,2,'.',',')?></td>
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
			</tr>
			</table-->
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>
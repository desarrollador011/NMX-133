<?	include "mb_cab.php";
	$mes = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
	$hoyd = date("j");
	$hoym = date("n");

	$sq3 = "SELECT Numeral ID,Des PRE,Puntaje PUN,Nivel NI ";
	$sq3.= "FROM TS_Preguntas ";
	$sq3.= "WHERE Nivel=1 ";
	$sq3.= "ORDER BY Numeral ";
	$rs3 = mysql_query($sq3,$link) or die("Error 3: <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td valign=top >
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>La situaci&oacute;n general de las empresas al d&iacute;a <?=$hoyd?> de <?=$mes[$hoym]?> es:</h1></td>	</tr>
			<tr><td valign="top" align="center">
				<table border=0 cellpadding=5 cellspacing=1>
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
	</tr>
    </table>
<? include "mb_pie.php" ?>
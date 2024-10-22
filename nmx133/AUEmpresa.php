<?	include "mb_cab.php";
	$IdUsu=$_GET['id'];
	$sqMN="SELECT * FROM TS_Empresas WHERE EmpresaId=$IdUsu";
	$rsMN=mysql_query($sqMN,$link) or die("Error Menu : <b>$sqMN</b>");
	$usu_log=mysql_result($rsMN,0,"Usu");
	$usu_nom=mysql_result($rsMN,0,"Nom");
	$usu_img=mysql_result($rsMN,0,"Img");
	$usu_ase=mysql_result($rsMN,0,"AdminId");
	mysql_freeresult($rsMN);

	$mes = array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	$hoyd = date("j");
	$hoym = date("n");
?>
	<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr><td>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td valign="top" width="390px">
<? if($usu_img<>""){ ?>
			<img width="375px" src="empresaimg/<?=$usu_img?>">
<? }else{ ?>
			<img src="empresaimg/nodisponible.jpg">
<? } ?>
			</td>
			<td valign="top">
				<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr><td valign="top"><span class="EMP_Bienveni">Empresa: <?=$usu_nom?></span></td>
				</tr>
				<tr><td height="15px">&nbsp;</td></tr>
				<tr><td valign="top"><span class="EMP_Bienveni">SITUACION GENERAL DE LA EMPRESA AL DIA <?=$hoyd?> DE <?=$mes[$hoym]?> :</span></td>
				</tr>
				<tr><td valign="top">
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
								$sq5="SELECT Numeral FROM TS_EmpresaPreguntas WHERE EmpresaId=$IdUsu ";
								$rs5=mysql_query($sq5,$link) or die("Error 30 : $sq5 ");
								$tpr=mysql_num_rows($rs5);
								mysql_free_result($rs5);
								if($tpr>0){
									$sql ="SELECT SUM(Puntaje) PUN FROM TS_EmpresaPreguntas EP INNER JOIN ";
									$sql.="TS_Preguntas P ON EP.Numeral=P.Numeral ";
									$sql.="WHERE EP.EmpresaId=$IdUsu AND EP.Numeral LIKE '$Num.%' ";
									$rs5 =mysql_query($sql,$link) or die("Error 40 : <b>$sql</b>");
									$PUNMAX=mysql_result($rs5,0,"PUN");
									mysql_freeresult($rs5);
									$sql ="SELECT SUM(P.Puntaje) PUN FROM TS_Preguntas P INNER JOIN ";
									$sql.="TS_EmpresaPreguntas EP ON P.Numeral=EP.Numeral ";
									$sql.="WHERE EmpresaId=$IdUsu AND EP.Numeral LIKE '$Num.%' AND EP.CalificaId IN (2,3) ";
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
							<td align="center"><a href="AUCalificar.php?n=<?=$Num?>&e=<?=$IdUsu?>"><img border="0" src="img/btn_ver.png"></a></td>
							<td align="left"><a href="AUCalificar.php?n=<?=$Num?>&e=<?=$IdUsu?>"><font class="TxtReporte"><?=$Num?>.0</font></a></td>
							<td align="left"><font class="TxtReporte">Cumplimiento de <?=$pre?></font></td>
							<td align="right"><font class="TxtReporte"><?=$PUNOBTENIDO?>% de 100%</font></td>
							<td align="left" bgcolor="white">
								<table width="<?=$W?>px" border="0" cellpadding="0" cellspacing="0">
								<tr><td class="barraimg"></td></tr>
								</table>
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
		</td>
	</tr>
	</table>
<? include "mb_pie.php" ?>
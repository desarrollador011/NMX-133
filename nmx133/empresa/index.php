<?	include "mb_cab.php";
	$EMP=$usu_idu;
	$mes = array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	$hoyd = date("j");
	$hoym = date("n");
?>
	<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr><td>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td valign="top" width="390px">

<? if($usu_img<>""){ ?>
			<img width="375px" src="../empresaimg/<?=$usu_img?>">
<? }else{ ?>
			<img src="../empresaimg/nodisponible.jpg">
<? } ?>
			</td>
			<td valign="top">
		<table border="0" cellpadding="5" cellspacing="0" width="100%">
		<tr><td valign="top"><span class="EMP_Bienveni">Bienvenidos <?=$usu_nom?></span>
			</td>
		</tr>
		<tr><td height="15px">&nbsp;</td></tr>
		<tr><td valign="top"><span class="EMP_Bienveni">SITUACION GENERAL DE LA EMPRESA AL DIA <?=$hoyd?> DE <?=$mes[$hoym]?> :</span>
			</td>
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
					<td align="center"><a href="Disposiciones.php?n=<?=$Num?>"><img border="0" src="../img/balotario.png"></a></td>
					<td align="right"><a href="Disposiciones.php?n=<?=$Num?>"><font class="TxtReporte"><?=$Num?>.0</font></a></td>
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
			<td valign="top" align="right">
<?		$sql="SELECT * FROM TS_Admin WHERE AdminId=$usu_ase";
		$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$A_No=mysql_result($rsl,0,"Nom");
		$A_em=mysql_result($rsl,0,"Ema");
		$A_di=mysql_result($rsl,0,"Dir");
		$A_te=mysql_result($rsl,0,"Tel");
		$A_ce=mysql_result($rsl,0,"Cel");
		$A_sk=mysql_result($rsl,0,"Sky");
		mysql_freeresult($rsl);
?>
				<table border="0" cellpadding="1" cellspacing="0">
				<tr><td><span class="EMP_PRE_Emp"><?=$usu_nom?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase"><?=$A_No?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase">Asesor Local</span></td></tr>
				<tr><td><span class="EMP_PRE_Ase"><?=$A_di?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase">Tel: <?=$A_te?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase">Cel: <?=$A_ce?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase"><?=$A_em?></span></td></tr>
				<tr><td><span class="EMP_PRE_Ase">Skype: <?=$A_sk?></span></td></tr>
			    </table>
			</td>
		</tr>
		<tr><td colspan="3"></td>
		</tr>
	    </table>
		</td>
	</tr>
	<tr><td valign="top" align="center">
<?	$sq3 = "SELECT *,DATE_format(FC,'%d-%m-%Y') as FCR ";
	$sq3.= "FROM TS_Tareas ";
	$sq3.= "WHERE Responsable=0 AND Est=0 AND Tipo=0 AND EmpresaId=$EMP ";
	$sq3.= "ORDER BY FC desc LIMIT 0,5 ";
	$rs3 = mysql_query($sq3,$link) or die("Error 27 : <b>$sq3</b>");
?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td height="30px" valign="bottom"><h1>TAREAS DISPOSICIONES</h1></td>
				<td align="right"><a href="TareasDisposiciones.php">[ ver m&aacute;s tareas ]</a></td>
			</tr>
			<tr><td valign="top" align="center" colspan="2">
				<table border=0 cellpadding=3 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">Disposici&oacute;n</td>
					<td align="center"><font class="textcampo">Comentario de no conformidad</td>  
					<td align="center"><font class="textcampo">¿Qué actividades tengo que realizar?</td>
					<td align="center"><font class="textcampo">¿Qué necesito entregar?  </td>
					<td align="center"><font class="textcampo">¿Cuándo lo tengo que entregar?</td>
					<td align="center"><font class="textcampo">Creado</td>
				</tr>
				<?	$i=0;
					$y=0;
					while($row=mysql_fetch_object($rs3)){

						$i++;
						$y=(($y==0)?1:0);

						$IdT   =$row->TareaId;
						$IdCrea=$row->AdminId;
						$Tipo  =$row->Tipo;
						$IdEmp =$row->EmpresaId;
						$IdAse =$row->AsesorId;
						$IdResp=$row->Responsable;
						$Resp1 =$row->Comentario;
						$Resp2 =$row->ActividEntreg;
						$Resp3 =$row->QueNecesito;
						$Resp4 =$row->CuanEntrega;
						$Est   =$row->Est;
						$NUM   =$row->Numeral;
						$FCR   =$row->FCR;

						$sql="SELECT CONCAT(nom,' ',ape) N FROM iusuario WHERE idu=$IdCrea";
						$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
						$CREADOR=mysql_result($rsl,0,"N");
						mysql_freeresult($rsl);

						$NOMBRE="";
						if($IdResp==0){
							$sql ="SELECT Nom N FROM TS_Empresas WHERE EmpresaId=$IdEmp";
							$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
							$NOMBRE =mysql_result($rsl,0,"N");
							mysql_freeresult($rsl);
						}else{
							$sql="SELECT Nom N FROM TS_Admin WHERE AdminId=$IdAse";
							$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
							$NOMBRE=mysql_result($rsl,0,"N");
							mysql_freeresult($rsl);
						}

						$CLR01="#c0fa92";
						$CLR02="#d7ffb7";

						$COLOR=(($y==1)?$CLR01:$CLR02);
				?>
				<tr bgcolor="<?=$COLOR?>">
					<td align="right"><font class="textdetalle"><?=$NUM?></td>
					<td><font class="textdetalle"><?=$Resp1?></td>
					<td><font class="textdetalle"><?=$Resp2?></td>
					<td><font class="textdetalle"><?=$Resp3?></td>
					<td align="center"><font class="textdetalle"><?=$Resp4?></td>
					<td width="60px"><font class="textdetalle"><?=$FCR?></td>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
		</td>
	</tr>
	</table>
<? include "mb_pie.php" ?>
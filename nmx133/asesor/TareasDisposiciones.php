<?	include "mb_cab.php";
	$EMP = $usu_idu;
	$sq3 = "SELECT *,DATE_format(FC,'%d-%m-%Y') as FCR ";
	$sq3.= "FROM TS_Tareas ";
	$sq3.= "WHERE Tipo=0 AND Est=0 AND AsesorId=$EMP  ";
	$sq3.= "ORDER BY FC desc ";
	$rs3 = mysql_query($sq3,$link) or die("Error 27 : <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td align="center" valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>TAREAS DISPOSICIONES</h1></td>	</tr>
			<tr><td valign="top" align="center">
				<table border=0 cellpadding=3 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">Disposici&oacute;n</td>
					<td align="center"><font class="textcampo">Creador</td>
					<td align="center" colspan="2"><font class="textcampo">Dirigido a</td>
					<td align="center"><font class="textcampo">Empresa</td>
					<td align="center"><font class="textcampo">Comentario de no conformidad</td>  
					<td align="center"><font class="textcampo">¿Qué actividades tengo que realizar?</td>
					<td align="center"><font class="textcampo">¿Qué necesito entregar?  </td>
					<td align="center"><font class="textcampo">¿Cuándo lo tengo que entregar?</td>
					<td align="center" width="60px"><font class="textcampo">Creado</td>
					<td align="center"><font class="textcampo">Estado</td>
				</tr>
				<?	$i=0;
					$y=0;
					while($row=mysql_fetch_object($rs3)){
/*
CREATE TABLE TS_Tareas (
  TareaId int(7) NOT NULL AUTO_INCREMENT,
  AdminId int(7) NOT NULL,
  Tipo tinyint(1) NOT NULL,
  EmpresaId int(7) NOT NULL,
  AsesorId int(7) NOT NULL,
  Numeral varchar(12) NOT NULL,
  Comentario text,
  ActividEntreg text NOT NULL,
  QueNecesito text NOT NULL,
  CuanEntrega varchar(120) NOT NULL,
  Responsable tinyint(1) NOT NULL,
  Respuesta text NOT NULL,
  Est tinyint(1) NOT NULL,
  FC datetime NOT NULL,
  FM datetime NOT NULL,
  PRIMARY KEY (TareaId)
);
*/
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
						$FCR   =$row->FCR;
						$NUM   =$row->Numeral;

						$sql="SELECT CONCAT(nom,' ',ape) N FROM iusuario WHERE idu=$IdCrea";
						$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
						$CREADOR=mysql_result($rsl,0,"N");
						mysql_freeresult($rsl);

						$sql ="SELECT Nom N FROM TS_Empresas WHERE EmpresaId=$IdEmp";
						$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
						$EMPRESA =mysql_result($rsl,0,"N");
						mysql_freeresult($rsl);

						if($IdResp==0){
							$NOMBRE =$EMPRESA;
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
					<td><font class="textdetalle"><?=$CREADOR?></td>
					<td><font class="textdetalle"><?=(($IdResp==0)?'Empresa':'Asesor')?></td>
					<td><font class="textdetalle"><?=$NOMBRE?></td>
					<td><font class="textdetalle"><?=$EMPRESA?></td>
					<td><font class="textdetalle"><?=$Resp1?></td>
					<td><font class="textdetalle"><?=$Resp2?></td>
					<td><font class="textdetalle"><?=$Resp3?></td>
					<td><font class="textdetalle"><?=$Resp4?></td>
					<td><font class="textdetalle"><?=$FCR?></td>
					<td><font class="textdetalle"><?=(($Est==0)?'Nuevo':'Respondido')?></td>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
				</td>
			</tr>
			<tr><td align="center" height="30">
				<font class="textdetalle">Total Tareas Pendientes : <?=$i?></font>
				</td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
<?	include "mb_pie.php" ?>
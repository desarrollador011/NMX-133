<?	include "mb_cab.php";
	if(	$usu_prf==1 ){
		$Nuevo=1;
		if(isset($_GET['idt'])){
			$Nuevo=0;
			$TID=$_GET['idt'];

			/*$sql ="UPDATE TS_Tareas SET ";
			$sql.="Est=0, ";
			$sql.="FM=now() ";
			$sql.="WHERE TareaId=$TID ";
			//$sql.="WHERE Tipo=1 AND Est=0 AND TareaId=$TID ";
			$rsU = mysql_query($sql,$link) or die("Error : <b>$sql</b>");
			*/
			$sql="SELECT * FROM TS_Tareas WHERE TareaId=$TID";
			$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
			$EmpId=mysql_result($rsl,0,"EmpresaId");
			$AseId=mysql_result($rsl,0,"AsesorId");
			$Comen=mysql_result($rsl,0,"Comentario");
			$ActEn=mysql_result($rsl,0,"ActividEntreg");
			$QueNe=mysql_result($rsl,0,"QueNecesito");
			$CuaEn=mysql_result($rsl,0,"CuanEntrega");
			$Respo=mysql_result($rsl,0,"Responsable");
			$Respu=mysql_result($rsl,0,"Respuesta");
			mysql_freeresult($rsl);

			$sql ="SELECT Nom FROM TS_Empresas WHERE EmpresaId=$EmpId ";
			$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
			$EmpNo =mysql_result($rsl,0,"Nom");
			mysql_freeresult($rsl);

			$sql="SELECT Nom FROM TS_Admin WHERE AdminId=$AseId ";
			$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
			$AseNo=mysql_result($rsl,0,"Nom");
			mysql_freeresult($rsl);
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
		}
	}
	$sq3 = "SELECT *,DATE_format(FC,'%d-%m-%Y') as FCR ";
	$sq3.= "FROM TS_Tareas ";
	$sq3.= "WHERE Tipo=1 ";
	$sq3.= "ORDER BY est,FC desc ";
	$rs3 = mysql_query($sq3,$link) or die("Error 27 : <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td align="center" valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>TAREAS ADMINISTRATIVAS</h1></td>	</tr>
			<tr><td valign="top" align="center">
				<table border=0 cellpadding=3 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">C&oacute;digo</td>
					<td align="center"><font class="textcampo">Creador</td>
					<td align="center" colspan="2"><font class="textcampo">Dirigido a</td>
					<td align="center"><font class="textcampo">Estado</td>
					<td align="center"><font class="textcampo">Creado</td>
					<td align="center"><font class="textcampo">Acci&oacute;n</td>
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
						$Est   =$row->Est;
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
						$COLOR=(($Est==0)?$COLOR:"#fafb84");
				?>
				<tr bgcolor="<?=$COLOR?>">
					<td align="center"><font class="textdetalle"><?=sprintf("%07d",$IdT)?></td>
					<td><font class="textdetalle"><?=$CREADOR?></td>
					<td><font class="textdetalle"><?=(($IdResp==0)?'Empresa':'Asesor')?></td>
					<td><font class="textdetalle"><?=$NOMBRE?></td>
					<td><font class="textdetalle"><?=(($Est==0)?'Nuevo':'Leido')?></td>
					<td><font class="textdetalle"><?=$FCR?></td>
					<td align="center" valign="middle"><a href="Tareas.php?idt=<?=$IdT?>"><img border="0" src="img/btn_ver.png"></a></td>
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
<?	if(	$usu_prf==1 ){ ?>
		<td align="left" valign="top" width="50%">
<?		if($Nuevo==1){ ?>
			<table width="100%" border="0" cellpadding="3" cellspacing="0">
			<tr><td><h1>CREAR NUEVA TAREA :</h1></td>	</tr>
			<tr><td valign="top" align="left">
<form method="post" action="Tareas_Guardar.php" name="Reporte">
				<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Asesor :</td>
					<td align="left">
						<select name="eval" id="eval" size="1" class="sele02" onclick="ActivarSelectSubTemas(this.value,'emp')">
						<?	$sql="SELECT AdminId ID,Nom N FROM TS_Admin WHERE Prf=0 ";
							$rsl=mysql_query($sql, $link) or die("Error: <b>$sql</b>");
							while($row=mysql_fetch_object($rsl)){
								$IdE=$row->ID;
						?>	<option value="<?=$IdE?>"><?=$row->N?></option>
						<?	}
							mysql_free_result($rsl);
						?>
						</select>
					</td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Empresa :</td>
					<td align="left">
						<select name="emp" id="emp" size="1" class="sele02">
							<option value="0">-- Seleccione un Asesor</option>
						</select>
					</td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Comentario de no conformidad :</td>
					<td align="left"><textarea name="txt1" class="txt00"></textarea></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Qué actividades tengo que realizar?</td>
					<td align="left"><textarea name="txt2" class="txt00"></textarea></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Qué necesito entregar?</td>
					<td align="left"><textarea name="txt3" class="txt00"></textarea></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Cuándo lo tengo que entregar?</td>
					<td><input type="text" name="txt4" class="caja300" value=""></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Quién es responsable?</td>
					<td>
						<select name="res" id="res" size="1" class="sele02">
							<option value="0" >Empresa</option>
							<option value="1" >Asesor</option>
						</select>
					</td>
				</tr>
				</table>
				</td>
			</tr>
			<tr><td align="center" height="30">
				<input type="submit" class="btn00" value="Crear Tarea">
</form>
				</td>
			</tr>
			</table>
<?		}else{ ?>
			<table width="100%" border="0" cellpadding="3" cellspacing="0">
			<tr><td><h1>DETALLES DE TAREA :</h1></td>	</tr>
			<tr><td valign="top" align="left">
				<table class="tablelista" border=0 cellpadding=5 cellspacing=1>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Asesor :</td>
					<td align="left"><?=$AseNo?></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Empresa :</td>
					<td align="left"><?=$EmpNo?></td>
					</td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Comentario de no conformidad :</td>
					<td align="left"><?=$Comen?></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Qué actividades tengo que realizar?</td>
					<td align="left"><?=$ActEn?></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Qué necesito entregar?</td>
					<td align="left"><?=$QueNe?></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Cuándo lo tengo que entregar?</td>
					<td align="left"><?=$CuaEn?></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Respuesta :</td>
					<td align="left"><?=$Respu?></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">¿Quién es responsable?</td>
					<td><?=(($Respo==0)?'Empresa':'Asesor')?></td>
				</tr>
				</table>
				</td>
			</tr>
			<tr><td align="center">
				<input type="button" value="Cancelar" class="btn00" onClick="window.location.href = 'Tareas.php';">
				</td>
			</tr>
			</table>
<?		} ?>
		</td>
<?	} ?>
	</tr>
    </table>
<?	include "mb_pie.php" ?>
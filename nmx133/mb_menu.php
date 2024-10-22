<table class="tablemenu" border=0 cellspacing=0 cellpadding=0>
<tr><td align="left" valign="top">
		<table class="tablemenu" border="0" cellspacing="1" cellpadding="3">
		<tr style='cursor:hand' id='m10' bgcolor='#FFFFFF' onMouseover=sobre('m10') onMouseout=fuera('m10')>
			<td width="5" bgcolor="#f9f745"></td><td><a href="Ayuda.php">Caja de Herramientas</a>&nbsp;&nbsp;</td></tr>
		<tr style='cursor:hand' id='c02' bgcolor='#FFFFFF' onMouseover=sobre('c02') onMouseout=fuera('c02')>
			<td width="5" bgcolor="#93b9dd"></td><td><a href="clave.php">Cambiar Clave</a>&nbsp;&nbsp;</td></tr>
		<tr style='cursor:hand' id='c03' bgcolor='#FFFFFF' onMouseover=sobre('c03') onMouseout=fuera('c03')>
			<td width="5" bgcolor="#ff0000"></td><td><a href="mb_close.php">Salir (<?=$usu_log?>)</a>&nbsp;&nbsp;</td></tr>
		</table>
	</td>
<?	if(	$usu_prf==1 ){	?>
	<td align="left" valign="top">
		<table class="tablemenu" border="0" cellspacing="1" cellpadding="3">
		<tr style='cursor:hand' id='m04' bgcolor='#FFFFFF' onMouseover=sobre('m04') onMouseout=fuera('m04')>
			<td width="5" bgcolor="#6aa94e"></td><td><a href="empresas.php">Empresas</a>&nbsp;&nbsp;</td>
		</tr>
		<tr style='cursor:hand' id='m05' bgcolor='#FFFFFF' onMouseover=sobre('m05') onMouseout=fuera('m05')>
			<td width="5" bgcolor="#6aa94e"></td><td><a href="evaluadores.php">Asesores Locales</a>&nbsp;&nbsp;</td>
		</tr>
		<tr style='cursor:hand' id='c01' bgcolor='#FFFFFF' onMouseover=sobre('c01') onMouseout=fuera('c01')>
			<td width="5" bgcolor="#6aa94e"></td><td><a href="usuarios.php">Administradores</a></td>
		</tr>
		</table>
	</td>
	<td align="left" valign="top">
		<table class="tablemenu" border="0" cellspacing="1" cellpadding="3">
		<tr style='cursor:hand' id='m06' bgcolor='#FFFFFF' onMouseover=sobre('m06') onMouseout=fuera('m06')>
			<td width="5" bgcolor="#6aa94e"></td><td><a href="balotario.php">Preguntas por Empresa</a>&nbsp;&nbsp;</td></tr>
		<tr style='cursor:hand' id='m03' bgcolor='#FFFFFF' onMouseover=sobre('m03') onMouseout=fuera('m03')>
			<td width="5" bgcolor="#6aa94e"></td><td><a href="criterios.php">Criterios de la Norma</a>&nbsp;&nbsp;</td></tr>
		<tr style='cursor:hand' id='m02' bgcolor='#FFFFFF' onMouseover=sobre('m02') onMouseout=fuera('m02')>
			<td width="5" bgcolor="#6aa94e"></td><td><a href="calificaciones.php">Calificaciones</a>&nbsp;&nbsp;</td>
			</tr>
		</table>
	</td>
	<td align="left" valign="top">
		<table class="tablemenu" border="0" cellspacing="1" cellpadding="3">
		<tr style='cursor:hand' id='m08' bgcolor='#FFFFFF' onMouseover=sobre('m08') onMouseout=fuera('m08')>
			<td width="5" bgcolor="#f24000"></td><td><a href="Calificar.php">Calificar Empresas</a>&nbsp;&nbsp;</td></tr>
		<tr style='cursor:hand' id='m07' bgcolor='#FFFFFF' onMouseover=sobre('m07') onMouseout=fuera('m07')>
			<td width="5" bgcolor="#f24000"></td><td><a href="Anexar.php">Adjuntar Evidencias</a>&nbsp;&nbsp;</td>
		</tr>
		<tr style='cursor:hand' id='m09' bgcolor='#FFFFFF' onMouseover=sobre('m09') onMouseout=fuera('m09')>
			<td width="5" bgcolor="#f24000"></td><td><a href=javascript:ampliar("AyudaContextual.php",800,500)>Ayuda Contextual</a>&nbsp;&nbsp;</td></tr>
		</table>
	</td>
	<td align="left" valign="top">
		<table class="tablemenu" border="0" cellspacing="1" cellpadding="3">
		<tr style='cursor:hand' id='m10' bgcolor='#FFFFFF' onMouseover=sobre('m10') onMouseout=fuera('m10')>
			<td width="5" bgcolor="#f2f5f8"></td><td><a href="Reportes.php">Reporte General</a>&nbsp;&nbsp;</td></tr>
		<tr style='cursor:hand' id='m11' bgcolor='#FFFFFF' onMouseover=sobre('m11') onMouseout=fuera('m11')>
			<td width="5" bgcolor="#f2f5f8"></td><td><a href="ReportesxEmpresa.php">Reporte por Empresa</a>&nbsp;&nbsp;</td></tr>
		<tr style='cursor:hand' id='m12' bgcolor='#FFFFFF' onMouseover=sobre('m12') onMouseout=fuera('m12')>
			<td width="5" bgcolor="#f2f5f8"></td><td></td></tr>
		</table>
	</td>
	<td align="left" valign="top">
		<table class="tablemenu" border="0" cellspacing="1" cellpadding="3">
		<tr style='cursor:hand' id='m13' bgcolor='#FFFFFF' onMouseover=sobre('m13') onMouseout=fuera('m13')>
			<td width="5" bgcolor="#5e99fb"></td><td><a href="Tareas.php">Tareas Administrativas</a>&nbsp;&nbsp;</td></tr>
		<tr style='cursor:hand' id='m14' bgcolor='#FFFFFF' onMouseover=sobre('m14') onMouseout=fuera('m14')>
			<td width="5" bgcolor="#5e99fb"></td><td><a href="TareasDisposiciones.php">Tareas Disposiciones</a>&nbsp;&nbsp;</td></tr>
		<tr style='cursor:hand' id='m15' bgcolor='#FFFFFF' onMouseover=sobre('m15') onMouseout=fuera('m15')>
			<td width="5" bgcolor="#5e99fb"></td><td></td></tr>
		</table>
	</td>
<?	}else{	?>
	<td align="left" valign="top">
		<table class="tablemenu" border="0" cellspacing="1" cellpadding="3">
		<tr style='cursor:hand' id='m05' bgcolor='#FFFFFF' onMouseover=sobre('m05') onMouseout=fuera('m05')>
			<td width="5" bgcolor="#6aa94e"></td><td><a href="evaluadores.php">Asesores Locales</a>&nbsp;&nbsp;</td>
		</tr>
		<tr style='cursor:hand' id='m04' bgcolor='#FFFFFF' onMouseover=sobre('m04') onMouseout=fuera('m04')>
			<td width="5" bgcolor="#6aa94e"></td><td></td>
		</tr>
		<tr style='cursor:hand' id='c01' bgcolor='#FFFFFF' onMouseover=sobre('c01') onMouseout=fuera('c01')>
			<td width="5" bgcolor="#6aa94e"></td><td></td>
		</tr>
		</table>
	</td>
<?	}	?>
</tr>
</table>
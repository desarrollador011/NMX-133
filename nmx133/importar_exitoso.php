<?php
	include "mb_cab2.php";
?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td><h1>IMPORTAR DATOS</h1></td></tr>
	<tr><td align="center">El archivo fue importado exitosamente.</td></tr>
	<tr><td valign="top" align="center">

<form method="post" action="importarahora.php" name="importar" enctype="multipart/form-data">
			<table class="tablelista" border="0" cellpadding="1" cellspacing="1">
			<tr><td colspan="2" height="50">&nbsp;</td></tr>
			<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Archivo :&nbsp;</font></td>
				<td bgcolor="<?=BG1_FIL_DET?>">
				<input type="file" name="fil" class="caja03"></td>
			</tr>
			<tr><td height="25" valign="top" align="center" colspan="2">
					<input name="agregar" type="submit" value="Importar" class="btn00">
					<input type="button" value="Cancelar" class="btn00" onClick="history.go(-1)">
				</td>
			</tr>
			</table>
</form>			
		</td>
	</tr>
	</table>
<?php include "mb_pie2.php" ?>
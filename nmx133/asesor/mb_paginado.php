<?php
function paginar($actual, $npag, $enlace){
	$anterior = $actual - 1;
	$posterior = $actual + 1;

	IF ($actual>1){
		$texto = "<a href=\"$enlace$anterior\">Anterior</a> ";
	}
	ELSE{
		$texto = "<b>&laquo;</b> ";
	}

	FOR ($i=1; $i < $actual; $i++){
		$texto .= "<a href=\"$enlace$i\">$i</a> ";
	}

	$texto .= "<b><u>$actual</u></b> ";

	FOR ($i=$actual+1; $i <= $npag; $i++){
		$texto .= "<a href=\"$enlace$i\">$i</a> ";
	}

	IF ($actual < $npag){
		$texto .= "<a href=\"$enlace$posterior\">Siguiente</a>";
	}
	ELSE{
		$texto .= "<b>&raquo;</b>";
	}
	RETURN $texto;
}
?>
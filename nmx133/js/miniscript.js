function verifica_form(){
	var TxtCmp = "";
	TxtCmp=document.FrmComentar("txt1").value;
	TxtCmp=TxtCmp.replace(/^\s*|\s*$/g,"");
	if (TxtCmp==""){
		alert("En campo [Debe decir] de ser llenado.");
		document.FrmComentar.txt1.focus();
		return false;
	}
	TxtCmp=document.FrmComentar("txt2").value;
	TxtCmp=TxtCmp.replace(/^\s*|\s*$/g,"");
	if (TxtCmp==""){
		alert("En campo [Justificacion] de ser llenado.");
		document.FrmComentar.txt2.focus();
		return false;
	}
	TxtCmp=document.FrmComentar("inp1").value;
	TxtCmp=TxtCmp.replace(/^\s*|\s*$/g,"");
	if (TxtCmp==""){
		alert("En campo [Nombre del promovente] de ser llenado.");
		document.FrmComentar.inp1.focus();
		return false;
	}
	TxtCmp=document.FrmComentar("inp2").value;
	TxtCmp=TxtCmp.replace(/^\s*|\s*$/g,"");
	if (TxtCmp==""){
		alert("En campo [Apellido(s) del promovente] de ser llenado.");
		document.FrmComentar.inp2.focus();
		return false;
	}
	TxtCmp=document.FrmComentar("inp3").value;
	TxtCmp=TxtCmp.replace(/^\s*|\s*$/g,"");
	if (TxtCmp==""){
		alert("En campo [Correo electronico del promovente] de ser llenado.");
		document.FrmComentar.inp3.focus();
		return false;
	}else{
		val = valida_mail(document.FrmComentar("inp3"));
		if(!val){
			alert("El [Correo electronico del promovente] no es válido")
			document.FrmComentar.inp3.focus();
			return false;
		}
	}
	TxtCmp=document.FrmComentar("inp4").value;
	TxtCmp=TxtCmp.replace(/^\s*|\s*$/g,"");
	if (TxtCmp==""){
		alert("En campo [Telefono incluyendo lada] de ser llenado.");
		document.FrmComentar.inp4.focus();
		return false;
	}
	TxtCmp=document.FrmComentar("inp5").value;
	TxtCmp=TxtCmp.replace(/^\s*|\s*$/g,"");
	if (TxtCmp==""){
		alert("En campo [Razon social de la organizacion en que labora] de ser llenado.");
		document.FrmComentar.inp5.focus();
		return false;
	}
}
function numero_veces(cadena,caracter){
	var numVeces=0;
	while (cadena.indexOf(caracter,0)!=-1){
		numVeces++;
		cadena=cadena.substr(cadena.indexOf(caracter,0)+1);
	}
	return numVeces;
} 
function reversa(cadena){
	var resultado="";
	while (cadena!=""){
		resultado=resultado.concat(cadena.substr(cadena.length-1));
		cadena=cadena.substr(0,cadena.length-2);
	}
	return resultado;
} 
function valida_mail(txtObject){
	if (txtObject.value.length!=0){
		if (es_email(txtObject))
			return true;
		else
			return false;
	}else
		return false;
} 
function es_email(txtObject){
	var cadena=txtObject.value;
	var flag=true;
	if (cadena.indexOf(" ")!=-1)
		flag=false;
	if ((numero_veces(cadena,"@")!=1) || (cadena.indexOf("@")==0) ||
		(numero_veces(cadena,".")==0) || (cadena.indexOf(".")==0) ||
		(cadena.indexOf("..")!=-1) ||
		(cadena.indexOf("@.")!=-1) || (cadena.indexOf(".@")!=-1) ||
		(reversa(cadena).indexOf(".")==0) ||
		(reversa(cadena).indexOf("@")==0))
		flag=false;
	cadena=cadena.substr(cadena.indexOf("@")+1);
	if (cadena.indexOf(".")==-1)
		flag=false;
	return flag;
}
//-------------------------------------------------------------------------------------
function checkAll(){
	with (document.FrmPreguntas){
		for (var i=0; i < elements.length; i++) {
			if (elements[i].type == 'checkbox' && elements[i].name == 'pre[]')
				 elements[i].checked = true;
		}
	}
}
function uncheckAll(){
	with (document.FrmPreguntas){
		for (var i=0; i < elements.length; i++) {
			if (elements[i].type == 'checkbox' && elements[i].name == 'pre[]')
				 elements[i].checked = false;
		}
	}
}
function select(a){
	var theForm = document.indices;    
	for (i=0; i<theForm.elements.length; i++){
		if (theForm.elements[i].name=='ind[]')            
			theForm.elements[i].checked = a;
    }
}
//-------------------------------------------------------------------------------------
function FCKeditor_OnComplete( editorInstance ){
	var oCombo = document.getElementById( 'cmbToolbars' ) ;
	oCombo.value = editorInstance.ToolbarSet.Name ;
	oCombo.style.visibility = '' ;
}
function ChangeToolbar( toolbarName,id ){
	window.location.href = window.location.pathname + "?Toolbar=" + toolbarName+"&codx="+id ;
}
//-------------------------------------------------------------------------------------
function ampliar(foto,ancho,alto){
	nuevaVentana = window.open(foto,"","height="+alto+",width="+ancho+",left=250,top=130,resizable=0,noresize=yes,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=yes")
}
//-------------------------------------------------------------------------------------
function limita(obj,maxCar) {
	var elemento = document.getElementById(obj);
	if(elemento.value.length >= maxCar){	return false;	}
	else{									return true;	}
}
//-------------------------------------------------------------------------------------
function activar(){
    if (document.getElementById('iddescripcion').style.display=='none') 
	    document.getElementById('iddescripcion').style.display='block';
    else 
    	document.getElementById('iddescripcion').style.display='none';
} 
//-------------------------------------------------------------------------------------
function mostrarOcultar() {
	if(document.publicar1.publi_tip[document.publicar1.publi_tip.selectedIndex].value == 1 ){
		document.getElementById('idpaginas').style.display='block';
		document.getElementById('ideditorial').style.display='block';
		//document.getElementById('idfecha').style.display='block';
		document.getElementById('iddescriptores').style.display='block';
		document.getElementById('iddescripcion').style.display='none';
		document.getElementById('idnota').style.display='none';
	}
	if(document.publicar1.publi_tip[document.publicar1.publi_tip.selectedIndex].value == 2 ){
		document.getElementById('idpaginas').style.display='block';
		document.getElementById('ideditorial').style.display='block';
		//document.getElementById('idfecha').style.display='none';
		document.getElementById('iddescriptores').style.display='block';
		document.getElementById('iddescripcion').style.display='none';
		document.getElementById('idnota').style.display='none';
	}
	if(document.publicar1.publi_tip[document.publicar1.publi_tip.selectedIndex].value == 3 ){
		document.getElementById('idpaginas').style.display='block';
		document.getElementById('ideditorial').style.display='block';
		//document.getElementById('idfecha').style.display='none';
		document.getElementById('iddescriptores').style.display='none';
		document.getElementById('iddescripcion').style.display='block';
		document.getElementById('idnota').style.display='none';
	}
	if(document.publicar1.publi_tip[document.publicar1.publi_tip.selectedIndex].value == 4 ){
		document.getElementById('idpaginas').style.display='none';
		document.getElementById('ideditorial').style.display='none';
		//document.getElementById('idfecha').style.display='block';
		document.getElementById('iddescriptores').style.display='none';
		document.getElementById('iddescripcion').style.display='block';
		document.getElementById('idnota').style.display='block';
	}
}
function mostrarOcultar2() {
	if(document.publicar1.publi_tip2[document.publicar1.publi_tip2.selectedIndex].value == 1 ){
		document.getElementById('idtipoadj1').style.display='block';
		document.getElementById('idtipoadj2').style.display='none';
	}
	if(document.publicar1.publi_tip2[document.publicar1.publi_tip2.selectedIndex].value == 2 ){
		document.getElementById('idtipoadj1').style.display='none';
		document.getElementById('idtipoadj2').style.display='block';
	}
}
//-----------------------------------------------------------------------------
function cambiaprop(objeto,propiedad,valor){
	var cadena="";
	cadena=objeto+'.style.'+propiedad+'='+valor;
	eval(cadena);
	return true;
}
function sobre(a){
	cambiaprop(a,"color",'"#000000"');
	cambiaprop(a,"background",'"#f0f0f0"');
}
function fuera(a){
	cambiaprop(a,"color",'"#0000ff"');
	cambiaprop(a,"background",'"#FFFFFF"');
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
	if (init==true) with (navigator){
		if ((appName=="Netscape") && (parseInt(appVersion)==4)){
			document.MM_pgW=innerWidth; 
			document.MM_pgH=innerHeight; 
			onresize=MM_reloadPage;
		}
	}
	else{
		if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) 
			location.reload();
	}
}
MM_reloadPage(true);

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
	var d=document;
    var i,j,a;
	if(d.images){
		if(!d.MM_p)
			d.MM_p=new Array();
    j=d.MM_p.length;
	a=MM_preloadImages.arguments;
	for(i=0; i<a.length; i++)
    	if (a[i].indexOf("#")!=0){
			d.MM_p[j]=new Image;
			d.MM_p[j++].src=a[i];
		}
	}
}
function MM_findObj(n, d) { //v4.01
	var p,i,x;  
	if(!d) d=document; 
	if((p=n.indexOf("?"))>0 && parent.frames.length){
	    d=parent.frames[n.substring(p+1)].document;
		n=n.substring(0,p);
	}
	if(!(x=d[n])&&d.all)
		x=d.all[n]; 
	for (i=0;!x&&i<d.forms.length;i++)
		x=d.forms[i][n];
	for(i=0;!x&&d.layers&&i<d.layers.length;i++)
		x=MM_findObj(n,d.layers[i].document);
	if(!x && d.getElementById) 
		x=d.getElementById(n); 

	return x;
}
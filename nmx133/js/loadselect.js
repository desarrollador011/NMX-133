var obXHR;
try{	obXHR=new XMLHttpRequest();
}catch(err){
   	try{	obXHR=new ActiveXObject("Msxml2.XMLHTTP");
	}catch(err){
		try{	obXHR=new ActiveXObject("Microsoft.XMLHTTP");
		}catch(err){
			obXHR=false;
		}
    }
}

function ActivarSelectSubTemas(val,campo){
	cargar('a_select_subtema.php?id='+val,campo);
}

function cargar(url,obId) {
    var obCon = document.getElementById(obId);
    obXHR.open("GET",url);
    obXHR.onreadystatechange = function(){
		if (obXHR.readyState == 4 && obXHR.status == 200){
		    obXML = obXHR.responseXML;
		    obCod = obXML.getElementsByTagName("codigo");
	    	obDes = obXML.getElementsByTagName("nombre");
		    obCon.length=obCod.length;
		    for (var i=0; i<obCod.length;i++) {
				obCon.options[i].value=obCod[i].firstChild.nodeValue;
				obCon.options[i].text=obDes[i].firstChild.nodeValue;
			}
		}
    }
    obXHR.send(null);
}
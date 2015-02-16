//------------------------------------------------------------------------------------
//								verificar si CAPLOCK esta activado
//------------------------------------------------------------------------------------
function bloq_mayus(evento) {
	codigo_tecla = evento.keyCode ? evento.keyCode : evento.which;
	codigo_tecla_shift = evento.shiftKey ? evento.shiftKey : ((codigo_tecla == 16) ? true : false);
	if(((codigo_tecla >= 65 && codigo_tecla <= 90) && !codigo_tecla_shift) || ((codigo_tecla >= 97 && codigo_tecla <= 122) && codigo_tecla_shift)) {
		document.getElementById('bloq_mayus_activado').addClassName('visto');
		document.getElementById('bloq_mayus_activado').removeClassName('oculto');
	}
	else {
		document.getElementById('bloq_mayus_activado').addClassName('oculto');
		document.getElementById('bloq_mayus_activado').removeClassName('visto');
	}
}

//------------------------------------------------------------------------------------
//								redireccionar a una pagina
//------------------------------------------------------------------------------------
function redireccionar(direccion){
	location.href = direccion;
}

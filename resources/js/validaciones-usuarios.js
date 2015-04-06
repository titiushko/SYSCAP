$(document).ready(function(){
	$('#nombres_usuario').blur(function(){
		var nombres_usuario = $(this).val();
		if(nombres_usuario == ''){
			$('#nombres_usuario').addClass('error-validacion');
		}
		else{
			$('#nombres_usuario').removeClass('error-validacion');
		}
	});
	
	$('#apellido1_usuario').blur(function(){
		var apellido1_usuario = $(this).val();
		if(apellido1_usuario == ''){
			$('#apellido1_usuario').addClass('error-validacion');
		}
		else{
			$('#apellido1_usuario').removeClass('error-validacion');
		}
	});
	
	function validar_dui_usuario(dui_usuario){
		var verify = new RegExp(/^\d{8}-\d$/ix);
		return verify.test(dui_usuario);
	}
	
	$('#dui_usuario').blur(function(){
		var dui_usuario = $(this).val();
			if(dui_usuario == ''){
			$('#dui_usuario').addClass('error-validacion');
		}
		else{
			if(validar_dui_usuario(dui_usuario)){
				$('#dui_usuario').removeClass('error-validacion');
			}
			else{
				$('#dui_usuario').addClass('error-validacion');
			}
		}
	});
	
	$('#id_profesion').blur(function(){
		var id_profesion = $(this).val();
		if(id_profesion == ''){
			$('#id_profesion').addClass('error-validacion');
		}
		else{
			$('#id_profesion').removeClass('error-validacion');
		}
	});
	
	$('#id_centro_educativo').blur(function(){
		var id_centro_educativo = $(this).val();
		if(id_centro_educativo == ''){
			$('#id_centro_educativo').addClass('error-validacion');
		}
		else{
			$('#id_centro_educativo').removeClass('error-validacion');
		}
	});
	
	$('#direccion_usuario').blur(function(){
		var direccion_usuario = $(this).val();
		if(direccion_usuario == ''){
			$('#direccion_usuario').addClass('error-validacion');
		}
		else{
			$('#direccion_usuario').removeClass('error-validacion');
		}
	});
	
	function validar_correo_electronico_usuario(correo_electronico_usuario){
		var verify = new RegExp(/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix);
		return verify.test(correo_electronico_usuario);
	}
	
	$('#correo_electronico_usuario').blur(function(){
		var correo_electronico_usuario = $(this).val();
			if(correo_electronico_usuario == ''){
			$('#correo_electronico_usuario').addClass('error-validacion');
		}
		else{
			if(validar_correo_electronico_usuario(correo_electronico_usuario)){
				$('#correo_electronico_usuario').removeClass('error-validacion');
			}
			else{
				$('#correo_electronico_usuario').addClass('error-validacion');
			}
		}
	});
	
	$('#nombre_usuario').blur(function(){
		var nombre_usuario = $(this).val();
		if(nombre_usuario == ''){
			$('#nombre_usuario').addClass('error-validacion');
		}
		else{
			$('#nombre_usuario').removeClass('error-validacion');
		}
	});
	
	$('#contrasena_usuario').blur(function(){
		var contrasena_usuario = $(this).val();
		if(contrasena_usuario == ''){
			$('#contrasena_usuario').addClass('error-validacion');
		}
		else{
			$('#contrasena_usuario').removeClass('error-validacion');
		}
	});
	
	$('#id_tipo_usuario').blur(function(){
		var id_tipo_usuario = $(this).val();
		if(id_tipo_usuario == ''){
			$('#id_tipo_usuario').addClass('error-validacion');
		}
		else{
			$('#id_tipo_usuario').removeClass('error-validacion');
		}
	});
});
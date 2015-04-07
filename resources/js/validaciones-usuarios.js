$(document).ready(function(){
	$('#nombres_usuario').blur(function(){
		if($(this).val() == ''){
			$('#nombres_usuario').addClass('error-validacion');
		}
		else{
			$('#nombres_usuario').removeClass('error-validacion');
		}
	});
	
	$('#apellido1_usuario').blur(function(){
		if($(this).val() == ''){
			$('#apellido1_usuario').addClass('error-validacion');
		}
		else{
			$('#apellido1_usuario').removeClass('error-validacion');
		}
	});
	
	function validar_dui_usuario(dui_usuario){
		var verify = new RegExp(/^\d{8}-\d$/i);
		return verify.test(dui_usuario);
	}
	
	$('#dui_usuario').blur(function(){
			if($(this).val() == ''){
			$('#dui_usuario').addClass('error-validacion');
		}
		else{
			if(validar_dui_usuario($(this).val())){
				$('#dui_usuario').removeClass('error-validacion');
			}
			else{
				$('#dui_usuario').addClass('error-validacion');
			}
		}
	});
	
	$('#id_profesion').blur(function(){
		if($(this).val() == ''){
			$('#id_profesion').addClass('error-validacion');
		}
		else{
			$('#id_profesion').removeClass('error-validacion');
		}
	});
	
	$('#nombre_centro_educativo').blur(function(){
		if($(this).val() == ''){
			$('#nombre_centro_educativo').addClass('error-validacion');
		}
		else{
			$('#nombre_centro_educativo').removeClass('error-validacion');
		}
	});
	
	$('#direccion_usuario').blur(function(){
		if($(this).val() == ''){
			$('#direccion_usuario').addClass('error-validacion');
		}
		else{
			$('#direccion_usuario').removeClass('error-validacion');
		}
	});
	
	function validar_correo_electronico_usuario(correo_electronico_usuario){
		var verify = new RegExp(/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i);
		return verify.test(correo_electronico_usuario);
	}
	
	$('#correo_electronico_usuario').blur(function(){
			if($(this).val() == ''){
			$('#correo_electronico_usuario').addClass('error-validacion');
		}
		else{
			if(validar_correo_electronico_usuario($(this).val())){
				$('#correo_electronico_usuario').removeClass('error-validacion');
			}
			else{
				$('#correo_electronico_usuario').addClass('error-validacion');
			}
		}
	});
	
	$('#nombre_usuario').blur(function(){
		if($(this).val() == ''){
			$('#nombre_usuario').addClass('error-validacion');
		}
		else{
			$('#nombre_usuario').removeClass('error-validacion');
		}
	});
	
	$('#contrasena_usuario').blur(function(){
		if($(this).val() == ''){
			$('#contrasena_usuario').addClass('error-validacion');
		}
		else{
			$('#contrasena_usuario').removeClass('error-validacion');
		}
	});
	
	$('#id_tipo_usuario').blur(function(){
		if($(this).val() == ''){
			$('#id_tipo_usuario').addClass('error-validacion');
		}
		else{
			$('#id_tipo_usuario').removeClass('error-validacion');
		}
	});
});
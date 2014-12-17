$(document).ready(function(){
	$('#nombres_usuario').blur(function(){
		var nombres_usuario = $(this).val();
		if(nombres_usuario == ''){
			$('#nombres_usuario').addClass('error_validacion');
		}
		else{
			$('#nombres_usuario').removeClass('error_validacion');
		}
	});
	
	$('#apellido1_usuario').blur(function(){
		var apellido1_usuario = $(this).val();
		if(apellido1_usuario == ''){
			$('#apellido1_usuario').addClass('error_validacion');
		}
		else{
			$('#apellido1_usuario').removeClass('error_validacion');
		}
	});
	
	$('#dui_usuario').blur(function(){
		var dui_usuario = $(this).val();
		if(dui_usuario == ''){
			$('#dui_usuario').addClass('error_validacion');
		}
		else{
			$('#dui_usuario').removeClass('error_validacion');
		}
	});
	
	$('#id_profesion').blur(function(){
		var id_profesion = $(this).val();
		if(id_profesion == ''){
			$('#id_profesion').addClass('error_validacion');
		}
		else{
			$('#id_profesion').removeClass('error_validacion');
		}
	});
	
	$('#id_centro_educativo').blur(function(){
		var id_centro_educativo = $(this).val();
		if(id_centro_educativo == ''){
			$('#id_centro_educativo').addClass('error_validacion');
		}
		else{
			$('#id_centro_educativo').removeClass('error_validacion');
		}
	});
	
	$('#direccion_usuario').blur(function(){
		var direccion_usuario = $(this).val();
		if(direccion_usuario == ''){
			$('#direccion_usuario').addClass('error_validacion');
		}
		else{
			$('#direccion_usuario').removeClass('error_validacion');
		}
	});
	
	function validar_correo_electronico_usuario(correo_electronico_usuario){
		var verify = new RegExp(/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix);
		return verify.test(correo_electronico_usuario);
	}
	
	$('#correo_electronico_usuario').blur(function(){
		var correo_electronico_usuario = $(this).val();
			if(correo_electronico_usuario == ''){
			$('#correo_electronico_usuario').addClass('error_validacion');
		}
		else{
			if(validar_correo_electronico_usuario(correo_electronico_usuario)){
				$('#correo_electronico_usuario').removeClass('error_validacion');
			}
			else{
				$('#correo_electronico_usuario').addClass('error_validacion');
			}
		}
	});
});
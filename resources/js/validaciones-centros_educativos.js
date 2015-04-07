$(document).ready(function(){
	$('#nombre_centro_educativo').blur(function(){
		if($(this).val() == ''){
			$('#nombre_centro_educativo').addClass('error-validacion');
		}
		else{
			$('#nombre_centro_educativo').removeClass('error-validacion');
		}
	});
	
	$('#id_departamento').blur(function(){
		if($(this).val() == ''){
			$('#id_departamento').addClass('error-validacion');
		}
		else{
			$('#id_departamento').removeClass('error-validacion');
		}
	});
	
	$('#id_municipio').blur(function(){
		if($(this).val() == ''){
			$('#id_municipio').addClass('error-validacion');
		}
		else{
			$('#id_municipio').removeClass('error-validacion');
		}
	});
});
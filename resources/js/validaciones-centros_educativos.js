$(document).ready(function(){
	$('#nombre_centro_educativo').blur(function(){
		var nombre_centro_educativo = $(this).val();
		if(nombre_centro_educativo == ''){
			$('#nombre_centro_educativo').addClass('error-validacion');
		}
		else{
			$('#nombre_centro_educativo').removeClass('error-validacion');
		}
	});
	
	$('#id_departamento').blur(function(){
		var id_departamento = $(this).val();
		if(id_departamento == ''){
			$('#id_departamento').addClass('error-validacion');
		}
		else{
			$('#id_departamento').removeClass('error-validacion');
		}
	});
	
	$('#id_municipio').blur(function(){
		var id_municipio = $(this).val();
		if(id_municipio == ''){
			$('#id_municipio').addClass('error-validacion');
		}
		else{
			$('#id_municipio').removeClass('error-validacion');
		}
	});
});
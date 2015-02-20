<?php
$fecha_ini = array(
	'name'		=> 'fecha_ini',
	'id'		=> 'fecha_ini',
	'maxlength'	=> '60',
	'size'		=> '20',
	'type'		=> 'date',
	'required'	=> 'required',
	'class'		=> 'form-control text-capitalize'
);
$fecha_fin = array(
	'name'		=> 'fecha_fin',
	'id'		=> 'fecha_fin',
	'maxlength'	=> '60',
	'size'		=> '20',
	'type'		=> 'date',
	'required'	=> 'required',
	'class'		=> 'form-control text-capitalize'
);
$attr = array("id" => "formulario",
              "name" => "formulario"
);

$boton_primario = array('id'    => 'boton_primario',
						'class' => 'btn btn-primary',
						'name'	=> 'boton_primario',
						'value' => 'Consultar',
);
$boton_secundario = array(
	'name'		=> 'boton_secundario',
	'id'		=> 'boton_secundario',
	'value'		=> 'Limpiar',
	'class'		=> 'btn btn-danger',
	'onclick'	=> 'redireccionar(\''.base_url().'estadisticas/consulta/10\');'
);
// Definición de formularios ocultos para enviar información a imprimir y exportar
$formulario_imprimir = array(
	'name'		=> 'formulario_imprimir',
	'id'		=> 'formulario_imprimir',
	'role'		=> 'form',
	'target'	=> '_blank'
);
$formulario_exportar = array(
	'name'		=> 'formulario_exportar',
	'id'		=> 'formulario_exportar',
	'role'		=> 'form',
	'target'	=> '_blank'
);
$campos_ocultos_formulario = array(
	'tipo_de_capacitado'	=> set_value('tipo_de_capacitado', @$campos['tipo_capacitado']),
	'codigo_departamento'	=> set_value('codigo_departamento', @$campos['id_departamento']),
	'fecha_1'				=> set_value('fecha_1', @$campos['fecha1']),
	'fecha_2'				=> set_value('fecha_2', @$campos['fecha2'])
);


?>
<?= form_open('index.php/estadisticas/imprimir/10', $formulario_imprimir, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/exportar/10', $formulario_exportar, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<? //form_open('index.php/estadisticas/consulta/10', $formulario_consultar); ?>
<?= form_open('',$attr); ?>
	<div class="row">
        <div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Tipo de Capacitado:'); ?>
				<?= form_dropdown('id_tipo_capacitados', $lista_tipo_capacitados, '', 'class="form-control" required id="id_tipo_capacitados"'); ?>
				<?= form_error('id_tipo_capacitados'); ?>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Departamento:'); ?>
				<?= form_dropdown('id_departamento', $lista_departamentos, '', 'class="form-control" required id="id_departamento"'); ?>
				<?= form_error('id_departamento'); ?>
			</div>
		</div>
        <div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Municipio:'); ?>
				<?= form_dropdown('id_municipio', $lista_municipios, '', 'class="form-control" required id="id_municipio"'); ?>
				<?= form_error('id_municipio'); ?>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Periodo:'); ?>
				<div class="row">
					<div class="col-lg-6">
						<?= form_input($fecha_ini); ?>
						<?= form_error('fecha_ini'); ?>
					</div>
					<div class="col-lg-6">
						<?= form_input($fecha_fin); ?>
						<?= form_error('fecha_fin'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<?= form_submit($boton_primario); ?>
                <?= form_reset($boton_secundario); ?>
			</div>
		</div>
	</div>
<?= form_close(); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<?= heading('Resultado', 4); ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-6">
				<div class="table-responsive" id="contenedor-tabla-princial">
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica2-1">
						<thead>
							<tr>
								<th>#</th>
								<th>Centros Educativos</th>
								<th>Autoformacion</th>
								<th>Tutorizados</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-6" id="contenedor-grafica">
				<div id="morris-bar-chart-estadistica2-1"></div>
			</div>
		</div>
	</div>
</div>
<!--
<div class="panel panel-default">
	<div class="panel-heading">
		<?= heading('Listado de Usuarios por Centro Educativo', 4); ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica2-2">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombres</th>
								<th>Apellido</th>
								<th>Apellido</th>
								<th>Tipo de Capacitado</th>
								<th>Modalidad de Capacitacion</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
//-->
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() 
	{
		$("#id_departamento").change( function()
        {
		  var respuesta = null;
		  $.ajax({
                type : 'get',
				datatype: 'json',
                url  : "<?= base_url('estadisticas/lista_municipios_departamentos')?>",
				cache:false,
                data : 
				{
					id_departamento:$("#id_departamento").val(),
					csrf_test_name:$('input[name=csrf_test_name]').val()
				},
                success: function(data)
                {
                    //console.log($('#id_tipo_capacitados').val());
                    console.log("JSON: " + json);
                },
                error: function(jqXHR, exception)
                {
					respuesta = jQuery.parseJSON(jqXHR.responseText);
					$('#id_municipio').empty();
					$.each(respuesta,function(res,item){
						$("#id_municipio").append($("<option></option>").attr("value", item.id_municipio).text(item.nombre_municipio));
					});
                }
            });		
		}).change();
	});
	
	$("#formulario").on("submit", function(e)
        {	
			var respuesta = null;
			$('#contenedor-grafica').empty();
			$("#contenedor-grafica").append($("<div></div>").attr("id", "morris-bar-chart-estadistica2-1"));

			$('#contenedor-tabla-princial').empty();
			$("#contenedor-tabla-princial").html('<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica2-1"><thead>'+
												 '<tr><th>#</th><th>Centros Educativos</th><th>Autoformacion</th><th>Tutorizados</th></tr></thead></table>');
			
			$.ajax({
                type : "get",
                url  : "<?= base_url('estadisticas/formulario')?>",
                data : {
					opcion:"10",
					id_tipo_capacitados:$('#id_tipo_capacitados').val(),
					id_departamento:$('#id_departamento').val(),
					id_municipio: $('#id_municipio').val(),
					fecha_ini:$('#fecha_ini').val(),
					fecha_fin:$('#fecha_fin').val(),
					csrf_test_name:$('input[name=csrf_test_name]').val()
				
				},
                success: function(data)
                {
                    alert("JSON: " + json);
                },
                error: function(jqXHR, exception)
                {
					respuesta = jQuery.parseJSON(jqXHR.responseText);
					console.log(respuesta);
										
					$('#data-tables-estadistica2-1').dataTable({
						searching: false,
						lengthChange: false,
						oLanguage: {
							"oPaginate": {
								"sFirst": "Primero",
								"sLast": "Ultimo",
								"sNext": ">>",
								"sPrevious": "<<"
							},
							"sInfo": "_START_/_END_ de _TOTAL_ registros",
							"sEmptyTable": "No hay resultado para esta Consulta Estadística."
						  },
						data: respuesta,
						columns: 
						[
							{data: "row_number" },
							{data: "nombre_centro_educativo" },
							{data: "autoformacion" },
							{data: "tutorizado" }
						]
					});
			     
					Morris.Bar({
						element: 'morris-bar-chart-estadistica2-1',
						data: respuesta,
						xkey: 'nombre_centro_educativo',
						ykeys: ['tutorizado', 'autoformacion'],
						labels: ['Tutorizado', 'Autoformacion']
					});

                }
			});
			
			e.preventDefault();
			return false;

		});
        /*
        $('#data-tables-estadistica2-1 tbody').on('click', 'tr', function () {
		    var name = $('td', this).eq(1).text();
            alert(name);
				//var respuesta = null;
		
			$.ajax(
			{
                type : "get",
                url  : "<?= base_url('estadisticas/formulario')?>",
                data : {
					opcion:"11",
					id_tipo_capacitados:$('#id_tipo_capacitados').val(),
					id_departamento:$('#id_departamento').val(),
					id_municipio: $('#id_municipio').val(),
					fecha_ini:$('#fecha_ini').val(),
					fecha_fin:$('#fecha_fin').val()
				},
                success: function(data)
                {
                    console.log("JSON: " + json);
                },
                error: function(jqXHR, exception)
                {
					respuesta = jQuery.parseJSON(jqXHR.responseText);
					console.log(respuesta);
					$('#data-tables-estadistica2-1').dataTable({
						searching: false,
						lengthChange: false,
						oLanguage: {
							"oPaginate": {
								"sFirst": ">",
								"sLast": "<",
								"sNext": ">>",
								"sPrevious": "<<"
							},
							"sInfo": "_START_/_END_ de _TOTAL_ registros",
							"sEmptyTable": "No hay resultado para esta Consulta Estadística."
						  },
						data: respuesta,
						columns: 
						[
							{ data : "nombres_usuario" },
							{ data : "apellido1_usuario" },
							{ data : "apellido2_usuario" },
							{ data : "tipo_capacitado" },
							{ data : "modalidad_usuario" }												
						]
					});
                }
				
			});
        */
        
</script>
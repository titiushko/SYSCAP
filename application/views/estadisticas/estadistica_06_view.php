<?php
$fecha_ini = array(
	'name'		=> 'fecha_ini',
	'id'		=> 'fecha_ini',
	'maxlength'	=> '60',
	'size'		=> '20',
	'type'		=> 'date',
	'required'	=> 'required',
	'class'		=> 'form-control'
);
$fecha_fin = array(
	'name'		=> 'fecha_fin',
	'id'		=> 'fecha_fin',
	'maxlength'	=> '60',
	'size'		=> '20',
	'type'		=> 'date',
	'required'	=> 'required',
	'class'		=> 'form-control'
);
$attr = array("id"   => "formulario",
              "name" => "formulario"
);
$boton_primario = array('id'    => 'boton_primario',
						'class' => 'btn btn-primary',
						'name'	=> 'boton_primario',
						'value' => 'Consultar',
);
?>
<?= form_open('',$attr); ?>
	<div class="row">
        <div class="col-lg-3">
			<div class="form-group">
				<?= form_label('Tipo de Capacitados:'); ?>
				<?= form_dropdown('id_tipo_capacitados', $lista_tipo_capacitados, 'Evaluacion', 'class="form-control" required id="id_tipo_capacitados"'); ?>
				<?= form_error('id_tipo_capacitado'); ?>
			</div>
		</div>
        <div class="col-lg-3">
			<div class="form-group">
				<?= form_label('Departamento:'); ?>
				<?= form_dropdown('id_departamento', $lista_departamentos, '', 'class="form-control" required id="id_departamento"'); ?>
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
				<div class="table-responsive" id="contenedor-table">
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica6-1">
						<thead>
							<tr>
								<th>#</th>
								<th>Municipio</th>
								<th>Tutorizados</th>
								<th>Autoformaci&oacute;n</th>
							</tr>
						</thead>
						<tbody id="table_data">
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-6">
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica6-1"></div></a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() 
	{
		/*
		$('#data-tables-estadistica6-1').dataTable({
			"searching": false,
			"lengthChange": false,
			"oLanguage": {
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": ">",
					"sPrevious": "<"
				},
				"sInfo": "_START_/_END_ de _TOTAL_ registros",
				"sEmptyTable": "No hay resultado para esta Consulta Estadística."
			  }
		});
		var table = $('#data-tables-estadistica6-2').dataTable({
			language:{
				url: '<?= base_url(); ?>resources/plugins/data-tables/js/spanish_language.json'
			}
		});
		*/
		
        $("#formulario").on("submit", function(e)
        {	
		//table class="table table-striped table-bordered table-hover" id="data-tables-estadistica6-1"
						
			var respuesta = null;
			var r2 = null;
			
			$.ajax(
			{
                type : "get",
                url  : "<?= base_url('estadisticas/formulario')?>",
                data : {
					opcion:"6",
					id_tipo_capacitados:$('#id_tipo_capacitados').val(),
					id_departamento:$('#id_departamento').val(),
					fecha_ini:$('#fecha_ini').val(),
					fecha_fin:$('#fecha_fin').val()
				},
                success: function(data)
                {
                    //console.log($('#id_tipo_capacitados').val());
                    console.log("JSON: " + json);
                },
                error: function(jqXHR, exception)
                {
                    //console.log("Error: " + jqXHR.responseText);
					//console.log($('#id_tipo_capacitados').val());
					respuesta = jQuery.parseJSON(jqXHR.responseText);
					r2 = jqXHR.responseText;
					//console.log(respuesta);
					$('#data-tables-estadistica6-1').dataTable
					({
						data: respuesta,
						columns: 
						[
							{data:"row_number"},
							{data:"nombre_municipio"},
							{data:"capacitados"},
							{data:"certificados"}
						]
					});
                }
			});
			//console.log("Error: " + respuesta);
			console.log(respuesta);
			Morris.Bar({
				element: 'morris-bar-chart-estadistica6-1',
				data: respuesta,
				xkey: 'nombre_municipio',
				ykeys: ['capacitados', 'certificados'],
				labels: ['Capacitados', 'Certificados'],
				hideHover: 'auto',
				resize: true
			});
			
			Morris.Bar({
				element: 'morris-bar-chart-estadistica6-2',
				data: respuesta,
				xkey: 'capacitados',
				ykeys: ['capacitados', 'certificados'],
				labels: ['Capacitados', 'Certificados'],
				hideHover: 'auto',
				resize: true
			});		
			
			e.preventDefault();
			return false;
			
		});	
	
	/*
	$(function() {
		Morris.Bar({
			element: 'morris-bar-chart-estadistica6-1',
			data: [<?= $grafica_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica6-2',
			data: [<?= $grafica_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
	});
    */
</script>
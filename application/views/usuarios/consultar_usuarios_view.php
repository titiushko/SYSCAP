<?php
$centro_educativo = array (
	'name'			=> 'centro_educativo',
	'id'			=> 'centro_educativo',
	'maxlength'		=> '60',
	'size'			=> '20',
	'value'			=> utf8(set_value('centro_educativo', @$nombre_centro_educativo)),
	'onpaste'		=> 'return false',
	'type'			=> 'text',
	'autocomplete'	=> 'off',
	'placeholder'	=> 'Buscar Centro Educativo',
	'class'			=> 'form-control'
);
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="well page-header">Modulo de Usuarios</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?= heading('Lista de Usuarios', 2); ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<?= form_label('Centro Educativo:'); ?>
								<?= form_input($centro_educativo); ?>
								<div id="resultado-centro_educativo"></div>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="data-tables-usuarios">
							<thead>
								<tr>
									<th>Usuario</th>
									<th>Nombre</th>
									<th>DUI</th>
									<th>Correo Electrónico</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($lista_usuarios as $usuario){ ?>
								<tr onclick="redireccionar('<?= base_url('usuarios/mostrar/'.$usuario->id_usuario); ?>');" style="cursor: pointer;" title="Clic para ver información de <?= utf8($this->usuarios_model->nombre_completo_usuario($usuario->id_usuario)); ?>">
									<td><?= utf8($usuario->nombre_usuario); ?></td>
									<td><?= utf8($usuario->nombre_completo_usuario); ?></td>
									<td><?= formato_dui($usuario->dui_usuario); ?></td>
									<td><?= $usuario->correo_electronico_usuario; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script>
	$(document).ready(function(){
		$('#data-tables-usuarios').dataTable({
			language:{
				url: '<?= base_url(); ?>resources/plugins/data-tables/js/spanish_language.json'
			}
		});
		$("#centro_educativo").bind('keyup focusin', function(evento){
			if(evento.which != 27){
				var v_centro_educativo = $(this).val();
				$.post('<?= base_url('index.php/ajax/lista_centros_educativos'); ?>', {nombre_centro_educativo: v_centro_educativo.length > 0 ? v_centro_educativo : '%'}, function(resultado){
					if(resultado != ''){
						$('#resultado-centro_educativo').show();
						var centros_educativos = jQuery.parseJSON(resultado);
						var clase = centros_educativos.length < 5 ? "contenedor-centro_educativo-1" : "contenedor-centro_educativo-2";
						$('#resultado-centro_educativo').empty();
						$("#resultado-centro_educativo").append($("<div></div>").attr({"class": clase}));
						$.each(centros_educativos, function(respuesta, centro_educativo){
							$("." + clase).append($("<p></p>").attr({"onclick": "redireccionar('<?= base_url('usuarios'); ?>/" + centro_educativo.id_centro_educativo + "');"}).text(centro_educativo.nombre_centro_educativo));
						});
					}
					else{
						$('#resultado-centro_educativo').hide();
					}
				});
			}
			else{
				$(this).val('');
				$('#resultado-centro_educativo').hide();
			}
		});
	});
</script>
<?php $this->session->set_userdata('uri_usuarios', uri_string()); ?>
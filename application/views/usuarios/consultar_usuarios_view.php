<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Modulo de Usuarios</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?= heading('Lista de Usuarios', 3); ?>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="data-tables-usuarios">
							<thead>
								<tr>
									<th>Usuario</th>
									<th>Nombres</th>
									<th>Apellidos</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($lista_usuarios as $usuario){ ?>
								<tr onclick="location.href='<?= base_url().'usuarios/mostrar/'.$usuario->id_usuario; ?>';" style="cursor: pointer;" title="Clic para ver información de <?= htmlentities($this->usuarios_model->nombre_completo_usuario($usuario->id_usuario), ENT_COMPAT, 'UTF-8'); ?>">
									<td><?= htmlentities($usuario->nombre_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
									<td><?= htmlentities($usuario->nombres_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
									<td><?= htmlentities($usuario->apellido1_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
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
<script src="<?= base_url(); ?>libraries/plugins/data-tables/js/data-tables.jquery.js"></script>
<script src="<?= base_url(); ?>libraries/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script>
$(document).ready(function(){
	$('#data-tables-usuarios').dataTable({
		language:{
			url: '<?= base_url(); ?>libraries/plugins/data-tables/js/spanish_language.json'
		}
	});
});
</script>
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
								<tr onclick="redireccionar('<?= base_url().'usuarios/mostrar/'.$usuario->id_usuario; ?>');" style="cursor: pointer;" title="Clic para ver información de <?= utf8($this->usuarios_model->nombre_completo_usuario($usuario->id_usuario)); ?>">
									<td><?= utf8($usuario->nombre_usuario); ?></td>
									<td><?= utf8($usuario->nombres_usuario); ?></td>
									<td><?= utf8($usuario->apellido1_usuario); ?></td>
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
<script src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script>
$(document).ready(function(){
	$('#data-tables-usuarios').dataTable({
		language:{
			url: '<?= base_url(); ?>resources/plugins/data-tables/js/spanish_language.json'
		}
	});
});
</script>
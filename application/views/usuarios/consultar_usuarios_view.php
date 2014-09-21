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
									<th colspan="2">Mantenimiento</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($lista_usuarios as $usuario){ ?>
								<tr>
									<td><?= $usuario->username; ?></td>
									<td><?= $usuario->firstname; ?></td>
									<td><?= $usuario->lastname; ?></td>
									<td class="center"><?= anchor(base_url().'usuarios/modificar/'.$usuario->id, '<span class="fa fa-pencil fa-fw"></span>', 'title="Editar a '.$usuario->username.'"'); ?></td>
									<td class="center"><?= anchor(base_url().'usuarios/eliminar/'.$usuario->id, '<span class="fa fa-trash fa-fw"></span>', 'title="Eliminar a '.$usuario->username.'"'); ?></td>
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
$(document).ready(function() {
	$('#data-tables-usuarios').dataTable();
});
</script>
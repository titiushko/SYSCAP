<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Modulo de Centros Educativos</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?= heading('Lista de Centros Educativos', 3); ?>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="data-tables-centros_educativos">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Departamento</th>
									<th>Municipio</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($lista_centros_educativos as $centro_educativo){ ?>
								<tr onclick="location.href='<?= base_url().'centros_educativos/mostrar/'.$centro_educativo->id_centro_educativo; ?>'" style="cursor: pointer;" title="Clic para ver información de <?= htmlentities($centro_educativo->nombre_centro_educativo, ENT_COMPAT, 'UTF-8'); ?>">
									<td><?= htmlentities($centro_educativo->codigo_centro_educativo, ENT_COMPAT, 'UTF-8'); ?></td>
									<td><?= htmlentities($centro_educativo->nombre_centro_educativo, ENT_COMPAT, 'UTF-8'); ?></td>
									<td><?= htmlentities($this->departamentos_model->nombre_departamento($centro_educativo->id_departamento), ENT_COMPAT, 'UTF-8'); ?></td>
									<td><?= htmlentities($this->municipios_model->nombre_municipio($centro_educativo->id_municipio), ENT_COMPAT, 'UTF-8'); ?></td>
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
	$('#data-tables-centros_educativos').dataTable({
		language:{
			url: '<?= base_url(); ?>libraries/plugins/data-tables/js/spanish_language.json'
		}
	});
});
</script>
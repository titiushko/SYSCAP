<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header">Modulo de Consultas Estadísticas</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading('Listado de Estadísticas de '.$nombre_estadistica, 3); ?>
			</div>
			<div class="panel-body">
				<?php if($this->uri->uri_string() == 'estadisticas/consulta/1'){ ?>
				<div class="row">
					<div class="col-lg-6">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica1.1">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre Modalidad</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$modalidades = 1;
									foreach($modalidades_capacitados as $modalidad_capacitado){
									?>
									<tr>
										<td><?= $modalidades; ?></td>
										<td><?= htmlentities($modalidad_capacitado->modalidad, ENT_COMPAT, 'UTF-8'); ?></td>
									</tr>
									<?php
										$modalidades++;
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica1.2">
								<thead>
									<tr>
										<th>Nombre Modalidad</th>
										<th>Participantes</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($participantes_modalidades as $participante_modalidad){
									?>
									<tr>
										<td><?= htmlentities($participante_modalidad->modalidad, ENT_COMPAT, 'UTF-8'); ?></td>
										<td><?= $participante_modalidad->participantes; ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url(); ?>sources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script src="<?= base_url(); ?>sources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script>
$(document).ready(function() {
	$('#data-tables-estadistica1.1').dataTable();
	$('#data-tables-estadistica1.2').dataTable();
});
</script>
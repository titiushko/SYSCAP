<div id="page-wrapper">
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
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="data-tables-estadisticas">
							<thead>
								<tr>
									<th>Usuario</th>
									<th>Departamento</th>
									<th>Municipio</th>
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
</div>
<script src="<?= base_url(); ?>sources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script src="<?= base_url(); ?>sources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script>
$(document).ready(function() {
	$('#data-tables-estadisticas').dataTable();
});
</script>
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
									<th>Director</th>
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
<script src="<?= base_url(); ?>libraries/plugins/data-tables/js/data-tables.jquery.js"></script>
<script src="<?= base_url(); ?>libraries/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script>
$(document).ready(function() {
	$('#data-tables-centros_educativos').dataTable();
});
</script>
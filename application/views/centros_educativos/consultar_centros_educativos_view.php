<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header">Modulo de Centros Educativos</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading('Lista de Centros Educativos', 2); ?>
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
							<tr onclick="redireccionar('<?= base_url('centros_educativos/mostrar/'.$centro_educativo->id_centro_educativo); ?>');" style="cursor: pointer;" title="Clic para ver información de <?= utf8($centro_educativo->nombre_centro_educativo); ?>">
								<td><?= utf8($centro_educativo->codigo_centro_educativo); ?></td>
								<td><?= utf8($centro_educativo->nombre_centro_educativo); ?></td>
								<td><?= utf8($this->departamentos_model->nombre_departamento($centro_educativo->id_departamento)); ?></td>
								<td><?= utf8($this->municipios_model->nombre_municipio($centro_educativo->id_municipio)); ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#data-tables-centros_educativos').dataTable({
		language:{
			url: '<?= base_url(); ?>resources/plugins/data-tables/js/spanish_language.json'
		}
	});
});
</script>
<?php $this->session->set_userdata('uri_centros_educativos', uri_string()); ?>
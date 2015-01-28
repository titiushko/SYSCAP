<script type="text/javascript">
	function datos_coordenada(longitud, latitud, coordenada){
		map.panTo(new google.maps.LatLng(longitud, latitud));
		google.maps.event.trigger(coordenada, 'click');
		map.setZoom(<?= $zoom; ?>);
	}
</script>
<?= $mapa['js']; ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header">Modulo de Mapa Estadístico</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading('Mapa de El Salvador', 2); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?= $breadcrumbs; ?>
						<?= $mapa['html']; ?>
					</div>
				</div>
				<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="data-tables-mapa">
								<thead>
									<tr>
										<th>Municipio</th>
										<th>Departamento</th>
										<th>Centro Educativo</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($coordenadas as $coordenada) { ?>
									<tr onclick="datos_coordenada(<?= $coordenada->longitud_mapa; ?>, <?= $coordenada->latitud_mapa; ?>, marker_<?= $coordenada->id_mapa; ?>);" style="cursor: pointer;">
										<td><?= utf8($coordenada->nombre_municipio); ?></td>
										<td><?= utf8($coordenada->nombre_departamento); ?></td>
										<td><?= utf8($coordenada->nombre_centro_educativo); ?></td>
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
</div>
<script src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script>
$(document).ready(function(){
	$('#data-tables-mapa').dataTable({
		language:{
			url: '<?= base_url(); ?>resources/plugins/data-tables/js/spanish_language.json'
		}
	});
});
</script>
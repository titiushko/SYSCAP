<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header">Modulo de Consultas Estadísticas</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading($nombre_estadistica, 3); ?>
			</div>
			<div class="panel-body">
				<?php
				if($this->uri->uri_string() == 'estadisticas/consulta/1'){
					$this->load->view('estadisticas/estadistica_01_view', $datos);
				}
				if($this->uri->uri_string() == 'estadisticas/consulta/2'){
					$this->load->view('estadisticas/estadistica_02_view', $datos);
				}
				
				if($habilitar_generar_reporte){
				?>
				<div class="row">
					<div class="col-lg-12 text-center">
						<a href="<?= base_url().'estadisticas/imprimir/'.$this->uri->segment(3); ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Imprimir</a>
						<a href="<?= base_url().'estadisticas/exportar/'.$this->uri->segment(3); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Exportar</a>
					</div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
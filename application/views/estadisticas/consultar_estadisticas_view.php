<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-bar-chart-o fa-fw"></i> M�dulo de Consultas Estad�sticas</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading('Estad&iacute;stica de '.$nombre_estadistica, 2); ?>
			</div>
			<div class="panel-body">
				<?php
				if(uri_string() == 'estadisticas/consulta/1'){
					$this->load->view('estadisticas/estadistica_01_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/2'){
					$this->load->view('estadisticas/estadistica_02_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/3'){
					$this->load->view('estadisticas/estadistica_03_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/4'){
					$this->load->view('estadisticas/estadistica_04_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/5'){
					$this->load->view('estadisticas/estadistica_05_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/6'){
					$this->load->view('estadisticas/estadistica_06_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/7'){
					$this->load->view('estadisticas/estadistica_07_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/8'){
					$this->load->view('estadisticas/estadistica_08_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/9'){
					$this->load->view('estadisticas/estadistica_09_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/10'){
					$this->load->view('estadisticas/estadistica_10_view', $datos);
				}
				if(uri_string() == 'estadisticas/consulta/11'){
					$this->load->view('estadisticas/estadistica_11_view', $datos);
				}
				?>
				<div class="row">
					<div class="col-lg-12 text-center">
					<?php if(@$resultado_estadistico){ ?>
						<?php if(!$this->session->userdata('dispositivo_movil')){ ?>
						<button class="btn btn-success" onclick="document.formulario_imprimir.submit();"><i class="fa fa-print"></i> Imprimir</button>
						<?php } ?>
						<button class="btn btn-success" onclick="document.formulario_exportar.submit();"><i class="fa fa-file-pdf-o"></i> Exportar</button>
					<?php } else{ ?>
						<?php if(!$this->session->userdata('dispositivo_movil')){ ?>
						<a class="btn btn-success" data-toggle="modal" href="#myModalErrorReport"><i class="fa fa-print"></i> Imprimir</a>
						<?php } ?>
						<a class="btn btn-success" data-toggle="modal" href="#myModalErrorReport"><i class="fa fa-file-pdf-o"></i> Exportar</a>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
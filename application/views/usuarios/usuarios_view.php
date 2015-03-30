<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-users fa-fw"></i> Módulo de Usuario</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php
				if($this->session->userdata('nombre_corto_rol') == 'student')
					echo heading(utf8($this->session->userdata('nombre_completo_usuario')), 2);
				else
					echo heading($operacion.' Usuario', 2);
				?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?= form_fieldset(heading('Datos Personales', 3)); ?>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label(bold('Nombres:')); ?>
										<?= utf8(@$usuario[0]->nombres_usuario); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label(bold('Apellidos:')); ?>
										<?= utf8(@$usuario[0]->apellido1_usuario); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label(bold('DUI:')); ?>
										<?= formato_dui(@$usuario[0]->dui_usuario); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label(bold('Correo Electrónico:')); ?>
										<?= @$usuario[0]->correo_electronico_usuario; ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label(bold('Profesión:')); ?>
										<?= utf8($this->profesiones_model->nombre_profesion(@$usuario[0]->id_profesion)); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label(bold('Centro Educativo:')); ?>
										<?= utf8($this->centros_educativos_model->nombre_centro_educativo(@$usuario[0]->id_centro_educativo)); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<?= form_label(bold('Dirección:')); ?>
										<?= utf8(@$usuario[0]->direccion_usuario); ?>
									</div>
								</div>
							</div>
						<?= form_fieldset_close(); ?>
						<?= form_fieldset(heading('Información de Usuario', 3)); ?>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label(bold('Nombre de Usuario:')); ?>
										<?= @$usuario[0]->nombre_usuario; ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label(bold('Tipo de Usuario:')); ?>
										<?= utf8($this->tipos_usuarios_model->nombre_tipo_usuario(@$usuario[0]->id_tipo_usuario)); ?>
									</div>
								</div>
							</div>
						<?= form_fieldset_close(); ?>
						<?= form_fieldset(heading('Información de Cursos', 3)); ?>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<?= form_label(bold('Modalidad de Capacitación:')); ?>
										<?= utf8(@$usuario[0]->modalidad_usuario); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<?= heading('Certificaciones Obtenidas', 4, 'class="text-center"'); ?>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="data-tables-certificaciones_usuario">
											<thead>
												<tr>
													<th>#</th>
													<th>Nombre de la Certificación</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$certificaciones = 1;
												foreach($lista_certificaciones_usuario as $certificacion){
												?>
												<tr>
													<td><?= $certificaciones; ?></td>
													<td><?= utf8($certificacion->nombre); ?></td>
												</tr>
												<?php
													$certificaciones++;
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-lg-6">
									<?= heading('Cursos Recibidos y Calificaciones Obtenidas', 4, 'class="text-center"'); ?>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="data-tables-calificaciones_usuario">
											<thead>
												<tr>
													<th>#</th>
													<th>Nombre del Curso</th>
													<th>Calificación</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$cursos = 1;
												foreach($lista_calificaciones_usuario as $curso){
												?>
												<tr>
													<td><?= $cursos; ?></td>
													<td><?= utf8($curso->nombre); ?></td>
													<td><?= $curso->nota; ?></td>
												</tr>
												<?php
													$cursos++;
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						<?= form_fieldset_close(); ?>
						<div class="row">
							<div class="col-lg-12 visible-desktop"><?= nbs(); ?></div>
						</div>
						<div class="row">
							<div class="col-lg-12 text-center">
								<?php if(!$this->session->userdata('dispositivo_movil')){ ?>
								<a href="<?= base_url('usuarios/imprimir/'.@$usuario[0]->id_usuario); ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Imprimir</a>
								<?php } ?>
								<a href="<?= base_url('usuarios/exportar/'.@$usuario[0]->id_usuario); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Exportar</a>
							</div>
						</div>
						<?php if($this->session->userdata('nombre_corto_rol') != 'student'){ ?>
						<div class="row">
							<div class="col-lg-12 visible-desktop"><?= nbs(); ?></div>
						</div>
						<div class="row">
							<div class="col-lg-12 text-center">
								<a href="<?= base_url('usuarios'); ?>" class="btn btn-danger">Regresar</a>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#data-tables-certificaciones_usuario').dataTable({
		"searching":		false,
		"scrollY":			"200px",
		"scrollCollapse":	true,
		"info":				false,
		"ordering":			false,
		"paging":			false,
		"oLanguage": {
			"sEmptyTable": "El usuario no tiene certificaciones."
		  }
	});
	$('#data-tables-calificaciones_usuario').dataTable({
		"searching":		false,
		"scrollY":			"200px",
		"scrollCollapse":	true,
		"info":				false,
		"ordering":			false,
		"paging":			false,
		"oLanguage": {
			"sEmptyTable": "El usuario no a recibido cursos."
		  }
	});
});
</script>
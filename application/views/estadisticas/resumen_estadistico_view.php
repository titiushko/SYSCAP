<?php
$formulario_consultar = array(
	'name'		=> 'formulario_consultar',
	'id'		=> 'formulario_consultar',
	'role'		=> 'form'
);
$departamentos = 'class="form-control" id="id_departamento"';
$municipios = 'class="form-control" id="id_municipio"';
$nombre_centro_educativo = array (
	'name'			=> 'nombre_centro_educativo',
	'id'			=> 'nombre_centro_educativo',
	'maxlength'		=> '60',
	'size'			=> '20',
	'value'			=> utf8(set_value('nombre_centro_educativo', @$campos['nombre_centro_educativo'])),
	'onpaste'		=> 'return false',
	'type'			=> 'text',
	'autocomplete'	=> 'off',
	'placeholder'	=> 'Buscar Centro Educativo',
	'class'			=> 'form-control'
);
$codigo_centro_educativo = array (
	'name'			=> 'id_centro_educativo',
	'id'			=> 'id_centro_educativo',
	'value'			=> set_value('id_centro_educativo', @$campos['id_centro_educativo']),
	'type'			=> 'hidden'
);
$lista_tipo_capacitados =  array(
	''				=> '',
	'capacitado'	=> 'Capacitados',
	'certificado'	=> 'Certificados'
);
$lista_modalidades_capacitaciones =  array(
	''				=> '',
	'tutorizado'	=> 'Tutorizados',
	'autoformacion'	=> 'Autoformaci&oacute;n'
);
$grado_digital = array(
	'name'			=> 'grado_digital',
	'id'			=> 'grado_digital',
	'maxlength'		=> '60',
	'size'			=> '20',
	'value'			=> set_value('grado_digital', @$campos['grado_digital']),
	'type'			=> 'number',
	'min'			=> '1',
	'max'			=> '4',
	'autocomplete'	=> 'off',
	'class'			=> 'form-control'
);
$fecha = array(
	'name'			=> '',
	'id'			=> '',
	'maxlength'		=> '60',
	'size'			=> '20',
	'value'			=> '',
	'type'			=> 'date',
	'autocomplete'	=> 'off',
	'class'			=> 'form-control'
);
$sexo_usuario = array(
	'name'			=> 'sexo_usuario',
	'id'			=> '',
	'value'			=> '',
	'checked'		=> FALSE,
	'autocomplete'	=> 'off'
);
$boton_primario = array(
	'name'		=> 'boton_primario',
	'id'		=> 'boton_primario',
	'value'		=> 'true',
	'type'		=> 'submit',
	'content'	=> '<i class="fa fa-filter"></i> Consultar',
	'class'		=> 'btn btn-primary'
);
$boton_secundario = array(
	'name'		=> 'boton_secundario',
	'id'		=> 'boton_secundario',
	'value'		=> 'true',
	'type'		=> 'reset',
	'content'	=> '<i class="fa fa-eraser"></i> Limpiar',
	'class'		=> 'btn btn-danger',
	'onclick'	=> 'redireccionar(\''.base_url().'resumen_estadistico\');'
);
// Definición de formularios ocultos para enviar información a imprimir y exportar
$formulario_imprimir = array(
	'name'		=> 'formulario_imprimir',
	'id'		=> 'formulario_imprimir',
	'role'		=> 'form',
	'target'	=> '_blank'
);
$formulario_exportar = array(
	'name'		=> 'formulario_exportar',
	'id'		=> 'formulario_exportar',
	'role'		=> 'form',
	'target'	=> '_blank'
);
$campos_ocultos_formulario = array(
	'id_departamento_imprimir'			=> set_value('id_departamento_imprimir', @$campos['id_departamento']),
	'id_municipio_imprimir'				=> set_value('id_municipio_imprimir', @$campos['id_municipio']),
	'id_centro_educativo_imprimir'		=> set_value('id_centro_educativo_imprimir', @$campos['id_centro_educativo']),
	'tipo_capacitado_imprimir'			=> set_value('tipo_capacitado_imprimir', @$campos['tipo_capacitado']),
	'modalidad_usuario_imprimir'		=> set_value('modalidad_usuario_imprimir', @$campos['modalidad_usuario']),
	'grado_digital_imprimir'			=> set_value('grado_digital_imprimir', @$campos['grado_digital']),
	'fecha1_imprimir'					=> set_value('fecha1_imprimir', @$campos['fecha1']),
	'fecha2_imprimir'					=> set_value('fecha2_imprimir', @$campos['fecha2']),
	'sexo_usuario_imprimir'				=> set_value('sexo_usuario_imprimir', @$campos['sexo_usuario']),
	'id_tipo_usuario_imprimir'			=> set_value('tipo_usuario_imprimir', @$campos['id_tipo_usuario']),
	'id_profesion_imprimir'				=> set_value('profesion_imprimir', @$campos['id_profesion']),
	'id_nivel_estudio_imprimir'			=> set_value('nivel_estudio_imprimir', @$campos['id_nivel_estudio']),
	'busqueda_imprimir'					=> set_value('busqueda_imprimir', @$campos['busqueda'])
);
?>
<?= form_open('index.php/resumen_estadistico/imprimir', $formulario_imprimir, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/resumen_estadistico/exportar', $formulario_exportar, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-bar-chart-o fa-fw"></i> M&oacute;dulo de Consultas Estad&iacute;sticas</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading($nombre_estadistica, 2); ?>
			</div>
			<div class="panel-body">
				<?= form_open('index.php/resumen_estadistico', $formulario_consultar); ?>
				<div class="row">
					<div class="col-lg-3">
						<div class="form-group">
							<?= form_label('Departamento:'); ?>
							<?= form_dropdown('id_departamento', $lista_departamentos, set_value('id_departamento', @$campos['id_departamento']), $departamentos); ?>
							<?= form_error('id_departamento'); ?>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<?= form_label('Municipio:'); ?>
							<?= form_dropdown('id_municipio', $lista_municipios, set_value('id_municipio', @$campos['id_municipio']), $municipios); ?>
							<?= form_error('id_municipio'); ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?= form_label('Centro Educativo:'); ?>
							<?= form_input($nombre_centro_educativo); ?>
							<?= form_input($codigo_centro_educativo); ?>
							<div id="resultado-centro_educativo"></div>
							<?= form_error('id_centro_educativo'); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
						<div class="form-group">
							<?= form_label('Tipo de Capacitado:'); ?>
							<?= form_dropdown('tipo_capacitado', $lista_tipo_capacitados, set_value('tipo_capacitado', @$campos['tipo_capacitado']), 'class="form-control"'); ?>
							<?= form_error('tipo_capacitado'); ?>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<?= form_label('Modalidad de Capacitaci&oacute;n:'); ?>
							<?= form_dropdown('modalidad_usuario', $lista_modalidades_capacitaciones, set_value('modalidad_usuario', @$campos['modalidad_usuario']), 'class="form-control"'); ?>
							<?= form_error('modalidad_usuario'); ?>
						</div>
					</div>
					 <div class="col-lg-6">
						<div class="form-group">
							<?= form_label('Grado Digital:'); ?>
							<?= form_input($grado_digital); ?>
							<?= form_error('grado_digital'); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<?= form_label('Periodo:'); ?>
							<div class="row">
								<div class="col-lg-6">
									<?php $fecha['name'] = $fecha['id'] = 'fecha1'; $fecha['value'] = set_value('fecha1', @$campos['fecha1']); ?>
									<?= form_input($fecha); ?>
									<?= form_error('fecha1'); ?>
								</div>
								<div class="visible-phone visible-tablet"><?= nbs(); ?></div>
								<div class="col-lg-6">
									<?php $fecha['name'] = $fecha['id'] = 'fecha2'; $fecha['value'] = set_value('fecha2', @$campos['fecha2']); ?>
									<?= form_input($fecha); ?>
									<?= form_error('fecha2'); ?>
								</div>
							</div>
						</div>
					</div>
					 <div class="col-lg-6">
						<div class="form-group">
							<?= form_label('Sexo de Usuario:'); ?>
							<div class="row">
								<div class="col-lg-4">
									<div class="radio">
										<?php
										$sexo_usuario['id'] = 'sexo_usuario_hombre';
										$sexo_usuario['value'] = 'H';
										$sexo_usuario['checked'] = @$campos['sexo_usuario'] == 'H' ? TRUE : FALSE;
										?>
										<?= form_label(form_radio($sexo_usuario).'Hombres'); ?>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="radio">
										<?php
										$sexo_usuario['id'] = 'sexo_usuario_mujer';
										$sexo_usuario['value'] = 'M';
										$sexo_usuario['checked'] = @$campos['sexo_usuario'] == 'M' ? TRUE : FALSE;
										?>
										<?= form_label(form_radio($sexo_usuario).'Mujeres'); ?>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="radio">
										<?php
										$sexo_usuario['id'] = 'sexo_usuario_ambos';
										$sexo_usuario['value'] = '%';
										$sexo_usuario['checked'] = @$campos['sexo_usuario'] == '' || @$campos['sexo_usuario'] == '%' ? TRUE : FALSE;
										?>
										<?= form_label(form_radio($sexo_usuario).'Ambos'); ?>
									</div>
								</div>
							</div>
							<?= form_error('sexo_usuario'); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<?= form_label('Tipo de Usuario:'); ?>
							<?= form_dropdown('id_tipo_usuario', $lista_tipos_usuarios, set_value('id_tipo_usuario', @$campos['id_tipo_usuario']), 'class="form-control"'); ?>
							<?= form_error('id_tipo_usuario'); ?>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<?= form_label('Profeci&oacute;n:'); ?>
							<?= form_dropdown('id_profesion', $lista_profesiones, set_value('id_profesion', @$campos['id_profesion']), 'class="form-control"'); ?>
							<?= form_error('id_profesion'); ?>
						</div>
					</div>
					 <div class="col-lg-4">
						<div class="form-group">
							<?= form_label('Nivel de Estudio:'); ?>
							<?= form_dropdown('id_nivel_estudio', $lista_niveles_estudios, set_value('id_nivel_estudio', @$campos['id_nivel_estudio']), 'class="form-control"'); ?>
							<?= form_error('id_nivel_estudio'); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<?= form_button($boton_primario); ?>
							<?= form_button($boton_secundario); ?>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<?= heading('Resultado por '.form_dropdown('busqueda', $lista_busqueda, set_value('busqueda', @$campos['busqueda']), 'id="busqueda" class="busqueda"'), 3); ?>
					</div>
				<?= form_close(); ?>
					<div class="panel-body">
						<?php if(@$campos['busqueda'] != 'tipo_capacitado'){ ?>
						<div class="row">
							<div class="col-lg-12">
								<?= form_fieldset(heading('Tipos de Capacitados por '.$lista_busqueda[@$campos['busqueda']], 4)); ?>
									<div class="row">
										<div class="col-lg-6">
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica1">
													<thead>
														<tr>
															<th colspan="2"></th>
															<th colspan="2">Tipo de Capacitado</th>
															<th></th>
														</tr>
														<tr>
															<th>#</th>
															<th><?= $lista_busqueda[@$campos['busqueda']]; ?></th>
															<th>Capacitados</th>
															<th>Certificados</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$indice = 1;
														foreach($tipo_capacitado_x_busqueda as $resultado){
															if($resultado->nombre_campo != 'Total'){
														?>
														<tr>
															<td><?= $indice++; ?></td>
															<td><?= utf8($resultado->nombre_campo); ?></td>
															<td><?= number_format($resultado->capacitados, 0, '', ','); ?></td>
															<td><?= number_format($resultado->certificados, 0, '', ','); ?></td>
															<td><?= number_format($resultado->total, 0, '', ','); ?></td>
														</tr>
														<?php } else{ ?>
														<tfoot>
															<tr>
																<td></td>
																<td><?= bold(utf8($resultado->nombre_campo)); ?></td>
																<td><?= bold(number_format($resultado->capacitados, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->certificados, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->total, 0, '', ',')); ?></td>
															</tr>
														</tfoot>
														<?php
															}
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-lg-6">
											<?php if(!estadistica_vacia($tipo_capacitado_x_busqueda)){ ?>
											<a data-toggle="modal" href="#myModalChart1"><div id="morris-bar-chart-estadistica1-1"></div></a>
											<?php } ?>
										</div>
									</div>
								<?= form_fieldset_close(); ?>
							</div>
						</div>
						<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
						<?php } if(@$campos['busqueda'] != 'modalidad_usuario'){ ?>
						<div class="row">
							<div class="col-lg-12">
								<?= form_fieldset(heading('Modalidades de Capacitaci&oacute;n por '.$lista_busqueda[@$campos['busqueda']], 4)); ?>
									<div class="row">
										<div class="col-lg-6">
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica2">
													<thead>
														<tr>
															<th colspan="2"></th>
															<th colspan="2">Modalidad de Capacitaci&oacute;n</th>
															<th></th>
														</tr>
														<tr>
															<th>#</th>
															<th><?= $lista_busqueda[@$campos['busqueda']]; ?></th>
															<th>Tutorizados</th>
															<th>Autoformaci&oacute;n</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$indice = 1;
														foreach($modalidad_usuario_x_busqueda as $resultado){
															if($resultado->nombre_campo != 'Total'){
														?>
														<tr>
															<td><?= $indice++; ?></td>
															<td><?= utf8($resultado->nombre_campo); ?></td>
															<td><?= number_format($resultado->tutorizados, 0, '', ','); ?></td>
															<td><?= number_format($resultado->autoformacion, 0, '', ','); ?></td>
															<td><?= number_format($resultado->total, 0, '', ','); ?></td>
														</tr>
														<?php } else{ ?>
														<tfoot>
															<tr>
																<td></td>
																<td><?= bold(utf8($resultado->nombre_campo)); ?></td>
																<td><?= bold(number_format($resultado->tutorizados, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->autoformacion, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->total, 0, '', ',')); ?></td>
															</tr>
														</tfoot>
														<?php
															}
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-lg-6">
											<?php if(!estadistica_vacia($modalidad_usuario_x_busqueda)){ ?>
											<a data-toggle="modal" href="#myModalChart2"><div id="morris-bar-chart-estadistica2-1"></div></a>
											<?php } ?>
										</div>
									</div>
								<?= form_fieldset_close(); ?>
							</div>
						</div>
						<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
						<?php } if(@$campos['busqueda'] != 'grado_digital'){ ?>
						<div class="row">
							<div class="col-lg-12">
								<?= form_fieldset(heading('Grado Digital por '.$lista_busqueda[@$campos['busqueda']], 4)); ?>
									<div class="row">
										<div class="col-lg-6">
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica3">
													<thead>
														<tr>
															<th colspan="2"></th>
															<th colspan="4">Grado Digital</th>
															<th></th>
														</tr>
														<tr>
															<th>#</th>
															<th><?= $lista_busqueda[@$campos['busqueda']]; ?></th>
															<th>1</th>
															<th>2</th>
															<th>3</th>
															<th>4</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$indice = 1;
														foreach($grado_digital_x_busqueda as $resultado){
															if($resultado->nombre_campo != 'Total'){
														?>
														<tr>
															<td><?= $indice++; ?></td>
															<td><?= utf8($resultado->nombre_campo); ?></td>
															<td><?= number_format($resultado->uno, 0, '', ','); ?></td>
															<td><?= number_format($resultado->dos, 0, '', ','); ?></td>
															<td><?= number_format($resultado->tres, 0, '', ','); ?></td>
															<td><?= number_format($resultado->cuatro, 0, '', ','); ?></td>
															<td><?= number_format($resultado->total, 0, '', ','); ?></td>
														</tr>
														<?php } else{ ?>
														<tfoot>
															<tr>
																<td></td>
																<td><?= bold(utf8($resultado->nombre_campo)); ?></td>
																<td><?= bold(number_format($resultado->uno, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->dos, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->tres, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->cuatro, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->total, 0, '', ',')); ?></td>
															</tr>
														</tfoot>
														<?php
															}
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-lg-6">
											<?php if(!estadistica_vacia($grado_digital_x_busqueda)){ ?>
											<a data-toggle="modal" href="#myModalChart3"><div id="morris-bar-chart-estadistica3-1"></div></a>
											<?php } ?>
										</div>
									</div>
								<?= form_fieldset_close(); ?>
							</div>
						</div>
						<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
						<?php } if(@$campos['busqueda'] != 'sexo_usuario'){ ?>
						<div class="row">
							<div class="col-lg-12">
								<?= form_fieldset(heading('Sexo de Usuario por '.$lista_busqueda[@$campos['busqueda']], 4)); ?>
									<div class="row">
										<div class="col-lg-6">
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica4">
													<thead>
														<tr>
															<th colspan="2"></th>
															<th colspan="2">Sexo Usuario</th>
															<th></th>
														</tr>
														<tr>
															<th>#</th>
															<th><?= $lista_busqueda[@$campos['busqueda']]; ?></th>
															<th>Hombres</th>
															<th>Mujeres</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$indice = 1;
														foreach($sexo_usuario_x_busqueda as $resultado){
															if($resultado->nombre_campo != 'Total'){
														?>
														<tr>
															<td><?= $indice++; ?></td>
															<td><?= utf8($resultado->nombre_campo); ?></td>
															<td><?= number_format($resultado->hombres, 0, '', ','); ?></td>
															<td><?= number_format($resultado->mujeres, 0, '', ','); ?></td>
															<td><?= number_format($resultado->total, 0, '', ','); ?></td>
														</tr>
														<?php } else{ ?>
														<tfoot>
															<tr>
																<td></td>
																<td><?= bold(utf8($resultado->nombre_campo)); ?></td>
																<td><?= bold(number_format($resultado->hombres, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->mujeres, 0, '', ',')); ?></td>
																<td><?= bold(number_format($resultado->total, 0, '', ',')); ?></td>
															</tr>
														</tfoot>
														<?php
															}
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-lg-6">
											<?php if(!estadistica_vacia($sexo_usuario_x_busqueda)){ ?>
											<a data-toggle="modal" href="#myModalChart4"><div id="morris-bar-chart-estadistica4-1"></div></a>
											<?php } ?>
										</div>
									</div>
								<?= form_fieldset_close(); ?>
							</div>
						</div>
						<?php } ?>
						<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
						<div class="row">
							<div class="col-lg-12 text-center">
							<?php if(@$resultado_estadistico){ ?>
								<?php if(!$this->session->userdata('dispositivo_movil')){ ?>
								<a class="btn btn-success" onclick="document.formulario_imprimir.submit();"><i class="fa fa-print"></i> Imprimir</a>
								<?php } ?>
								<!--<a class="btn btn-success" onclick="document.formulario_exportar.submit();"><i class="fa fa-file-pdf-o"></i> Exportar</a>-->
							<?php } else{ ?>
								<?php if(!$this->session->userdata('dispositivo_movil')){ ?>
								<a class="btn btn-success" data-toggle="modal" href="#myModalErrorReport"><i class="fa fa-print"></i> Imprimir</a>
								<?php } ?>
								<!--<a class="btn btn-success" data-toggle="modal" href="#myModalErrorReport"><i class="fa fa-file-pdf-o"></i> Exportar</a>-->
							<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">document.formulario_consultar.id_departamento.focus();</script>
				<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
				<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#data-tables-estadistica1, #data-tables-estadistica2, #data-tables-estadistica3, #data-tables-estadistica4').dataTable({
							"searching":	false,
							"lengthChange":	false,
							"oLanguage":{
								"oPaginate":{
									"sFirst":		"<<",
									"sLast":		">>",
									"sNext":		">",
									"sPrevious":	"<"
								},
								"sInfo":		"_START_/_END_ de _TOTAL_ registros",
								"sEmptyTable":	"No hay resultado para esta Consulta Estad&iacute;stica."
							}
						});
						$("#id_departamento").bind('change focusout', function(){
							$.post('<?= base_url('index.php/ajax/lista_municipios'); ?>', {id_departamento: $("#id_departamento").val() != '' ? $("#id_departamento").val() : '%'}, function(resultado){
								$('#id_municipio').empty();
								$("#id_municipio").append($("<option value=''></option>"));
								$.each(jQuery.parseJSON(resultado), function(respuesta, municipio){
									if(municipio.id_municipio == '<?= @$campos['id_municipio']; ?>'){
										$("#id_municipio").append($("<option></option>").attr({"value":	municipio.id_municipio, "selected":	"selected"}).text(municipio.nombre_municipio));
									}
									else{
										$("#id_municipio").append($("<option></option>").attr({"value":	municipio.id_municipio}).text(municipio.nombre_municipio));
									}
								});
							});
						});
						$("#nombre_centro_educativo").bind('keyup focusin', function(evento){
							if(evento.which != 27){
								var v_nombre_centro_educativo = $(this).val();
								$.post('<?= base_url('index.php/ajax/lista_centros_educativos'); ?>', {nombre_centro_educativo: v_nombre_centro_educativo.length > 0 ? v_nombre_centro_educativo : ''}, function(resultado){
									if(resultado != ''){
										$('#resultado-centro_educativo').show();
										var centros_educativos = jQuery.parseJSON(resultado);
										var clase = centros_educativos.length < 5 ? "contenedor-centro_educativo-1" : "contenedor-centro_educativo-2";
										$('#resultado-centro_educativo').empty();
										$("#resultado-centro_educativo").append($("<div></div>").attr({"class": clase}));
										$.each(centros_educativos, function(respuesta, centro_educativo){
											$("." + clase).append($("<p></p>").attr({"onclick": "seleccionar_centro_educativo('" + centro_educativo.id_centro_educativo + "', '" + centro_educativo.nombre_centro_educativo + "');"}).text(centro_educativo.nombre_centro_educativo));
										});
									}
									else{
										$('#resultado-centro_educativo').hide();
									}
								});
							}
							else{
								$(this).val('');
								$('#id_centro_educativo').val('');
								$('#resultado-centro_educativo').hide();
							}
						});
						$("#busqueda").bind('change', function(){
							document.formulario_consultar.submit();
						});
					});
					function seleccionar_centro_educativo(codigo, nombre){
						$('#id_centro_educativo').val(codigo);
						$('#nombre_centro_educativo').val(nombre);
						$('#resultado-centro_educativo').hide();
					}
				</script>
				<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
				<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
				<script type="text/javascript">
					$(function(){
					<?php if(!estadistica_vacia($tipo_capacitado_x_busqueda) && @$campos['busqueda'] != 'tipo_capacitado'){ ?>
						Morris.Bar({
							element: 'morris-bar-chart-estadistica1-1',
							data: [<?= $tipo_capacitado_x_busqueda_json; ?>],
							xkey: 'y',
							ykeys: ['a', 'b'],
							labels: ['Capacitados', 'Certificados'],
							hideHover: 'auto',
							resize: true
						});
						Morris.Bar({
							element: 'morris-bar-chart-estadistica1-2',
							data: [<?= $tipo_capacitado_x_busqueda_json; ?>],
							xkey: 'y',
							ykeys: ['a', 'b'],
							labels: ['Capacitados', 'Certificados'],
							hideHover: 'auto',
							resize: true
						});
					<?php } if(!estadistica_vacia($modalidad_usuario_x_busqueda) && @$campos['busqueda'] != 'modalidad_usuario'){ ?>
						Morris.Bar({
							element: 'morris-bar-chart-estadistica2-1',
							data: [<?= $modalidad_usuario_x_busqueda_json; ?>],
							xkey: 'y',
							ykeys: ['a', 'b'],
							labels: ['Tutorizados', 'Autoformaci&oacute;n'],
							hideHover: 'auto',
							resize: true
						});
						Morris.Bar({
							element: 'morris-bar-chart-estadistica2-2',
							data: [<?= $modalidad_usuario_x_busqueda_json; ?>],
							xkey: 'y',
							ykeys: ['a', 'b'],
							labels: ['Tutorizados', 'Autoformaci&oacute;n'],
							hideHover: 'auto',
							resize: true
						});
					<?php } if(!estadistica_vacia($grado_digital_x_busqueda) && @$campos['busqueda'] != 'grado_digital'){ ?>
						Morris.Bar({
							element: 'morris-bar-chart-estadistica3-1',
							data: [<?= $grado_digital_x_busqueda_json; ?>],
							xkey: 'y',
							ykeys: ['a', 'b', 'c', 'd'],
							labels: ['Grado Digital 1', 'Grado Digital 2', 'Grado Digital 3', 'Grado Digital 4'],
							hideHover: 'auto',
							resize: true
						});
						Morris.Bar({
							element: 'morris-bar-chart-estadistica3-2',
							data: [<?= $grado_digital_x_busqueda_json; ?>],
							xkey: 'y',
							ykeys: ['a', 'b', 'c', 'd'],
							labels: ['Grado Digital 1', 'Grado Digital 2', 'Grado Digital 3', 'Grado Digital 4'],
							hideHover: 'auto',
							resize: true
						});
					<?php } if(!estadistica_vacia($sexo_usuario_x_busqueda) && @$campos['busqueda'] != 'sexo_usuario'){ ?>
						Morris.Bar({
							element: 'morris-bar-chart-estadistica4-1',
							data: [<?= $sexo_usuario_x_busqueda_json; ?>],
							xkey: 'y',
							ykeys: ['a', 'b'],
							labels: ['Hombres', 'Mujeres'],
							hideHover: 'auto',
							resize: true
						});
						Morris.Bar({
							element: 'morris-bar-chart-estadistica4-2',
							data: [<?= $sexo_usuario_x_busqueda_json; ?>],
							xkey: 'y',
							ykeys: ['a', 'b'],
							labels: ['Hombres', 'Mujeres'],
							hideHover: 'auto',
							resize: true
						});
					<?php } ?>
					});
				</script>
			</div>
		</div>
	</div>
</div>
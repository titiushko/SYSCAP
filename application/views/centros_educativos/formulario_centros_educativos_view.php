<?php
//Definicion de Campos de Infoemacion General de Centro educativo 
$nombre= array(
		
   'name'   => 'nombre',
   'id'      =>'nombre',
   'maxlength'	=> '60',
   'size'	=> '20',
   'value'	=> set_value('nombre',@$centro_educativo[0]->nombre),
   'class'  =>  'form-control'		 	

);

$codigo_entidad= array(

		'name'   => 'codigo_entidad',
		'id'      =>'codigo_entidad',
		'maxlength'	=> '60',
		'size'	=> '20',
		'value'	=> set_value('codigo_entidad',@$centro_educativo[0]->codigo_entidad),
		'class'  =>  'form-control'

);

$lista_departamentos= array(
	'0'=> '',
	'1' => 'San Salvador',
	'2'=> 'La libertad'		

	
);

$lista_municipios= array(
		'0'=> '',
		'1' => 'San Marcos',
		'2'=> 'Apopa'


);

//Atributos del forulario

$formulario=array(
	'name'  =>'centros_educativos',  // vector donde name es la posion
    'id'  => 'centros_educativos',
    'role' => 'form'
);

$campos_ocultos= array('row_id' => set_value('row_id', @$centro_educativo[0]->row_id)); 

?>
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
					<?= heading('Editar Centro Educativo', 3); ?>
				</div>
				<div class="panel-body">
				   <div class= "row">
				      <div class="col-lg-12">
				<?=form_open('',$formulario, $campos_ocultos); ?>
				<?=form_fieldset('Informacion General del Centro Educativo'); ?>
				<div class="row">
				    <div class= "col-lg-6">
				       <div class= "form-group">
				         <?= form_label('Nombre'); ?>
				         <?= form_input($nombre);?>
				         <?= form_error('nombre');?>
				       </div>
				    </div>
				    
				    <div class= "col-lg-6">
				       <div class= "form-group">
				         <?= form_label('Codigo'); ?>
				         <?= form_input($codigo_entidad);?>
				         <?= form_error('codigo_entidad');?>
				      </div>
				    </div>
				</div>
				
				<div class="row">
				<div class="col-lg-12">
				 <div class= "col-lg-6">
				       <div class= "form-group">
				         <?= form_label('Departamento'); ?>
				         <?= form_dropdown('depto', $lista_departamentos,set_value('depto', @$centro_educativo[0]->depto), 'class="form-control"');?>
				         <?= form_error('depto');?>
				       </div>
			
				</div>
				
				<div class= "col-lg-6">
				       <div class= "form-group">
				         <?= form_label('Municipio'); ?>
				         <?= form_dropdown('muni', $lista_municipios,set_value('muni', @$centro_educativo[0]->muni), 'class="form-control"');?>
				         <?= form_error('muni');?>
				       </div>
				
			
				</div>
				
				
				</div>>
				<?=form_fieldset_close();  ?>
			
				<?=form_close(); ?>
				      </div>
				
				    </div>
				
				</div>
			</div>
		</div>
	</div>
</div>
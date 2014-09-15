<html>
	<head>
		<title>SYSCAP</title>
		<?php echo link_tag('librerias/plugins/bootstrap/css/bootstrap.min.css'); ?>
		<?php echo link_tag('librerias/css/estilo.css'); ?>
	</head>
	<body id="formato">
		<div id="cabeza">
			<?php echo heading('SYSCAP', 1); ?>
		</div>
		<div id="cuerpo" class="container">
			<?php echo heading('LISTA DE USUARIOS', 2); ?>
			<?php echo anchor('usuarios/agregar', 'Agregar', 'title=title="Agregar Nuevo Usuario"').br(2); ?>
			<?php if(empty($usuarios)){ ?>
			<b>No hay Usuarios.</b>
			<?php } else{ ?>
			<table border="1" class="cuadricula table table-bordered table-hover">
				<thead>
					<tr>
						<th>Usuario</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th colspan="2">Mantenimiento</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($usuarios as $usuario){ ?>
					<tr>
						<td><?php echo $usuario->username; ?></td>
						<td><?php echo $usuario->firstname; ?></td>
						<td><?php echo $usuario->lastname; ?></td>
						<td><?php echo anchor('usuarios/modificar/'.$usuario->id, '<span class="icon-pencil"></span> Editar', 'title="Editar a '.$usuario->id.'"'); ?></td>
						<td><?php echo anchor('usuarios/eliminar/'.$usuario->id, '<span class="icon-trash"></span> Eliminar', 'title="Eliminar a '.$usuario->id.'"'); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
			<?php echo br().anchor('menu/', 'Volver', 'title="Volver a la Pagina de Inicio"'); ?>
		</div>
	</body>
</html>
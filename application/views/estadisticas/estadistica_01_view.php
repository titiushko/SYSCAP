<div class="row">
	<div class="col-lg-6">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre Modalidad</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$modalidades = 1;
					foreach($modalidades_capacitados as $modalidad_capacitado){
					?>
					<tr>
						<td><?= $modalidades; ?></td>
						<td><?= htmlentities($modalidad_capacitado->modalidad, ENT_COMPAT, 'UTF-8'); ?></td>
					</tr>
					<?php
					$modalidades++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Nombre Modalidad</th>
						<th>Participantes</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($participantes_modalidades as $participante_modalidad){ ?>
					<tr>
						<td><?= htmlentities($participante_modalidad->modalidad, ENT_COMPAT, 'UTF-8'); ?></td>
						<td><?= $participante_modalidad->participantes; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
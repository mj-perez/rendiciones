<!DOCTYPE html>
<html>

<body class="hold-transition fondo">
	<div class="wrapper">
		 <section class="content-header">
		 	<a href="http://localhost/rendiciones/menu"><button type="button" class="btn btn-primary"><i class='fa fa-reply'></i></button></a>
		 	<br><br>
		 	<h1>
		       	Solicitudes de Fondos
		        <!-- <small>Control panel</small> -->
		    </h1>
		 </section>
		 <section class="content">
		 	<div class="row">
		 		<div class="col-md-4">
		 			<a href="http://localhost/rendiciones/rendiciones/rendicion"><button class="btn btn-primary">INGRESAR RENDICIÓN DE FONDOS</button></a>
		 		</div>
		 		<br><br>
		 	</div>
		 	<div class="row">
		 		<div class="col-md-12">
		 			<div class="box box-primary" >
		 				<table class="table table-bordered" id="table4">
				  			<thead >
					  			<tr>
					  				<th>Número Solicitud</th>
					  				<th>Empresa</th>
					  				<th>Centro Costo</th>
					  				<th>Solicitante</th>
					  				<th>Supervisor Responsable</th>
					  				<th>Rut Responsable</th>
					  				<th>Fecha Solicitud</th>
					  				<th>Motivo</th>
					  				<th>Opciones</th>
					  			</tr>
					  		</thead>
					  		<?php
					  			foreach ($solicitudes as $s) {
					  				echo "<tr>
					  					<td>".$s["id_fondo"]."</td>
					  					<td>".$s["egrupo"]."</td>
					  					<td>".$s["cliente"]."</td>
					  					<td>".$s["solicitante"]."</td>
					  					<td>".$s["responsable"]."</td>
					  					<td>".$s["rut"]."</td>
					  					<td>".$s["fecha_registro"]."</td>
					  					<td>".$s["motivo"]."</td>
					  					<td><button class='btn-sm btn-primary' type='button' data-toggle='modal'
					  					data-target='#modal-detallerendir' onclick='detallerendir(".$s["id_fondo"].")'>Ver Detalle</button><br><br>
					  					<form action='http://localhost/rendiciones/rendiciones/rendicion' method='POST'>
					  					<input type='hidden' value='".$s["id_fondo"]."' name='id_fondo' >
					  					<button class='btn-sm btn-warning' type='submit'>Rendir</button>
					  					</form>
					  					</td>
					  				</tr>";
					  			}
					  		?>
				    </div>	
		 		</div>
		 	</div>
		 </section>
	</div>
	<div class="modal fade" id="modal-detallerendir" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content" id="detallerendir">
			</div>
		</div>
	</div>
</body>

<script type="text/javascript">
	$(document).ready(function(){

	    $('#table4').DataTable({
	    	fixedHeader: true,
	    	searching:false,
	    	ordering : true,
	    	order: [[0, 'desc']]
	    });

	});

	function detallerendir(id){
		var idsolicitud=id;
		$.ajax({
			url: "http://localhost/rendiciones/solicitudes/detallesolicitud",
			data:"id="+idsolicitud,
			type:"POST",
			success: function(data){
				$("#detallerendir").html(data);
			}
		});
	}


</script>
</html>
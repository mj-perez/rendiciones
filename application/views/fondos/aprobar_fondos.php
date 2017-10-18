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
				<form action="http://localhost/rendiciones/solicitudes/buscarsolicitud" method="POST">
					<div class="col-md-12">
						<div class="box box-primary ">
							<div class="box-header with-border btn-primary">
					           	<h3 class="box-title titulo">Búsquedas</h3>
					       </div>
			    			<div class="box-body">
			    				<div class="col-md-2">
			    					<label>Solicitante</label>
			    					<select id="lb_apsolicitante" name="lb_apsolicitante" class="form-control">
			    						<option value="">Seleccione</option>
			    						<?php
			    							foreach($usuarios as $u){
			    							    echo "<option value='".$u["id_usuario"]."'>".strtoupper($u["nombre"])."</option>";
			    							}

			    						?>
			    					</select>
			    				</div>
			    				<div class="col-md-2">
			    					<label>Empresa</label>
			    					<select id="lb_apempresa" name="lb_apempresa" class="form-control">
			    						<option value="">Seleccione</option>
			    						<?php
			    							foreach($empresas as $u){
			    							    echo "<option value='".$u["id_egrupo"]."'>".strtoupper($u["egrupo"])."</option>";
			    							}

			    						?>
			    					</select>
			    				</div>
			    				<div class="col-md-2">
			    					<label>Centro Costo</label>
			    					<select id="lb_apcliente" name="lb_apcliente" class="form-control">
			    						<option value="">Seleccione</option>
			    						<?php
			    							foreach($clientes as $u){
			    							    echo "<option value='".$u["id_cliente"]."'>".strtoupper($u["cliente"])."</option>";
			    							}

			    						?>
			    					</select>
			    				</div>
			    				<div class="col-md-2">
			    					<label>Estado</label>
			    					<select id="lb_apestado" name="lb_apestado" class="form-control">
			    						<option value="">Seleccione</option>
			    						<?php
			    							foreach($estados as $u){
			    							    echo "<option value='".$u["id_estado"]."'>".strtoupper($u["estado"])."</option>";
			    							}

			    						?>
			    					</select>
			    				</div>
			    				<div class="col-md-2">
			    					<label>Fecha Solicitud</label>
			    					<input id="txt_apfechasol" name="txt_apfechasol" type="text" class="form-control blanco" onclick="calendar('txt_apfechasol');" readonly>
			    				</div>
			    				<div class="col-md-2">
			    					<br>
			    					<button class="btn btn-primary" type="submit" >Buscar</button>
			    				</div>
			    			</div>
			    		</div>
					</div>
				</form>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
						<div class="box box-primary ">
							<div class="box-header with-border btn-primary">
					           	<h3 class="box-title titulo">Estados</h3>
					       </div>
			    			<div class="box-body">
			    				<?php
			    					foreach($estados as $e){
			    					echo "<div class='col-md-2' >
			    							<div class='color-palette-set'>
			    								<div class='".$e["color"]."'>
			    									<label>".$e["estado"]."</label>
			    								</div>
			    							</div>		
			    						</div>";
			    					}
			    				?>
			    			</div>
			    		</div>
					</div>
			</div>
			<br>
		  	<div class="row">
		  		<div class="col-md-12">
		  			<div class="box box-primary ">
				  		<table class="table table-bordered" id="table3">
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
					  				<th>Detalle Solicitud</th>
					  				<th>Opciones</th>
					  			</tr>
					  		</thead>
					  		<?php
					  			foreach($solicitudes as $s){
					  				echo "<tr>
					  					<td class=''>".$s["id_fondo"]."</td>
					  					<td>".$s["egrupo"]."</td>
					  					<td>".$s["cliente"]."</td>
					  					<td>".$s["solicitante"]."</td>
					  					<td>".$s["responsable"]."</td>
					  					<td>".$s["rut"]."</td>
					  					<td>".$s["fecha_registro"]."</td>
					  					<td>".$s["motivo"]."</td>
					  					<td><button class='btn-sm btn-primary' type='button' data-toggle='modal'
					  					data-target='#modal-detalle' onclick='detalle(".$s["id_fondo"].")'>Ver Detalle</button></td>
					  					<td><button class='btn-sm btn-success' onclick='estado(".$s["id_fondo"].",1)'>Aprobar</button><br><br><button class='btn-sm btn-danger' onclick='estado(".$s["id_fondo"].",2);'>Rechazar</button></td>
					  				</tr>";
					  			}
					  		?>
				  		</table>
				  	</div>
			  	</div>
		    </div>
		</section>
	</div>
	<div class="modal fade" id="modal-detalle" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content" id="detalle">
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){

	    $('#table3').DataTable({
	    	fixedHeader: true,
	    	searching:false,
	    	ordering : true,
	    	order: [[0, 'desc']]
	    });

	});

	function estado(id,est){
		var estado=est;
		var idsolicitud=id;
		$.ajax({
			url: "http://localhost/rendiciones/solicitudes/aprobacion",
			data:"id="+idsolicitud+"&estado="+est,
			type:"POST",
			success: function(data){
				alert(data);
			}
		});
	}

	function detalle(id){
		var idsolicitud=id;
		$.ajax({
			url: "http://localhost/rendiciones/solicitudes/detallesolicitud",
			data:"id="+idsolicitud,
			type:"POST",
			success: function(data){
				$("#detalle").html(data);
			}
		});
	}
</script>
</html>
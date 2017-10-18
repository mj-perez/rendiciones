<!DOCTYPE html>
<html>

<body class="hold-transition fondo">

	<div class="wrapper">
		 <section class="content-header">
		 	<a href="http://localhost/rendiciones/menu"><button type="button" class="btn btn-primary"><i class='fa fa-reply'></i></button></a>
		 	<br><br>
		 	<h1>
		       	Rendiciones 
		        <!-- <small>Control panel</small> -->
		    </h1>
		 </section>
		 <section class="content">
		 	<div class="row">
		 		<div class="col-md-12">
		 			<div class="box box-primary " >
		 				<div class="box-header with-border">
				              <h3 class="box-title">Rendiciones por aprobar</h3>
				        </div>
				        <div class="box-body no-padding" >
				             <table class="table table-bordered" id="#table2">
				             	<thead>
				             		<th>Número Rendición</th>
				             		<th>Empresa</th>
				             		<th>Tipo Rendición</th>
				             		<th>Centro Costo</th>
				             		<th>Solicitante</th>
				             		<th>Fecha Rendición</th>
				             		<th>Detalle</th>
				             		<th></th>
				             	</thead>
				             	<?php
				             		foreach ($rendiciones as $r) {
				             			echo "<tr>";
				             			echo "<td>".$r["id_rendicion"]."</td>";
				             			echo "<td>".$r["egrupo"]."</td>";
				             			echo "<td>".$r["tipo_rendicion"]."</td>";
				             			echo "<td>".$r["cliente"]."</td>";
				             			echo "<td>".$r["solicitante"]."</td>";
				             			echo "<td>".$r["fecha_registro"]."</td>";
				             			echo "<td><button type='button' data-toggle='modal' data-target='.bd-example-modal-lg' class='btn btn-primary'  onclick='detalle(".$r["id_rendicion"].")' role='button'><i class='glyphicon glyphicon-eye-open'></i>&nbsp;Ver Detalle</a></td>";
				             			echo "<td><button class='btn btn-success'><i class='glyphicon glyphicon-ok'></i>&nbsp;Aprobar</button><br><br>
				             			<button class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i>&nbsp;Desaprobar</button>
				             			</td>";
				             			echo "</tr>";
				             		}
				             	?>
				        	</table>
				        </div>
		 			</div>
		 		</div>
		 	</div>
		 </section>
	</div>
	<div class=" modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
      <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Detalle Rendición</h4>
            </div>
            <div class="modal-body">
                    
                <div id="rendicion" class="detalle" >
                </div>
            </div>
          <div class="modal-footer">
          <!-- <button type="submit" name="bt_exportar" id="bt_exportar" class="button" style="background-color: green;" onclick="document.getElementById('formu').submit();">Exportar</button> -->
          <a href="#" data-dismiss="modal" class="button">Aceptar</a>
          </div>
      </div>
    </div>
</div>

</body>
<script type="text/javascript">
	$(document).ready(function () {
    $('#tabla2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'autoWidth'   : true,
      "order": [["0", "desc"]]
    });

  });
</script>
<script type="text/javascript">
	function detalle(id_rendicion){
		var id=id_rendicion;
		$.ajax({
			url: "http://localhost/rendiciones/rendiciones/detallerendicion",
			type: "POST",
			data: "idrendicion="+id,
			success: function(data){
				$("#rendicion").html(data);
			}
		});
	}
</script>
</html>
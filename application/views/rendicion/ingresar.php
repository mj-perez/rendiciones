<!DOCTYPE html>
<html>

<script src="<?php echo base_url("assets/js/validCampoFranz.js");?>"></script>
<body class="hold-transition fondo">

<div class="wrapper">
	<form id="form1" method="POST" action="http://localhost/rendiciones/rendiciones/agregarrendicion" enctype="multipart/form-data">

		    <section class="content-header">
		    	<a href="http://localhost/rendiciones/rendiciones/solicitudes"><button type="button" class="btn btn-primary"><i class='fa fa-reply'></i></button></a>
		    	<br><br>
		      <h1>
		        Rendición de Fondos
		        <?php
		        	if(isset($fondo)){
		        		echo " - Solicitud N°".$fondo["id_fondo"];
		        	} else {
		        		echo " Solicitados";
		        	}
		        ?>
		        <!-- <small>Control panel</small> -->
		      </h1>
		    </section>
		    <section class="content">
		    	<div class="row">
		    		<div class="col-md-4">
		    			<div class="box box-primary" >
				            <div class="box-header with-border">
				              <h3 class="box-title">Datos Solicitante</h3>
				            </div>
				             <div class="box-body" >
				             	<?php
				                 	if(isset($fondo)){
				             		echo "<input type='hidden' name='txt_fondo' id='txt_fondo' value='".$fondo["id_fondo"]."' >";
				             		}
				             	?>
				                <div class="form-group">
				                  	<label >Nombre:&nbsp;</label>&nbsp;
				                  	<label><?php echo $solicitante["nombre"]; ?></label>
				                </div>
				                <?php
				                 	if(isset($fondo)){
				                 		echo "<div class='form-group'>
				                 			<label >Responsable:&nbsp;</label>&nbsp;
				                  			<label>".$fondo["responsable"]."</label>
				                 		</div>";
				                 		echo "<div class='form-group'>
				                 			<label >Rut Responsable:&nbsp;</label>&nbsp;
				                  			<label>".$fondo["rut"]."</label>
				                 		</div>";
				                 	}
				                 ?>
				                <div class="form-group">
				                  	<label for="exampleInputFile">N° Cuenta a depositar:&nbsp;</label>
				                 	<?php
				                 		if(isset($fondo)){
				                 			echo "<input type='text' name='txt_ncuenta' id='txt_ncuenta' class='form-control blanco' value='".$fondo["ncuenta"]."' readonly>";
				                 		} else {
				                 			if($cuenta!=0){
					                 			echo "<input type='text' name='txt_ncuenta' id='txt_ncuenta' class='form-control blanco' value='".$cuenta."' readonly>";
					                 		} else {
					                 			echo "<input type='text' name='txt_ncuenta' id='txt_ncuenta' class='form-control'>";
					                 		}
				                 		}
				                 			
				                 	?>
				                </div>
				                <div class="form-group">
				                  	<label for="exampleInputFile">Banco:&nbsp;</label>
				                  	<?php
				                 		if(isset($fondo)){
				                 			echo "<select name='lb_banco' id='lb_banco' class='form-control blanco' readonly>";
					                 				foreach($bancos as $b){
					                 					if($fondo["id_banco"]==$b["id_banco"]){
					                 						echo "<option value='".$b["id_banco"]."' selected>".strtoupper($b["banco"])."</option>";
					                 					} 
					                 				}
					                 		echo" </select>";
				                 		} else {
				                 			if($banco!=0){
					                 			echo "<select name='lb_banco' id='lb_banco' class='form-control blanco' readonly>";
					                 				foreach($bancos as $b){
					                 					if($banco==$b["id_banco"]){
					                 						echo "<option value='".$b["id_banco"]."' selected>".strtoupper($b["banco"])."</option>";
					                 					} 
					                 				}
					                 		echo" </select>";
					                 		} else {
					                 			echo "<select name='lb_banco' id='lb_banco' class='form-control'>
					                 				<option value=''>Seleccione</option>";
					                 				foreach($bancos as $b){
					                 					echo "<option value='".$b["id_banco"]."'>".strtoupper($b["banco"])."</option>";
					                 				}
					                 			echo" </select>";
					                 		}
				                 		}
				                 	?>
				                </div>
				            </div>
			          	</div>
		    		</div>
		    		<div class="col-md-4">
		    			<div class="box box-primary " >
				            <div class="box-header with-border">
				              <h3 class="box-title">Datos de Rendición</h3>
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->

				              <div class="box-body" >
				                <div class="form-group">
				                  <label >Empresa: </label>
				                  <?php
				                  	if(isset($fondo)){
				                 		echo "<select id='lb_empresa' name='lb_empresa' class='form-control blanco' readonly>";
				                  			foreach($empresas as $em){
				                  				if($fondo["id_egrupo"]==$em["id_egrupo"]){
					                 				echo "<option value='".$em["id_egrupo"]."' selected>".strtoupper($em["egrupo"])."</option>";
					                 			}
				                   			}
				                  		echo "</select>";
				                 	} else {
				                 		echo "<select id='lb_empresa' name='lb_empresa' class='form-control'>
				                  			<option value=''>Seleccione</option>";
				                  			foreach($empresas as $em){
				                   				echo "<option value='".$em["id_egrupo"]."'>".strtoupper($em["egrupo"])."</option>";
				                   			}
				                  		echo "</select>";
				                 	}
				                  ?>
				                </div>
				                <div class="form-group">
				                  <label >Monto Entregado: </label>
				                  <?php
				                  	if(isset($fondo)){
				                 		echo "<input type='text' name='txt_monto' id='txt_monto' class='form-control blanco' value='".str_replace(".","",$fondo["monto"])."' readonly>";
				                 	} else {
				                 		echo "<input type='text' name='txt_monto' id='txt_monto' class='form-control ' >";
				                 	}
				                 	?>
				                </div>
				                <div class="form-group">
				                  <label >Centro Costo: </label>
				                  <?php
				                  	if(isset($fondo)){
				                 		echo "<select id='lb_cliente' name='lb_cliente' class='form-control blanco' readonly>";
				                  			foreach($clientes as $c){
				                  				if($fondo["id_cliente"]==$c["id_cliente"]){
					                 				echo "<option value='".$c["id_cliente"]."'>".strtoupper($c["cliente"])."</option>";
					                 			}
				                   			}
				                  		echo "</select>";
				                 	} else {
				                 		echo "<select id='lb_cliente' name='lb_cliente' class='form-control'>
					                  	<option value=''>Seleccione</option>";
					                  		foreach($clientes as $c){
					                   			echo "<option value='".$c["id_cliente"]."'>".strtoupper($c["cliente"])."</option>";
					                   		}
					                   	echo "</select>";
				                 	}
				                 	?>
				                </div>
				                <div class="form-group">
				                  <label >Tipo de Rendición: </label>
				                  <select id="lb_tipo" name="lb_tipo" class="form-control">
				                  	<option value="">Seleccione</option>
				                   <?php
				                   		foreach($tipos as $t){
				                   			echo "<option value='".$t["id_tipo_rendicion"]."'>".strtoupper($t["tipo_rendicion"])."</option>";
				                   		}
				                   ?>
				                  </select>
				                </div>
				                
				              </div>


				          </div>
		    		</div>
		    		<div class="col-md-4">
		    			<div class="box box-primary " >
				            <div class="box-header with-border">
				              <h3 class="box-title">Resumen</h3>
				            </div>
				            <div class="box-body" >
					            <div class="form-group">
					            	<label>Monto Entregado: </label>
					            	<?php
				                  	if(isset($fondo)){
				                 		echo "<input type='text' name='txt_monentrega' id='txt_monentrega' class='form-control blanco' value='".str_replace(".","",$fondo["monto"])."' readonly>";
				                 	} else {
				                 		echo "<input type='text' name='txt_monentrega' id='txt_monentrega' class='form-control ' >";
				                 	}
				                 	?>
					            </div> 
					            <div class="form-group">
					            	<label>Total General Rendido: </label>
					            	<input type="text" class="form-control blanco" id="txt_totalrendido" name="txt_totalrendido" readonly>
					            </div>  
					            <div class="form-group">
					            	<label>Saldo Empresa: </label>
					            	<input type="text" class="form-control blanco" id="txt_saldo" name="txt_saldo" readonly>
					            </div>
					        </div>            
				        </div>
		    		</div>
		    	</div>   	
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="box box-primary" >
				            <div class="box-header with-border">
				              <h3 class="box-title">Detalle de Gastos</h3>
				            </div>             
				            <div class="box-body no-padding" >
				            	<input value="1" type="hidden" id="ngastos" name="ngastos">
				            	<table class="table table-bordered" id="table1">
				            		<thead>
				            		<tr>
				            			<th>Concepto</th>
				            			<th>N° Documento</th>
				            			<th>Fecha</th>
				            			<th>Monto($)</th>
				            			<th>Detalle</th>
				            		</tr>
				            		</thead>
				            			<?php
					            			echo "<tr id='gastos' style='display: none;'>";
					            			echo "<td><select class='form-control' id='lb_tipogasto-0' name='lb_tipogasto-0' onblur='calculogasto()' >
					            				<option value=''>Seleccione</option>";
					            				foreach($gastos as $g){
							             		 	echo "<option value='".$g["id_tipo_gasto"]."' >".$g["tipo_gasto"]."</option>";
					             		 		}
					            			echo "</select></td>";
					            			echo "<td><input class='form-control' type='text' id='txt_ndoc-0' name='txt_ndoc-0' value='' onblur='calculogasto()'></td>";
					            			echo "<td><input class='form-control blanco' type='text' id='txt_fecha-0' name='txt_fecha-0' value='' onblur='calculogasto()' onclick='calendar(txt_fecha-0)' readonly></td>";
					            			echo "<td><input class='form-control' type='text' id='txt_monto-0' name='txt_monto-0' onblur='calculogasto()' value=''></td>";
					            			echo "<td><textarea class='form-control' id='txt_detalle-0' name='txt_detalle-0' onblur='calculogasto()'></textarea></td>";
					            			echo "</tr>"; 
					            		?>
				            	</table>
				            	<button id="btn_dup" type='button' class="btn btn-primary"><i class='glyphicon glyphicon-plus'></i>&nbsp;AGREGAR GASTO</button>
				            	<button id="btn_eli" class="btn btn-primary" style="display: none;" type='button'><i class='glyphicon glyphicon-minus'></i>&nbsp;ELIMINAR GASTO</button>
				            </div>  
				        </div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		
		    		<div class="col-md-12">
		    			<div class="box box-primary " >
				            <div class="box-header with-border">
				              <h3 class="box-title">Total de Gastos</h3>
				            </div>
				             <div class="box-body no-padding" >
				             	<table class="table table-bordered">
				             		<tr><th>Gasto</th><th>Monto($)</th><th>Gasto</th><th>Monto($)</th></tr>
				             		<input type="hidden" name="ntipogastos" id="ntipogastos" value="<?php echo count($gastos);?>"/>
				             		<?php 
				             		 $ind=1;
				             		 	for($i=0; $i<count($gastos); $i++){
				             		 		$g=$gastos[$i];
				             		 		if($ind==1){
				             		 			echo "<tr>";
				             		 		}
				             		 		if($ind==3){
				             		 			echo "</tr>";
				             		 			$ind=1;
				             		 		}
					             			echo "<td>".$g["tipo_gasto"]."</td>";
					             			echo "<td>
					             					<input type='text' id='txt_montogasto".$g["id_tipo_gasto"]."' name='txt_montogasto".$g["id_tipo_gasto"]."' class='blanco form-control borde' value='0' readonly>
					             				</td>";
					             			$ind+=1;
					             			
				             		 	}
				             		?>
				             		<tr>
				             			<th colspan="3">Subtotal($)</th>
				             			<td><input type='text' id='txt_subtotal' name='txt_subtotal' class='blanco form-control borde' value='0' readonly></td>
				             		</tr>
				             	</table>
				             </div>	              
				        </div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="box-primary">
		    				<div class="box-body">
		    					<button class="btn btn-primary" type="button" onclick="ingresar();">INGRESAR RENDICIÓN</button>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </section>
		
	</form>
</div>

</body>
<script type="text/javascript">

	$("#btn_dup").click(function(){
		$("#gastos").clone(true,true).appendTo("#table1");
		var dup=parseInt($("#ngastos").val());
		if(dup>0){
			$("#table1").find("#gastos").attr('id','gastos-'+dup).removeAttr("style");
			$("#table1").find("#gastos-"+dup).find("#lb_tipogasto-0").attr('id','lb_tipogasto-'+dup).attr('name','lb_tipogasto-'+dup).attr('onblur','calculogasto()').val("");
			$("#table1").find("#gastos-"+dup).find("#txt_ndoc-0").attr('id','txt_ndoc-'+dup).attr('name','txt_ndoc-'+dup).attr('onblur','calculogasto()').val("");
			$("#table1").find("#gastos-"+dup).find("#txt_fecha-0").attr('id','txt_fecha-'+dup).attr('name','txt_fecha-'+dup).attr('onclick','calendar("txt_fecha-'+dup+'")').attr('onblur','calculogasto()').val("");
			$("#table1").find("#gastos-"+dup).find("#txt_monto-0").attr('id','txt_monto-'+dup).attr('name','txt_monto-'+dup).attr('onblur','calculogasto()').val("");
			$("#table1").find("#gastos-"+dup).find("#txt_detalle-0").attr('id','txt_detalle-'+dup).attr('name','txt_detalle-'+dup).attr('onblur','calculogasto()').val("");
			$("#ngastos").val(dup+1);
			$("#btn_eli").show();
		}
	});
		
	$("#btn_eli").click(function(){
		var dup=parseInt($("#ngastos").val());
		var d=dup-1;
		$("#gastos-"+d).find("input, select").removeAttr('required');
		$("#table1").find("#gastos-"+d).remove();
		$("#table1").find("#txt_fecha-"+d).attr("data-mask","data-mask").attr("data-inputmask","alias: dd/mm/yyyy");
		$("#ngastos").val(d);
		if(parseInt($("#ngastos").val())==1){
			$("#btn_eli").hide();
			$("#ngastos").val("1");
		} else if(parseInt($("#ngastos").val())==0){
			$("#gastos").attr("style","display:none;");
			$("#ngastos").val("1");
		}
	});

	$("#txt_monto").blur(function(){
		$("#txt_monentrega").val($("#txt_monto").val());
		resumen();
	});

	function subirarchivo(id){
		$("#icono"+id).attr("class","glyphicon glyphicon-ok si");
	}



	function calculogasto(){
		var iteracion=parseInt($("#ngastos").val());
		var total=0;
		limpiargastos();
		var comb=0, aloja=0, tr=0,artof=0,fac=0,enco=0,alim=0,loc=0,peaje=0,estac=0,hon=0,otros=0;
		for (var i = 1; i < iteracion; i++) {
			var tg=parseInt($("#lb_tipogasto-"+i).val());
			switch(tg){
				case 1: 
					comb+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(comb)){ comb=0;}
					$("#txt_montogasto1").val(comb);
				break;
				case 2: 
					alim+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(alim)){ alim=0;}
					$("#txt_montogasto2").val(alim);
					break;
				case 3: 
					aloja+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(aloja)){ aloja=0;}
					$("#txt_montogasto3").val(aloja);
					break;
				case 4: 
					loc+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(loc)){ loc=0;}
					$("#txt_montogasto4").val(loc);
					break;
				case 5: 
					tr+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(tr)){ tr=0;}
					$("#txt_montogasto5").val(tr);
					break;
				case 6: 
					peaje+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(peaje)){ peaje=0;}
					$("#txt_montogasto6").val(peaje);
					break;
				case 7:
					artof+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(artof)){ artof=0;}
					$("#txt_montogasto7").val(artof);
					break;
				case 8: 
					estac+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(estac)){ estac=0;}
					$("#txt_montogasto8").val(estac);
					break;
				case 9: 
					fac+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(fac)){ fac=0;}
					$("#txt_montogasto9").val(fac);
					break;
				case 10: 
					enco+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(enco)){ enco=0;}
					$("#txt_montogasto10").val(enco);
					break;
				case 11: 
					otros+=parseInt($("#txt_monto-"+i).val());
					if(isNaN(otros)){ otros=0;}
					$("#txt_montogasto11").val(otros);
					break;
			}
		}	
		resumen();
	}

	function limpiargastos(){
		var gastos=<?php echo count($gastos)-1; ?>;
		var indice=0;
		for (var i = 1; i <= gastos; i++) {
			$("#txt_montogasto"+i).val(0);			
		}
	}

	function resumen(){
		var gastos=<?php echo count($gastos)-1; ?>;
		var indice=0;
		var total=0;
		for (var i = 1; i <= gastos; i++) {
			total+=parseInt($("#txt_montogasto"+i).val());	
		}
		if(isNaN(total)){ total=0;}
		$("#txt_subtotal").val(total);
		$("#txt_totalrendido").val(total);
		var saldo=parseInt($("#txt_monentrega").val())-parseInt($("#txt_totalrendido").val());
		if(isNaN(saldo)){saldo=0;}
		$("#txt_saldo").val(saldo);
	}

	function validar(){
		var vacios=0;
		var valido=true;
		if($.trim($("#txt_ncuenta").val())==""){
			$("#txt_ncuenta").attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
			vacios+=1;
		} else {
			$("#txt_ncuenta").removeAttr('style');
		}
		if($("#lb_banco").val()==""){
			$("#lb_banco").attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
			vacios+=1;
		} else {
			$("#lb_banco").removeAttr('style');
		}
		if($("#lb_empresa").val()==""){
			$("#lb_empresa").attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
			vacios+=1;
		} else {
			$("#lb_empresa").removeAttr('style');
		}
		if($("#lb_tipo").val()==""){
			$("#lb_tipo").attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
			vacios+=1;
		} else {
			$("#lb_tipo").removeAttr('style');
		}
		if($.trim($("#txt_monto").val())==""){
			$("#txt_monto").attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
			vacios+=1;
		} else {
			$("#txt_monto").removeAttr('style');
		}
		if($("#lb_cliente").val()==""){
			$("#lb_cliente").attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
			vacios+=1;
		} else {
			$("#lb_cliente").removeAttr('style');
		}
		var iteracion=parseInt($("#ngastos").val()); 
		for (var j = 1; j < iteracion; j++) {
			if($("#lb_tipogasto-"+j).val()==""){
				$("#lb_tipogasto-"+j).attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
				vacios+=1;
			} else {
				$("#lb_tipogasto-"+j).removeAttr('style');
			}
			// if($.trim($("#txt_ndoc-"+j).val())==""){
			// 	$("#txt_ndoc-"+j).attr('style','');
			// 	vacios+=1;
			// } else {
			// 	$("#txt_ndoc-"+j).removeAttr('style');
			// }
			if($.trim($("#txt_fecha-"+j).val())==""){
				$("#txt_fecha-"+j).attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
				vacios+=1;
			} else {
				$("#txt_fecha-"+j).removeAttr('style');
			}
			if($.trim($("#txt_monto-"+j).val())==""){
				$("#txt_monto-"+j).attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
				vacios+=1;
			} else {
				$("#txt_monto-"+j).removeAttr('style');
			}
			// if($.trim($("#txt_detalle-"+j).val())==""){
			// 	$("#txt_detalle-"+j).attr('style','border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)');
			// 	vacios+=1;
			// } else {
			// 	$("#txt_detalle-"+j).removeAttr('style');
			// }
		}
		if(vacios>0){
			valido=false;
		}
		return valido;
	}

	function ingresar() {
		if(validar()){
			$("#form1").submit();
		} else {
			alert("Faltan datos para completar el formulario, revise rendición");
		}
	}
</script>
<style type="text/css">
	.label-primary {
	    border: 1px solid #ccc;
	    display: inline-block;
	    padding: 6px 12px;
	    cursor: pointer;
	}

	.label-primary:focus,
	.label-primary:hover {
	    background-color: green;	
    }

	input[type="file"] {
	    display: none;

	}
</style>

</html>

<!DOCTYPE html>
<html>
<script src="<?php echo base_url("assets/js/validCampoFranz.js");?>"></script>

<body class="hold-transition fondo">

<div class="wrapper">
	<form id="form2" method="POST" action="http://localhost/rendiciones/solicitudes/agregarsolicitud" enctype="multipart/form-data">

		    <section class="content-header">
		    	<a href="http://localhost/rendiciones/menu"><button type="button" class="btn btn-primary"><i class='fa fa-reply'></i></button></a>
		    	<br><br>
		      <h1>
		        Solicitud de Fondos
		        <!-- <small>Control panel</small> -->
		      </h1>
		    </section>
		    <section class="content">
		    	<div class="row">
		    		<div class="col-md-5">
		    			<div class="box box-primary" >
				            <div class="box-header with-border">
				              <h3 class="box-title">Datos Solicitante</h3>
				            </div>
				             <div class="box-body" >
				             	<div class="form-group">
				                  	<label >Nombre :&nbsp;</label>
				                  	<label><?php echo $_SESSION["nombre"]; ?></label>
				                </div>
				                <?php
				                	if($perfil!=1000){
				                		echo "<div class='form-group'>
				                 			<label><input type='checkbox' id='chk-supervisor'  name='chk-supervisor' onclick='supervisor();'>&nbsp;Para un tercero</label>
				                			</div> ";
				                		echo "<div class='form-group' id='supervisor' style='display: none;'>
				                  		<label >Supervisor Responsable:&nbsp;</label>
				                  		<select id='lb_solsupervisor' name='lb_solsupervisor' onchange='datos_super();' class='form-control'>
				                  		<option value=''>Seleccione</option>";
				                  			foreach ($supervisores as $s) {
				                  				echo "<option value='".$s["rut"]."'>".$s["nombre"]."</option>";
				                  			}

				                  		echo "</select>
				                		</div>";
				                	}

				                ?>	                
				                
				                <div class="form-group">
				                  	<label >Forma de Pago:&nbsp;</label>
				                  	<select id="lb_solfpago" name="lb_solfpago" class="form-control" onchange="pago();">
					                  	<option value="">Seleccione</option>
					                  <?php
					                   		foreach($pagos as $c){
					                   			echo "<option value='".$c["id_fpago"]."'>".strtoupper($c["fpago"])."</option>";
					                   		}
					                   ?>
					               	</select>
				                </div> 
				                <div class="form-group " id="cuenta" style="display: none;">
				                  	<label for="exampleInputFile">N° Cuenta a depositar:&nbsp;</label><br>
				                  	<?php
				                 		if($cuenta!=0){
				                 			echo "<input type='text' name='txt_solncuenta' id='txt_solncuenta' class='form-control' value='".$cuenta."' readonly>";
				                 		} else {
				                 			echo "<input type='text' name='txt_solncuenta' id='txt_solncuenta' class='form-control'>";
				                 		}	
				                 	?>
				                </div>
				                <div class="form-group" id="banco" style="display: none;">
				                  	<label>Banco:&nbsp;</label>
				                  	<?php
				                  		if($banco!=0){
					                 	echo "<select id='lb_solbanco' name='lb_solbanco' class='form-control'>";
					                 		foreach($bancos as $b){
						                   		if($banco==$b["id_banco"]){
						                   			echo "<option value='".$b["id_banco"]."' selected>".strtoupper($b["banco"])."</option>";
						                   		}						                   			
						                   	}
						                   	echo "</select>";
				                  		} else {
				                  			echo "<select id='lb_solbanco' name='lb_solbanco' class='form-control'>
					                 		<option value=''>Seleccione</option>";
					                 		foreach($bancos as $b){
						                   		echo "<option value='".$b["id_banco"]."'>".strtoupper($b["banco"])."</option>";
						                   			
						                   	}
						                   	echo "</select>";
				                  		}			                 		
						                   		
					                ?>
				                </div>
				             </div>
				        </div>
		    		</div>
		    		<div class="col-md-5">
		    			<div class="box box-primary" >
		    				<div class="box-header with-border">
				              <h3 class="box-title">Datos Solicitud</h3>
				            </div>
				            <div class="box-body" >
				                <div class="form-group">
				                  	<label >Empresa:&nbsp;</label>
				                  	<select id="lb_solempresa" name="lb_solempresa" class="form-control">
				                  	<option value="">Seleccione</option>
				                   <?php
				                   		foreach($empresas as $em){
				                   			echo "<option value='".$em["id_egrupo"]."'>".strtoupper($em["egrupo"])."</option>";
				                   		}
				                   ?>
				                  </select>
				                </div>
				                <div class="form-group">
				                  	<label >Centro Costo:&nbsp;</label>
				                  	<select id="lb_solcliente" name="lb_solcliente" class="form-control">
					                  	<option value="">Seleccione</option>
					                  <?php
					                   		foreach($clientes as $c){
					                   			echo "<option value='".$c["id_cliente"]."'>".strtoupper($c["cliente"])."</option>";
					                   		}
					                   ?>
					               	</select>
				                </div>
				                <div class="form-group">
				                  	<label >Tipo Fondo:&nbsp;</label>
				                  	<select id="lb_solfondo" name="lb_solfondo" class="form-control">
					                  	<option value="">Seleccione</option>
					                  <?php
					                   		foreach($fondos as $c){
					                   			echo "<option value='".$c["id_tipo_fondo"]."'>".strtoupper($c["tipo_fondo"])."</option>";
					                   		}
					                   ?>
					               	</select>
				                </div>
				                <div class="form-group">
				                  	<label >Monto:&nbsp;</label>
				                  	<input type="text" name="txt_solmonto" id="txt_solmonto" class="form-control">
				                </div>
				                <div class="form-group">
				                  	<label >Motivo de Fondo:&nbsp;</label>
				                  	<textarea class="form-control" name="txt_solmotivo" id="txt_solmotivo"></textarea>
				                </div>
				                <div class="form-group">
				                  	<label >Adjuntar Solicitud:&nbsp;</label>&nbsp;&nbsp;
				                  	<label for="txt_solarchivo" class="btn btn-primary"><i class="glyphicon glyphicon-open"></i></label>
				                  	<i id="archivo"></i>
				                  	<input type="file" style="display: none;" name="txt_solarchivo" id="txt_solarchivo" class="form-control" onchange="subirarchivo();">
				                </div>
				            </div>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="box-primary">
		    				<div class="box-body">
		    					<button class="btn btn-primary" type="button" id="btn_ing_solicitud">INGRESAR SOLICITUD</button>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </section>
	</form>
</div>
</body>
<script type="text/javascript">
	 $('#txt_solmonto').validCampoFranz('0123456789');    

	 $('#btn_ing_solicitud').click(function(){
	 	if(valida_sol()){
	 		$("#form2").submit();
	 	} else {
	 		alert("Algunos campos se encuentran incompletos, revise formulario e intente nuevamente");
	 	}
	 });

	function supervisor(){
	 	if($("#chk-supervisor").is(":checked")){
	 		$("#supervisor").show();
	 	} else {
	 		$("#supervisor").hide();
	 		$("#cuenta").hide();
	 		$("#banco").hide();
	 		$("#txt_solncuenta").val("");
	 		$("#lb_solbanco").val("");
	 		$("#lb_solfpago").val("");
	 		$("#lb_solsupervisor").val("");
	 	}
	}

	function datos_super(){
		var cuenta,banco;
	 	if($("#lb_solsupervisor").val()==""){
	 		cuenta='<?php echo $cuenta;?>', banco='<?php echo $banco;?>';
	 	} else {
	 		var sup=$("#lb_solsupervisor").val();
	 		$.ajax({
	 			url:"http://localhost/rendiciones/solicitudes/supervisor",
	 			type:"POST",
	 			async: false,
	 			data:"sup="+sup,
	 			success: function(data){
	 				var d=data.split("/");
	 				cuenta=d[0];
	 				banco=d[1];
	 			}
	 		});
	 	}
	 	if(cuenta!='0'){ 
	 		$("#txt_solncuenta").val(cuenta); 
	 		$("#txt_solncuenta").attr("readonly",true);
	 	} else {
	 		$("#txt_solncuenta").val("");
	 		$("#txt_solncuenta").removeAttr("readonly");
	 	}
	 	if(banco!='0'){
	 		$("#lb_solbanco").val(banco);
	 		$("#lb_solbanco").attr("disabled",true);
	 	} else {
	 		$("#lb_solbanco").val("");
	 		$("#lb_solbanco").removeAttr("disabled");
	 	}
	}

	function pago(){
	 	var p=parseInt($("#lb_solfpago").val());
	 	if(p==2){
	 		$("#cuenta").show();
	 		$("#banco").show();
	 	} else if(p==3){
	 		$("#cuenta").hide();
	 		$("#banco").show();
	 	} else {
	 		$("#cuenta").hide();
	 		$("#banco").hide();
	 		
	 	}	 	
	}

	function subirarchivo(){
		$("#archivo").attr("class","glyphicon glyphicon-ok si");
	}


	function valida_sol(){
	 	var vacios=0;
	 	var valido=true;
	 	if($("#lb_solempresa").val()==""){
	 		$("#lb_solempresa").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
	 		vacios+=1;
	 	} else {
	 		$("#lb_solempresa").removeAttr("style");
	 	}
	 	if($("#lb_solcliente").val()==""){
	 		$("#lb_solcliente").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
	 		vacios+=1;
	 	} else {
	 		$("#lb_solcliente").removeAttr("style");
	 	}
	 	if($.trim($("#txt_solmonto").val())=="" ){
	 		$("#txt_solmonto").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
	 		vacios+=1;
	 		//|| $.trim($("#txt_solmonto").val()).length<=10
	 	} else {
	 		$("#txt_solmonto").removeAttr("style");
	 	}
	 	if($.trim($("#txt_solmotivo").val())==""){
	 		$("#txt_solmotivo").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
	 		vacios+=1;
	 	} else {
	 		$("#txt_solmotivo").removeAttr("style");
	 	}
	 	if($("#lb_solfpago").val()==""){
	 		$("#lb_solfpago").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
	 		vacios+=1;
	 	} else {
	 		$("#lb_solfpago").removeAttr("style");
	 		if($("#lb_solfpago").val()=="3"){
	 			if($("#lb_solbanco").val()==""){
			 		$("#lb_solbanco").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
			 		vacios+=1;
			 	} else {
			 		$("#lb_solbanco").removeAttr("style");
			 	}
	 		} else {
	 			if($.trim($("#txt_solncuenta").val())==""){
			 		$("#txt_solncuenta").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
			 		vacios+=1;
			 	} else {
			 		$("#txt_solncuenta").removeAttr("style");
			 	}
			 	if($("#lb_solbanco").val()==""){
			 		$("#lb_solbanco").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
			 		vacios+=1;
			 	} else {
			 		$("#lb_solbanco").removeAttr("style");
			 	}
	 		}
	 	}
	 	if($("#lb_solfondo").val()==""){
	 		$("#lb_solfondo").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
	 		vacios+=1;
	 	} else {
	 		$("#lb_solfondo").removeAttr("style");
	 	}
	 	// if($("#txt_solarchivo").val()==""){
	 	// 	$("#archivo").attr("class","glyphicon glyphicon-remove no");
	 	// 	vacios+=1;
	 	// } else {
	 	// 	$("#archivo").removeAttr("class");
	 	// }
	 	if($("#chk-supervisor").is(":checked")){
	 		if($("#lb_solsupervisor").val()==""){
		 		$("#lb_solsupervisor").attr("style","border-color:#FF0004; outline:0; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255, 71, 74, 1)");
		 		vacios+=1;
		 	} else {
		 		$("#lb_solsupervisor").removeAttr("style");
		 	}
	 	} else {
	 		$("#lb_solsupervisor").removeAttr("style");
	 	}
	 	if(vacios>0){
	 		valido=false;
	 	} 
	 	return valido;
	 }
</script>
</html>

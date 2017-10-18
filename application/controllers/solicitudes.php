<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class solicitudes extends CI_Controller {

	public function index(){
		if(isset($_SESSION["sesion_rend"])){
			$this->load->model("solicitud");
			$this->load->model("listar");
			$data["nombre"]=$_SESSION["nombre"];
			$data["usuario"]=$_SESSION["usuario"];
			$data["clientes"]=$this->listar->cliente();
			$data["empresas"]=$this->listar->empresas();
			$data["usuarios"]=$this->listar->usuarios();
			$data["estados"]=$this->listar->estados();
			$data["solicitudes"]=$this->solicitud->solicitudes();
			$this->load->view('contenido');
		    $this->load->view('layout/layout',$data);
		    //$this->load->view('layout/aside',$data);
			$this->load->view('fondos/aprobar_fondos',$data);
		} else {
			redirect(site_url("login"));
		}
	}


	public function solicitud(){
		if(isset($_SESSION["sesion_rend"])){
			$this->load->model("listar");
			$data["nombre"]=$_SESSION["nombre"];
			$data["usuario"]=$_SESSION["usuario"];
			$data["perfil"]=$_SESSION["perfil"];
			$data["solicitante"]=$this->listar->solicitante($_SESSION["usuario"]);
			$data["clientes"]=$this->listar->clientes($_SESSION["usuario"]);
			$data["bancos"]=$this->listar->bancos();
			$data["empresas"]=$this->listar->empresas();
			$data["supervisores"]=$this->listar->supervisores($_SESSION["usuario"]);
			$data["clientes"]=$this->listar->clientes($_SESSION["usuario"]);
			$data["pagos"]=$this->listar->formapago();
			$data["fondos"]=$this->listar->fondos();
			$data["banco"]=$_SESSION["banco"];
			$data["cuenta"]=$_SESSION["cuenta"];
			$this->load->view('contenido');
		    $this->load->view('layout/layout',$data);
		    //$this->load->view('layout/aside',$data);
			$this->load->view('fondos/solicitud_fondos',$data);
		} else {
			redirect(site_url("login"));
		}
	}


	public function supervisor(){
		if(isset($_SESSION["sesion_rend"])){
			$rut=$_POST["sup"];
			$this->load->model("solicitud");
			$sup=$this->solicitud->supervisor($rut);
			echo $sup["ncuenta"]."/",$sup["id_banco"];		
		} else {
			redirect(site_url("login"));
		}
	}

	public function agregarsolicitud(){
		if(isset($_SESSION["sesion_rend"])){
			$this->load->model("solicitud");
			$data["usuario"]=$_SESSION["usuario"];
			$data["empresa"]=$_POST["lb_solempresa"];
			$data["cliente"]=$_POST["lb_solcliente"];
			$data["monto"]=$_POST["txt_solmonto"];
			$data["motivo"]=$_POST["txt_solmotivo"];
			$data["fpago"]=$_POST["lb_solfpago"];
			$data["rut_sup"]=$_POST["lb_solsupervisor"];			
			$data["fondo"]=$_POST["lb_solfondo"];
			$data["banco"]=$_POST["lb_solbanco"];
			if($_POST["lb_solfpago"]==2){
				$data["ncuenta"]=$_POST["txt_solncuenta"];
			} else if($_POST["lb_solfpago"]==3){
				$data["ncuenta"]="";
			}
			$archivo=explode('.', strtolower($_FILES['txt_solarchivo']['name']));
			$ext= end($archivo);
			$nombre="solicitud_".date("dmYHis").$_SESSION["usuario"].$_POST["lb_solempresa"].$_POST["lb_solcliente"].".".$ext;
			$file=$this->archivo($nombre);
			$data["archivo"]="archivos/solicitudes/".$file;
			if($data["archivo"]=="archivos/solicitudes/"){
				$data["archivo"]="";
			}
			$this->solicitud->agregar_solicitudfondo($data);
			//$this->email();
			echo "<script> alert('Solicitud realizada con éxito.'); location.href='http://localhost/rendiciones/menu';</script>";
		} else {
			redirect(site_url("login"));
		}
	}


	public function detallesolicitud(){
		if(isset($_SESSION["sesion_rend"])){
			$id=$_POST["id"];
			$this->load->model("solicitud");
			$sol=$this->solicitud->detallesolicitud($id);
			echo "<div class='modal-header'>
				<button class='close' aria-label='Close' type='button' data-dismiss='modal'>
				<span aria-hidden='true'>x</span>
				</button>
				<h4>Detalle Solicitud N° ".$sol["id_fondo"]."</h4>
			</div>";

			echo "<div class='modal-body'>
				<table class=' table-bordered table'>
					<tr>
						<th>Empresa</th><td>".$sol["egrupo"]."</td>
						<th>Cliente</th><td>".$sol["cliente"]."</td>
						<th>Solicitante</th><td>".$sol["solicitante"]."</td>
						
					</tr>
					<tr>
						<th>Responsable</th><td>".$sol["responsable"]."</td>
						<th>Rut Responsable</th><td>".$sol["rut"]."</td>
						<th>Motivo</th><td>".$sol["motivo"]."</td>
						
					</tr>
					<tr>
						<th>Monto</th><td>".$sol["monto"]."</td>
						<th>Banco</th><td>".$sol["banco"]."</td>
						<th>N° Cuenta</th><td>".$sol["ncuenta"]."</td>
					</tr>
					<tr>
						<th>Forma de Pago</th><td>".$sol["fpago"]."</td>
						<th>Tipo de Fondo</th><td>".$sol["tipo_fondo"]."</td>
						<th>Fecha Solicitud</th><td>".$sol["fecha_registro"]."</td>
						
						
					</tr>
					<tr>
						<th>Fecha Rendición</th><td>".$sol["fecha_rendicion"]."</td>
						<th>Comentario</th><td>".$sol["comentario"]."</td>
						<th>Estado</th><td>".$sol["estado"]."</td>
					</tr>
					<tr>
						<th>Archivo Solicitud</th>
						<td colspan='2'><a target='_blank' href='".site_url().$sol["archivo_solicitud"]."'><label class='btn-sm btn-primary'><i class='glyphicon glyphicon-open'></i>Ver Archivo</label></a></td>
					</tr>
				</table>
			</div>";
		} else {
			redirect(site_url("login"));
		}
	}	


	public function buscarsolicitud(){
		if(isset($_SESSION["sesion_rend"])){
			$this->load->model("solicitud");
			$this->load->model("listar");
			$solicitante=$_POST["lb_apsolicitante"];
			$empresa=$_POST["lb_apempresa"];
			$cliente=$_POST["lb_apcliente"];
			$estado=$_POST["lb_apestado"];
			$fecha=$_POST["txt_apfechasol"];
			$data["nombre"]=$_SESSION["nombre"];
			$data["usuario"]=$_SESSION["usuario"];
			$data["clientes"]=$this->listar->cliente();
			$data["empresas"]=$this->listar->empresas();
			$data["usuarios"]=$this->listar->usuarios();
			$data["estados"]=$this->listar->estados();
			$data["solicitudes"]=$this->solicitud->buscarsolicitudes($solicitante,$empresa,$cliente,$fecha,$estado);
			$this->load->view('contenido');
		    $this->load->view('layout/layout',$data);
		    //$this->load->view('layout/aside',$data);
			$this->load->view('fondos/aprobar_fondos',$data);
		} else {
			redirect(site_url("login"));
		}
	}


	public function aprobacion(){
		if(isset($_SESSION["sesion_rend"])){
			$estado=$_POST["estado"];
			$solicitud=$_POST["id"];
			$this->load->model("solicitud");
			// if($_SESSION["perfil"]==31){
			// 	$sup=$this->solicitud->aprobacionjefe($id,$estado);
			// } else 
			// 	$sup=$this->solicitud->aprobacionfinanzas($id,$estado);
			// }
			$sup=$this->solicitud->aprobacionjefe($id,$estado);
			$this->email();
			echo "La Solicitud N° ".$solicitud." ha cambiado de estado";	
		} else {
			redirect(site_url("login"));
		}
	}


	function archivo($nombre){
		$archivo="txt_solarchivo";
		$config['upload_path'] = "archivos/solicitudes/";
		$config['file_name'] = $nombre;
		$config['allowed_types'] = "pdf|doc|docx|jpg|jpeg|png";
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($archivo)) {
					//*** ocurrio un error
			$dat['uploadError'] = $this->upload->display_errors();
			echo $this->upload->display_errors();
			return;
		}
		$data = $this->upload->data();
		$nom=$data['file_name'];
		return $nom;
	}


	function enviaremail($email,$mensaje,$titulo){
		$cabeceras = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$cabeceras .= 'Cc: SSP@audisischile.com '."\r\n";
		$enviado = mail($email,$titulo,$mensaje,$cabeceras);
		return $enviado;
	}

}

?>
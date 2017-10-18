<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu extends CI_Controller {
	
	public function index(){
		if(isset($_SESSION["sesion_rend"])){
			$data["nombre"]=$_SESSION["nombre"];
			$data["usuario"]=$_SESSION["usuario"];
			$this->load->view('contenido');
		    $this->load->view('layout/layout',$data);
		    //$this->load->view('layout/aside',$data);
			$this->load->view('principal/home',$data);
		} else {
			if(isset($_POST["txt_usuario"]) && isset($_POST["txt_contra"])){
				$this->load->model("funcion_login");
				$login=$this->funcion_login->login($_POST["txt_usuario"],$_POST["txt_contra"]);
				//$modulo=array();
				if($login != 0){ 
					for ($i=0; $i < count($login); $i++){
						$nombre=$login[$i]["persona"];
						$usuario=$login[$i]["usuario"];
						$_SESSION["cuenta"]=$login[$i]["ncuenta"];
						$_SESSION["banco"]=$login[$i]["id_banco"];
						$_SESSION["perfil"]=$login[$i]["perfil"];
					}
					$_SESSION["sesion_rend"]=true;
					$_SESSION["nombre"]=strtoupper($nombre);
					$_SESSION["usuario"]=$usuario;
					$data["usuario"]=$_SESSION["usuario"];
					$data["nombre"]=strtoupper($nombre);
					$this->load->view('contenido');
					$this->load->view('layout/layout',$data);
					//$this->load->view('layout/aside',$data);
					$this->load->view('principal/home',$data);
				} else {
					echo "<script> alert('usuario y/o contraseña incorrectos, ingrese nuevamente'); 
					window.location.href='rendiciones'</script>";
				}
			
			}else {
				redirect(site_url("login"));
		}
	}
	}
}
?>
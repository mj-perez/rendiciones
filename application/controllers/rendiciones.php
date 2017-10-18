<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rendiciones extends CI_Controller {
	
	public function index(){
		if(isset($_SESSION["sesion_rend"])){
			$this->load->model("rendicion");
			$data["nombre"]=$_SESSION["nombre"];
			$data["usuario"]=$_SESSION["usuario"];
			$data["rendiciones"]=$this->rendicion->rend_noaprobadas();
			$this->load->view('contenido');
		    $this->load->view('layout/layout',$data);
		    //$this->load->view('layout/aside',$data);
			$this->load->view('rendicion/ver_rendiciones',$data);
		} else {
			redirect(site_url("login"));
		}
	}


	public function rendicion(){
		if(isset($_SESSION["sesion_rend"])){
			$this->load->model("listar");
			$this->load->model("solicitud");
			if(isset($_POST["id_fondo"])){
				$data["fondo"]=$this->solicitud->detallesolicitud($_POST["id_fondo"]);
			}
			$data["solicitante"]=$this->listar->solicitante($_SESSION["usuario"]);
			$data["empresas"]=$this->listar->empresas();
			$data["tipos"]=$this->listar->tipo_rendiciones();
			$data["clientes"]=$this->listar->clientes($_SESSION["usuario"]);
			$data["bancos"]=$this->listar->bancos();
			$data["gastos"]=$this->listar->gastos();
			$data["banco"]=$_SESSION["banco"];
			$data["cuenta"]=$_SESSION["cuenta"];
			$data["nombre"]=$_SESSION["nombre"];
			$data["usuario"]=$_SESSION["usuario"];
			$this->load->view('contenido');
		    $this->load->view('layout/layout',$data);
		    //$this->load->view('layout/aside',$data);
			$this->load->view('rendicion/ingresar');
		} else {
			redirect(site_url("login"));
		}
	}

	public function agregarrendicion(){
		if(isset($_SESSION["sesion_rend"])){
			$this->load->model("rendicion");
			$this->load->model("listar");
			$data=array();
			$data["usuario"]=$_SESSION["usuario"];
			$data["ncuenta"]=$_POST["txt_ncuenta"];
			$data["banco"]=$_POST["lb_banco"];
			$data["empresa"]=$_POST["lb_empresa"];
			$data["tipo_rendicion"]=$_POST["lb_tipo"];
			$data["cliente"]=$_POST["lb_cliente"];
			$data["monto_entregado"]=$_POST["txt_monentrega"];
			$data["total_rendido"]=$_POST["txt_totalrendido"];
			$data["saldo_empresa"]=$_POST["txt_saldo"];
			$this->rendicion->agregar_rendicion($data);
			$tipos=count($this->listar->gastos());
			for ($j=1; $j <= $tipos; $j++) { 
				$data["total"]=$_POST["txt_montogasto".$j];
				$data["tipo"]=$j;
				if($data["total"]>0){
					$this->rendicion->agregar_rendiciondetalle($data);
				}
			}
			$gastos=(int)$_POST["ngastos"];
			for ($i=1; $i < $gastos; $i++) { 
				$data["fecha"]=$_POST["txt_fecha-".$i];
				$data["monto"]=$_POST["txt_monto-".$i];
				$data["detalle_gasto"]=$_POST["txt_detalle-".$i];
				$data["ndocumento"]=$_POST["txt_ndoc-".$i];
				$data["tipo_gasto"]=$_POST["lb_tipogasto-".$i];
				$this->rendicion->agregar_rendiciondetallegastos($data);
			}
			$this->load->library('pdf');
			$this->pdf=new Pdf();
			$this->pdf->AddPage();
			$this->pdf->SetTitle("RENDICION DE FONDOS SOLICITADOS");
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFont('Arial','B',8);
			//$this->pdf->Ln(10);
			$rend=$this->rendicion->rendicion($this->rendicion->idrendicion()["idrendicion"]);
			$rendet=$this->rendicion->rendiciondetalle($this->rendicion->idrendicion()["idrendicion"]);
			$rendetgas=$this->rendicion->rendiciondetallegastos($this->rendicion->idrendicion()["idrendicion"]);
			$this->pdf->Cell(130,10,'RENDICION DE FONDOS SOLICITADOS N° '.$rend["id_rendicion"],0,0,'C');
			$this->pdf->Ln(10);
			$this->pdf->SetFillColor(137,200,213);
			$this->pdf->Cell(45,8,'EMPRESA',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["EGrupo"],1,0,'C');			
			$this->pdf->Cell(45,8,'SOLICITANTE',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["solicitante"],1,0,'C');
			$this->pdf->Ln();
			$this->pdf->Cell(45,8,'CENTRO COSTO',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["Cliente"],1,0,'C');
			$this->pdf->Cell(45,8,'RUT',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["rut"],1,0,'C');
			$this->pdf->Ln();
			$this->pdf->Cell(45,8,'TIPO RENDICION',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["Tipo_Rendicion"],1,0,'C');
			$this->pdf->Cell(45,8,'CTA A DEPOSITAR',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["ncuenta"],1,0,'C');
			$this->pdf->Ln();
			$this->pdf->Cell(45,8,'MONTO ENTREGADO',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["monto_entregado"],1,0,'C');
			$this->pdf->Cell(45,8,'BANCO',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["Banco"],1,0,'C');
			$this->pdf->Ln();
			$this->pdf->Cell(45,8,'FECHA RENDICION',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["fecha_registro"],1,0,'C');
			$this->pdf->Cell(45,8,'CORREO ELECTRONICO',1,0,'C',true);
			$this->pdf->Cell(50,8,$rend["email"],1,0,'C');
			$this->pdf->Ln();
			$this->pdf->Cell(50,8,'','T');
			$this->pdf->Ln(10);
			$this->pdf->Cell(50,8,'TIPO GASTO',1,0,'C',true);
			$this->pdf->Cell(50,8,'TOTAL',1,0,'C',true);
			$this->pdf->Ln();	
			foreach ($rendet as $rd) {
				$this->pdf->Cell(50,8,$rd["Tipo_Gasto"],1,0,'C');
				$this->pdf->Cell(50,8,$rd["total"],1,0,'C');
				$this->pdf->Ln();
			}
			$this->pdf->Cell(50,8,'','T');
			$this->pdf->Ln(10);
			$this->pdf->Cell(45,8,'TIPO GASTO',1,0,'C',true);
			$this->pdf->Cell(45,8,'FECHA',1,0,'C',true);
			$this->pdf->Cell(45,8,'MONTO',1,0,'C',true);
			$this->pdf->Cell(45,8,'DETALLE GASTO',1,0,'C',true);
			$this->pdf->Ln();
			foreach ($rendetgas as $rdg) {
				$this->pdf->Cell(45,8,$rdg["Tipo_Gasto"],1,0,'C');
				$this->pdf->Cell(45,8,$rdg["fecha"],1,0,'C');
				$this->pdf->Cell(45,8,$rdg["monto"],1,0,'C');
				$this->pdf->Cell(45,8,$rdg["Detalle_Gasto"],1,0,'C');
				$this->pdf->Ln();
			}
			$this->pdf->Cell(45,8,'','T');
			$this->pdf->Ln();
			$this->pdf->Output("Rendicion N".$this->rendicion->idrendicion()["idrendicion"].".pdf", 'I');
			//$this->pdf->Output("Rendicion N".$this->rendicion->idrendicion()["idrendicion"].".pdf", 'D');
			redirect(site_url("menu"));
		} else {
			redirect(site_url("login"));
		}
	}


	function archivo($nombre,$it){
		$archivo="txt_boleta".$it;
		$config['upload_path'] = "archivos/rendiciones/";
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


	public function detallerendicion(){
		$id=$_POST["idrendicion"];
		$this->load->model("rendicion");
		$ren=$this->rendicion->rendicion($id);
		$rend=$this->rendicion->rendiciondetalle($id);
		$rendg=$this->rendicion->rendiciondetallegastos($id);
		echo "<div class='row'>
			<div class='col-md-12'> ";
			echo "<table class='table table-bordered'>
				<tr>
					<th>Número Rendición</th><td>".$ren["id_rendicion"]."</td>
					<th>Tipo de Rendición</th><td>".$ren["Tipo_Rendicion"]."</td>
					<th>Fecha Rendición</th><td>".$ren["fecha_registro"]."</td>
					
				</tr>
				<tr>
					<th>Empresa</th><td>".$ren["EGrupo"]."</td>
					<th>Centro Costo</th><td>".$ren["Cliente"]."</td>
					<th></th><td></td>
				</tr>
				<tr>
					<th>Solicitante</th><td>".$ren["solicitante"]."</td>
					<th>Banco</th><td>".$ren["Banco"]."</td>
					<th>Número Cuenta</th><td>".$ren["ncuenta"]."</td>
				</tr>
				<tr>
					<th>Monto Entregado</th><td>$".$ren["monto_entregado"]."</td>
					<th>Total Rendido</th><td>$".$ren["total_rendido"]."</td>
					<th>Saldo Empresa</th><td>$".$ren["saldo_empresa"]."</td>
				</tr>
			</table></div>";
		echo "<div class='col-md-11'><table class='table table-bordered'>
			<tr>	
				<th>Tipo Gasto</th>
				<th>Total</th>
				<th>Archivo Boleta</th>
			</tr>";
			foreach ($rend as $r) {
				echo "<tr>
					<td>".$r["Tipo_Gasto"]."</td>
					<td>$".$r["total"]."</td>
					<td><a target='_blank' href='".site_url().$r["Archivo"]."' class='btn btn-primary'><i class='glyphicon glyphicon-file'></i> Abrir</a></td>
					</tr>";
			}
		echo "</table></div><br>";
		echo "<div class='col-md-11'><table class='table table-bordered'>
			<tr>	
				<th>Tipo Gasto</th>
				<th>Monto</th>
				<th>Fecha</th>
				<th>Detalle Gasto</th>
			</tr>";
			foreach ($rendg as $r) {
				echo "<tr>
					<td>".$r["Tipo_Gasto"]."</td>
					<td>$".$r["monto"]."</td>
					<td>".$r["fecha"]."</td>
					<td>".$r["Detalle_Gasto"]."</td>
					</tr>";
			}
		echo "</table>";
		echo "</div>
		</div>";
	}


	public function rendicioneshistoricas(){
		if(isset($_SESSION["sesion_rend"])){
			$this->load->model("rendicion");
			$data["nombre"]=$_SESSION["nombre"];
			$data["usuario"]=$_SESSION["usuario"];

			$this->load->view('contenido');
		    $this->load->view('layout/layout',$data);
		    //$this->load->view('layout/aside',$data);
			$this->load->view('rendicion/ver_rendiciones',$data);
		} else {
			redirect(site_url("login"));
		}
	}


	public function solicitudes(){
		if(isset($_SESSION["sesion_rend"])){
			$this->load->model("listar");
			$this->load->model("solicitud");
			$data["nombre"]=$_SESSION["nombre"];
			$data["usuario"]=$_SESSION["usuario"];
			$data["solicitudes"]=$this->solicitud->solicitudesxrendir();
			$data["clientes"]=$this->listar->clientes($_SESSION["usuario"]);
			$data["usuarios"]=$this->listar->usuarios();
			$this->load->view('contenido');
		    $this->load->view('layout/layout',$data);
		    //$this->load->view('layout/aside',$data);
			$this->load->view('rendicion/rendiciones_act');
		} else {
			redirect(site_url("login"));
		}
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
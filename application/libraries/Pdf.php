<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "fpdf/fpdf.php";

class PDF extends FPDF{
	 public function __construct() {
            parent::__construct();
        }

    public function Header(){
            $this->Image('assets/img/logo-progestion.png',10,8,22);
            $this->SetFont('Arial','B',13);
            $this->Cell(30);
            $this->Ln(7);
      }


    public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
      }


 
}
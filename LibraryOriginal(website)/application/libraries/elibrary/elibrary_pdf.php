<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

 
class Elibrary_Pdf extends TCPDF{

    private $sDean          =   '';
    private $sFaculty       =   '';
    public $ci              =   null;
	public function __construct(){
    $this->ci   =   get_instance();
      /* $aFunc   =    func_get_args();

       print_r($aFunc);
       die();*/
		ob_start();
        //76.2 x 127
        $dimension = array(76.2 ,127); // == array(3,5)
		parent::__construct('L', 'mm', $dimension, true, 'UTF-8', false);

        $this->SetPrintFooter(false);
       // parent::__construct();

		//echo 'thank you lord';
	}
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
    public function footer(){

    }
	 
     public function Header() {


        $image_file = dirname(__FILE__).'/img/aun_logo_mini.png';
        //$this->Image($image_file, 10, 12, 0, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Ln(5);
        $this->SetFont("Times", "B", 10);
        $this->SetTextColor(0, 110, 0);
        //0, 0, 255
        $this->SetTextColor(0, 156, 255);
        
        $this->MultiCell(120, 0, $this->ci->config->item('system.title'), 0, 'C', 0, 1, 1 ,'', true,1);
       // $this->Cell(535, 15, "SCHOOL MODULE", 0, 0, "C");
        $this->SetFont("Times", "B", 8);
        $this->MultiCell(120, 0, $this->ci->config->item('system.address'), 0, 'C', 0, 1, 0 ,'', true,1);
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
/*
        $this->SetFont("Times", "B", 6);
        $this->MultiCell(120, 0, "P.M.B. 1010, ILARA-EPE 106101, LAGOS STATE, NIGERIA", 0, 'C', 0, 1, 0 ,'', true,1);*/
        $this->Ln();
        $this->writeHTML('<hr/>', true, true, true, false, 'J');
        $this->SetTextColor(0, 0, 0);
       /* $this->SetFont("Times", "B", 6);
        $this->MultiCell(120, 0, "(Catalog Record Details)", 0, 'C', 0, 1, 0 ,'', true,1);
        $this->Ln(0);*/

        $this->SetTextColor(0, 0, 0);
      /*  $this->SetFont("Courier", "", 11);
        $this->Cell(535, 15, "FACULTY", 0, 1, "C");
        $this->Cell(535, 15, "DEPARTMENT", 0, 1, "C");
        
        $this->Cell(535, 15, "Programme", 0, 1, "C");*/
        $this->init_101();

       
    }



    private function init_101(){
        $this->SetDisplayMode('real', 'default');
       // $pdf->SetTitle('This is a sample for you.');
        $this->SetCreator('Jaysoftnet Technologies Generator: http://www.jaysoftnet.com');
        $this->SetAuthor('Jaysoftnet ');
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
       // $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      /*  echo PDF_MARGIN_TOP;
        die();*/
        // set margins
        $this->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
        //$this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $this->SetAutoPageBreak(TRUE, 5);

        // set image scale factor
       // $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //return $this->printPatientPersonalProfile(2);
       // $this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'PDF_HEADER_TITLE', PDF_HEADER_STRING);
        /*$this->SetFont('times', '', 9);
        $this->SetTextColor(50, 50, 50);*/
    }

    


    



	public function __destruct(){
		unset($this);
	}

	 
 }

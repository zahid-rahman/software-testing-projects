<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/PHPExcel_1.8.0_pdf/PHPExcel.php';

class Elibrary_excel extends PHPExcel{

	var  $objPHPExcel ;
	private $objWriter;
	private $ext = '.xlsx';
	private $file_name = '';
	private $file_title ='';


	public function __construct(){
		parent::__construct();
		$this->file_name = uniqid().$this->ext;
		$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory;
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod);
		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array( ' memoryCacheSize '  => '120KB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
		 
	}

	public function setFileTitle($title = ''){
		$this->file_title = $title;
		return $this;
	}


	public function setProperties(){
		global $user_data;
		$this->getProperties()->setCreator("Julius Oluwashina")
							 ->setLastModifiedBy(@$user_data['fname'].' '.@$user_data['lname'])
							 ->setTitle($this->file_title)
							 ->setSubject("")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("");
	}
	public function cleanExcelTitle($str = ''){
		$str =  str_replace('/', '-', $str);
		$str = substr($str, 0,31);
		return $str;
	}



	public function dispatch($fileType = 'excel'){
		//$this->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
		header('Content-Type: text/html; charset=UTF-8');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$this->file_name.'"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$this->objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel2007');
		//$this->objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		$this->objWriter->save('php://output');
		$this->disconnectWorksheets();
		//unset($this);

	}

	public function __destruct(){
		unset($this);
	}

}


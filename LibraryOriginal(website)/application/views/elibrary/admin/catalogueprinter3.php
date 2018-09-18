<?php
    if(!isset($mPreparedContent)){
        return ;
    }

    /*print_r($mPreparedContent);
    die();*/

    $this->load->library('elibrary/elibrary_pdf');
    $pdf = new elibrary_pdf();
    $pdf->AddPage();
    $iFirstOffset       =   30;
    $iSecondOffset      =   80;
    $sMainAuthor        =   '';   
    $sAuthorsToUse      =   '';//$mPreparedContent['getCatalogLinkedAuthors'];
    $iAuthorsCount      =   count($mPreparedContent['getCatalogLinkedAuthors']);


    /*echo '<pre>';
    print_r($mPreparedContent['getCatalogLinkedAuthors']);

    die();*/
    /*
        if($iAuthorsCount  > 2 ){
            $iAuthorsCount  = 2;
        }
    */

        if($iAuthorsCount){
            $sMainAuthor =  elibrary_format_main_author_name_order(@$mPreparedContent['getCatalogLinkedAuthors'][0]['lcia_title']);
        }
        


    for($iI = 0; $iI < $iAuthorsCount; $iI++){
        $sAuthorsToUse  .=  $mPreparedContent['getCatalogLinkedAuthors'][$iI]['lcia_title'].', ';
    }


    $sAuthorsToUse      =    substr($sAuthorsToUse , 0, strlen($sAuthorsToUse) - 2);

    $pdf->SetFont("Courier", "", 8); 
    $pdf->MultiCell($iFirstOffset , '',$mPreparedContent['lci_callnumber'], 0, 'L', 0, 0, '' ,'', true);

    $pdf->MultiCell($iSecondOffset, '', strtoupper($mPreparedContent['lci_title'])  , 0, 'L', 0, 1, '' ,'', true);

    $pdf->MultiCell($iFirstOffset , '','', 0, 'L', 0, 0, '' ,'', true);
    


     
    $pdf->MultiCell($iSecondOffset, '', $sMainAuthor, 0, 'L', 0, 1, '' ,'', true);

    $pdf->MultiCell($iFirstOffset , '','', 0, 'L', 0, 0, '' ,'', true);
    $pdf->MultiCell($iSecondOffset, '', $mPreparedContent['lci_title'] .' / '.$sAuthorsToUse, 0, 'L', 0, 1, '' ,'', true);

    $pdf->MultiCell($iFirstOffset , '','', 0, 'L', 0, 0, '' ,'', true);
    $pdf->MultiCell($iSecondOffset, '', $mPreparedContent['lci_edition']. '.-- '.$mPreparedContent['lci_place_of_publish'].': '.$mPreparedContent['lci_publisher'].' , '.$mPreparedContent['lci_year_published'].'.', 0, 'L', 0, 1, '' ,'', true);


    $pdf->MultiCell($iFirstOffset , '','', 0, 'L', 0, 0, '' ,'', true);
    $pdf->MultiCell($iSecondOffset, '',$mPreparedContent['lci_preliminary_page_no'].', ' .$mPreparedContent['lci_page_past_no'].'p;', 0, 'L', 0, 1, '' ,'', true);

/*
    $pdf->MultiCell($iFirstOffset , '','', 0, 'L', 0, 0, '' ,'', true);
    $pdf->MultiCell($iSecondOffset, '', $mPreparedContent['lci_title'], 0, 'L', 0, 1, '' ,'', true);
    $pdf->ln();*/
 /*   
    $pdf->ln();
 
    $pdf->MultiCell($iFirstOffset , '','', 0, 'L', 0, 0, '' ,'', true);
    $pdf->MultiCell($iSecondOffset, '', $mPreparedContent['lci_note'], 0, 'L', 0, 1, '' ,'', true);
    $pdf->ln(3);*/

 
    $pdf->MultiCell($iFirstOffset , '','', 0, 'L', 0, 0, '' ,'', true);
    $pdf->MultiCell($iSecondOffset, '', 'ISBN '.$mPreparedContent['lci_isbn'], 0, 'L', 0, 1, '' ,'', true);
   // $pdf->ln();
/*
 
    $pdf->MultiCell($iFirstOffset , '','', 0, 'L', 0, 0, '' ,'', true);
    $pdf->MultiCell($iSecondOffset, '', $mPreparedContent['lci_description'], 0, 'L', 0, 1, '' ,'', true);
    $pdf->ln();*/









    $pdf->Output( $mPreparedContent['lci_id'].'_'.$mPreparedContent['lci_callnumber'].'_'. date("Y-M-D h:i:s").'_report.pdf', 'I'); 
    return;

 

?>

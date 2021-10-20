<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];

		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$mpdf = new \Mpdf\Mpdf([
	    'fontDir' => array_merge($fontDirs, [
	        __DIR__ . '/ttfonts',
	    ]),
	    'fontdata' => $fontData + [
	        'frutiger' => [
	            'R' => 'FreeSans.ttf',
	            // 'I' => 'FrutigerObl-Normal.ttf',
	        ]
	    ],
	    'default_font' => 'frutiger'
		]);
      $html = $this->load->view('html_to_pdf',[],true);
      $mpdf->WriteHTML($html);
      $mpdf->Output();
	}
}


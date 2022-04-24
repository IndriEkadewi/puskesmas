<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name:  DOMPDF
* 
* Author: Jd Fiscus
* 	 	  jdfiscus@gmail.com
*         @iamfiscus
*          
*
* Origin API Class: http://code.google.com/p/dompdf/
* 
* Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
*          
* Created:  06.22.2010 
* 
* Description:  This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
* 
*/

// reference the Dompdf namespace
use Dompdf\Dompdf;

class Dompdf_gen {
    /**
     * CodeIgniter instance
     * @access protected
     */
    protected $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    /**
     * Print method to generate HTML into PDF
     * 
     * @access  public
     * @param   string  $view
     * @param   array   $data Store the view data
     * @param   string  $filename PDF file name output
     * @param   string  $paperSize the size of paper
     * @param   string  $orienntation the orientation of paper
     */

    public function print($view, $data = [], $filename = 'Doc', $paperSize = 'A4', $orientation = 'portrait') {
        // include autoloader
        require_once APPPATH.'third_party/dompdf/autoload.inc.php';
        $dompdf = new Dompdf();

        // Load html view and store data
        $dompdf->loadHtml($this->ci->load->view($view, $data, TRUE));

        // Set Paper Size and Orientation
        $dompdf->setPaper($paperSize, $orientation);

        // Render the HTML to PDF
        $dompdf->render();

        // Output the genrated PDF to Browser
        $dompdf->stream($filename.'.pdf',['Attachment' => FALSE]);
    }
}
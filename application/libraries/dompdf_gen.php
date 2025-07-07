<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Ini sudah BENAR, tidak perlu diganti
require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_gen {
    public $dompdf;

    public function __construct() {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true); // Untuk load gambar online
        $this->dompdf = new Dompdf($options);
    }

    public function load_html($html) {
        $this->dompdf->loadHtml($html);
    }

    public function set_paper($size = 'A4', $orientation = 'portrait') {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render() {
        $this->dompdf->render();
    }

    public function stream($filename = "document.pdf", $options = []) {
        $this->dompdf->stream($filename, $options);
    }
}

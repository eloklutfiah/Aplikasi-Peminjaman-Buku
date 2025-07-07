<?php  
defined('BASEPATH') or exit('No Direct script access allowed');  
class Laporan extends CI_Controller {  
    function __construct() {  
        parent::__construct();  
    }  

    public function laporan_buku() {  
        $data['judul'] = 'Laporan Data Buku';  
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();  
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();  
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();  
        $this->load->view('admin/header', $data);  
        $this->load->view('admin/sidebar', $data);  
        $this->load->view('admin/topbar', $data);  
        $this->load->view('buku/laporan_buku', $data);  
        $this->load->view('admin/footer');  
    } 

    public function cetak_laporan_buku(){ 
        $data['buku'] = $this->ModelBuku->getBuku()->result_array(); 
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array(); 
        $this->load->view('buku/laporan_print_buku',$data); 
    }

    public function laporan_buku_pdf() 
    { 
        $id_user = $this->session->userdata('id_user');   
        $this->load->library('dompdf_gen');
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();  
        $this->load->library('dompdf_gen'); 
        $this->load->view('buku/laporan_pdf_buku', $data);  
        $paper_size = 'A4';  
        // ukuran kertas  
        $orientation = 'landscape'; 
        //tipe format kertas potrait atau landscape  
        $html = $this->output->get_output();  
        $this->dompdf_gen->set_paper($paper_size, $orientation);   
        $this->dompdf_gen->load_html($html);  
        $this->dompdf_gen->render(); 
        $this->dompdf_gen->stream("laporanbuku.pdf", array('Attachment' => 0)); 
    }
    
    public function export_excel() 
    { 
        $data = array( 'title' => 'Laporan Buku','buku' => $this->ModelBuku->getBuku()->result_array()); 
        $this->load->view('buku/export_excel_buku', $data); 
    } 

    public function laporan_pinjam() 
    {  
        $data['judul'] = 'Laporan Data Peminjaman';  
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();  
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d, buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();  
        $this->load->view('admin/header', $data);  
        $this->load->view('admin/sidebar', $data);  
        $this->load->view('admin/topbar', $data);  
        $this->load->view('pinjam/laporan-pinjam', $data); 
        $this->load->view('admin/footer');  
    } 

    public function cetak_laporan_pinjam()  
    { 
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d, buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array(); 
        $this->load->view('pinjam/laporan-print-pinjam', $data);  
    }

    public function laporan_pinjam_pdf() 
    {  
        $this->load->library('dompdf_gen');  
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d, buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();  
        $this->load->view('pinjam/laporan-pdf-pinjam', $data);  
        $paper_size = 'A4'; // ukuran kertas  
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape  
        $html = $this->output->get_output();  
        $this->dompdf_gen->set_paper($paper_size, $orientation);  
        //Convert to PDF  
        $this->dompdf_gen->load_html($html);  
        $this->dompdf_gen->render();  
        $this->dompdf_gen->stream("laporan data peminjaman.pdf", array('Attachment' => 0));  
        // nama file pdf yang di hasilkan  
    }  

    public function export_excel_pinjam()  
    {  
        $data = array( 'title' => 'Laporan Data Peminjaman Buku', 'laporan' => $this->db->query("select * from pinjam p,detail_pinjam d, buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array());  
        $this->load->view('pinjam/export-excel-pinjam', $data);  
    }

    public function laporan_anggota()
    {
        $data['judul'] = 'Laporan Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' =>
            $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->ModelUser->getAnggota()->result_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('buku/laporan_anggota', $data); // arahkan ke views/buku/
        $this->load->view('admin/footer');
    }

    public function cetak_anggota()
    {
        $data['anggota'] = $this->ModelUser->getAnggota()->result_array();
        $this->load->view('buku/cetak_anggota', $data); // arahkan ke views/buku/
    }

    public function pdf_anggota()
    {
        $this->load->library('dompdf_gen');
        $data['anggota'] = $this->ModelUser->getAnggota()->result_array();
        $this->load->view('buku/pdf_anggota', $data);
        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf_gen->set_paper($paper_size, $orientation);
        $this->dompdf_gen->load_html($html);
        $this->dompdf_gen->render();
        $this->dompdf_gen->stream("laporan_data_anggota.pdf", array('Attachment' => 0));
    }

    public function excel_anggota()
    {
        $data['anggota'] = $this->ModelUser->getAnggota()->result_array();
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=laporan_data_anggota.xls");
        $this->load->view('buku/export_excel_anggota', $data); // arahkan ke views/buku/
    }

} 
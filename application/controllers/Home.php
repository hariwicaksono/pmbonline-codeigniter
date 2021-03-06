<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	} 

	public function index()
	{
        $site_info = $this->db->get('pengaturan', 1)->row();
        $data['site_name'] = $site_info->site_name;
        $data['site_title'] = $site_info->site_title;
        $data['site_address'] = $site_info->site_address;
        $data['site_alurpmb'] = $site_info->site_alurpmb;
        $data['site_logo'] = $site_info->site_logo;
        $data['site_favicon'] = $site_info->site_favicon;
        $data['site_phone'] = $site_info->site_phone;
        $data['site_email'] = $site_info->site_email;
        $data['site_website'] = $site_info->site_website;
        $data['site_facebook'] = $site_info->site_facebook;
        $data['site_youtube'] = $site_info->site_youtube;
        $data['site_instagram'] = $site_info->site_instagram;
        $data['site_theme'] = $site_info->site_theme;
        $data['site_google_maps'] = $site_info->site_google_maps;
        $kode_thak=$this->Model_app->kode_thak_aktif();
        $data['informasi']=$this->Model_app->get_all_info($kode_thak);
        $data['thak']=$this->Model_admin->ambil_thak_aktif();
        $data['prodi']=$this->Model_app->get_prodi();
        $data['prodi1']=$this->Model_app->get_prodi();
        $data['cek_reg']=$this->Model_cek->cek_reg();
        $data['jadwal_tes']=$this->Model_admin->get_all_tes($kode_thak);
        $data['header'] = $this->load->view('header',$data, true);
        $data['footer'] = $this->load->view('footer',$data, true);
        $data['navbar'] = $this->load->view('navbar',$data, true);
        $slideshow= $this->db->get('slideshow', 1)->row();
        $data['slide_1'] = $slideshow->slide_1;
        $data['slide_2'] = $slideshow->slide_2;
        $data['slide_3'] = $slideshow->slide_3;
        $data['slide_1_headline'] = $slideshow->slide_1_headline;
        $data['slide_1_caption'] = $slideshow->slide_1_caption;
        $data['slide_2_headline'] = $slideshow->slide_2_headline;
        $data['slide_2_caption'] = $slideshow->slide_2_caption;
        $data['slide_3_headline'] = $slideshow->slide_3_headline;
        $data['slide_3_caption'] = $slideshow->slide_3_caption;
	$this->load->view('home',$data);
	}

	public function daftar()
	{
                $kode_thak=$this->Model_app->kode_thak_aktif();
                $nisn=$this->input->post('nisn', TRUE);
                $cek=$this->cek_nisn($nisn);
                if ($cek) {
                        $config['upload_path']          = './photo/';
                        $config['allowed_types']        = 'jpg|jpeg|png|bmp|gif';
                        $config['max_size']             = 5000;
                        $config['max_width']            = 5000;
                        $config['max_height']           = 5000;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('userfile'))
                        {
                               
                                $this->session->set_flashdata('error_daftar', '<div class="alert alert-danger">
                                <i class="icon fa fa-exclamation-triangle"></i> Perhatian! '.$this->upload->display_errors().'
                                        </div>');
                                redirect('home');
                        }
                        else
                        {
                                $poto = $this->upload->data();
                              
                                $nisn=strtoupper($this->input->post('nisn', TRUE));
                                $nama=strtoupper($this->input->post('nama', TRUE));
                                $nikktp=$this->input->post('nikktp', TRUE);
                                $agama=strtoupper($this->input->post('agama', TRUE));
                                $jkel=$this->input->post('jenisKelamin', TRUE);
                                $tgl=$this->input->post('tgl_lahir', TRUE);
                                $alamat=strtoupper($this->input->post('alamat', TRUE));
                                $hp=$this->input->post('hp', TRUE);
                                $email=$this->input->post('email', TRUE);
                                $sekolah=strtoupper($this->input->post('sekolah', TRUE));
                                $kota=strtoupper($this->input->post('kota_sekolah', TRUE));
                                $nilai=$this->input->post('nilai_un', TRUE);
                                $prodi=$this->input->post('prodi', TRUE);
                                $poto=$poto['file_name'];
                                $t = date("Y-m-d H:i:s");

                                $data=array(
                                    'thak'=>$kode_thak,
                                    'nama_pendaftar'=>$nama,
                                    'nikktp'=>$nikktp,
                                    'nisn'=>$nisn,
                                    'tgl_lahir'=>$tgl,
                                    'jkel'=>$jkel,
                                    'agama'=>$agama,
                                    'sekolah'=>$sekolah,
                                    'kota'=>$kota,
                                    'alamat'=>$alamat,
                                    'no_hp'=>$hp,
                                    'email'=>$email,
                                    'prodi'=>$prodi,
                                    'nilai_un'=>$nilai,
                                    'daftar_tgl'=>$t,
                                    'foto'=>$poto
                                    );
                                $result=$this->Model_app->register_siswa($data);
                                if ($result) {
                                       $this->session->set_flashdata('error_daftar', '<div class="alert alert-success  wow zoomInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
                                           <strong><i class="icon fa fa-check-square-o"></i> Selamat!, Pendaftaran Berhasil.</strong>
                                            <br>Silakan Cetak Bukti Pendaftaran <a href="'.base_url('home/cetak_bukti/'.$nisn.'').'" target="_blank">Disini</a>
                                             </div>');
                                }else{
                                        $this->session->set_flashdata('error_daftar', '<div class="alert alert-danger wow zoomInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
                                           <i class="icon fa fa-close "></i> Masalah Pendaftaran!
                                           
                                             </div>');
                                }
                                redirect('home');
                        }
                }else{
                        $this->session->set_flashdata('error_daftar', '<div class="alert alert-danger  wow zoomInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
                        <i class="icon fa fa-warning"></i> Maaf, NISN Sudah Terdaftar, Tidak Bisa Mendaftar ulang.
                        <br>Apakah Anda Lupa Mencetak Bukti Pendaftaran? <br><a href="'.base_url('home/cetak_bukti/'.$nisn.'').'" target="_blank">Cetak kembali bukti pendaftaran</a>
                                </div>');
                        redirect('home');
                }
		
	}

    private function cek_nisn($nisn)
    {
            $cek=$this->Model_cek->cek_nisn($nisn);
            if ($cek) {
                    return true;
            }else{
                    return false;
            }
    }

    public function cetak_bukti($id)
    {
        $this->load->library('pdfgenerator');
        $site_info = $this->db->get('pengaturan', 1)->row();
        $this->data['row'] = $site_info;
        $kode_thak=$this->Model_app->kode_thak_aktif();
        $this->data['data']=$this->Model_app->cetak_form($id);
        $this->data['jadwal']=$this->Model_admin->get_all_tes($kode_thak);
   
        $pdfFilePath ="registrasi-".time()."-download.pdf";
        $paper = 'A4';
        $orientation = "portrait";
        
        $html=$this->load->view('bukti_reg', $this->data, true);

        $this->pdfgenerator->generate($html, $pdfFilePath, $paper, $orientation);

    }

    public function pengumuman_maba($kode)
    {
        $thak=$this->Model_app->kode_thak_aktif();
        $limit=$this->Model_app->get_limit($kode);
        $array = array('pendaftaran.thak' => $thak, 'pendaftaran.prodi' => $kode);
        $d['det']=$this->Model_app->detail_lulus_prodi($kode);
        $d['thak']=$this->Model_admin->ambil_thak_aktif();
        $d['maba']=$this->Model_app->siswa_lulus($array,$limit);
        $this->load->view('pengumuman',$d);
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
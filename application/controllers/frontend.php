<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_frontend');
    }

    public function index(){
    	$data['base']               = 'Home';

        $data['slider']             = $this->m_frontend->getSlider();
        $data['category']           = $this->m_frontend->getCategory();
        $data['kegiatan']           = $this->m_frontend->getKegiatan();
        $data['mitra']              = $this->m_frontend->getMitra();

        $data['mainpage']           = 'frontend/home';
        $this->load->view('frontend/templates', $data);
    }

    public function category(){
        $root                        = $this->uri->segment(2);
        $data['base']                = $root;
        $limit                       = 24;

        $categoryId                  = $this->m_frontend->getCategoryId($root);
        $data['category']            = $this->m_frontend->getCategory();

        $this->updateCountCategory($categoryId[0]->id);

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id_category', $categoryId[0]->id);
        $this->db->limit($limit, $this->uri->segment(3));
        $data['product']             = $this->db->get('product')->result();

        $this->db->where('status', '1');
        $this->db->where('id_category', $categoryId[0]->id);
        $data['total']               = $this->db->get('product')->num_rows();

        $this->load->library('pagination');
        $config['base_url']          = site_url('category/'.$root);
        $config['total_rows']        = $data['total'];
        $config['per_page']          = $limit;
        $config['uri_segment']       = 3;
        $config['num_links']         = 2;
        $config['prev_link']         = '&laquo;';
        $config['prev_tag_open']     = '<li><span><span aria-hidden="true">';
        $config['prev_tag_close']    = '</span></span></li>';
        $config['next_link']         = '»';
        $config['next_tag_open']     = '<li><span aria-hidden="true">';
        $config['next_tag_close']    = '</span></li>';
        $config['last_link']         = '';
        $config['last_tag_open']     = '';
        $config['last_tag_close']    = '';
        $config['first_link']        = '';
        $config['first_tag_open']    = '';
        $config['first_tag_close']   = '';
        $config['num_tag_open']      = '<li><span>';
        $config['num_tag_close']     = '</span></li>';
        $config['cur_tag_open']      = '<li class="active"><span>';
        $config['cur_tag_close']     = '<span class="sr-only">(current)</span></span></li>';
        $config['full_tag_open']     = '<ul class="pagination pagination-sm">';
        $config['full_tag_close']    = '</ul>';

        $this->pagination->initialize($config);
        $data['page_links'] = $this->pagination->create_links();

        $data['mainpage']            = 'frontend/channel/category';
        $this->load->view('frontend/templates', $data);
    }

    public function produk(){
        $data['base']                = 'Produk';
        $permalink                   = $this->uri->segment(2);

        $data['category']            = $this->m_frontend->getCategory();
        $data['detail']              = $this->m_frontend->getProductDetail($permalink);

        $this->updateCountProduct($data['detail'][0]->id);

        $data['mainpage']            = 'frontend/detail/product';
        $this->load->view('frontend/templates', $data);
    }

    public function kegiatan(){
        $data['base']                = 'Kegiatan';
        $limit                       = 6;

        $data['category']            = $this->m_frontend->getCategory();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->limit($limit, $this->uri->segment(2));
        $data['kegiatan']            = $this->db->get('kegiatan')->result();

        $this->db->where('status', '1');
        $data['total']               = $this->db->get('kegiatan')->num_rows();

        $this->load->library('pagination');
        $config['base_url']          = site_url('kegiatan');
        $config['total_rows']        = $data['total'];
        $config['per_page']          = $limit;
        $config['uri_segment']       = 2;
        $config['num_links']         = 2;
        $config['prev_link']         = '&laquo;';
        $config['prev_tag_open']     = '<li><span><span aria-hidden="true">';
        $config['prev_tag_close']    = '</span></span></li>';
        $config['next_link']         = '»';
        $config['next_tag_open']     = '<li><span aria-hidden="true">';
        $config['next_tag_close']    = '</span></li>';
        $config['last_link']         = '';
        $config['last_tag_open']     = '';
        $config['last_tag_close']    = '';
        $config['first_link']        = '';
        $config['first_tag_open']    = '';
        $config['first_tag_close']   = '';
        $config['num_tag_open']      = '<li><span>';
        $config['num_tag_close']     = '</span></li>';
        $config['cur_tag_open']      = '<li class="active"><span>';
        $config['cur_tag_close']     = '<span class="sr-only">(current)</span></span></li>';
        $config['full_tag_open']     = '<ul class="pagination pagination-sm">';
        $config['full_tag_close']    = '</ul>';

        $this->pagination->initialize($config);
        $data['page_links'] = $this->pagination->create_links();

        $data['mainpage']            = 'frontend/channel/kegiatan';
        $this->load->view('frontend/templates', $data);
    }

    public function kegiatanDetail(){
        $data['base']                = 'Kegiatan';
        $permalink                   = $this->uri->segment(2);

        $data['category']            = $this->m_frontend->getCategory();
        $data['detail']              = $this->m_frontend->getKegiatanDetail($permalink);

        $this->updateCountKegiatan($data['detail'][0]->id);

        $data['mainpage']            = 'frontend/detail/kegiatan';
        $this->load->view('frontend/templates', $data);
    }

    public function profile(){
        $data['base']               = 'Profile';

        $data['category']           = $this->m_frontend->getCategory();
        $data['profile']            = $this->m_frontend->getProfile();

        $data['mainpage']           = 'frontend/channel/profile';
        $this->load->view('frontend/templates', $data);
    }

    public function contactus(){
        $data['base']               = 'Contact';

        $data['category']           = $this->m_frontend->getCategory();

        if ($this->input->post('submit')) {

        }

        $data['mainpage']           = 'frontend/channel/contactus';
        $this->load->view('frontend/templates', $data);
    }

    public function contactusold(){
        $data['base'] = 'Contact';

        require_once APPPATH."/third_party/recaptchalib.php";
        
        $data['siteKey'] = "6LcmqxATAAAAAM9nCIGDsZ2rIzksO0SJpLK6_5KC";
        $secret = "6LcmqxATAAAAALF7EgDXUdKc4GoBqHsOZumpwra2";
        // reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
        $data['lang'] = "en";
        // The response from reCAPTCHA
        $resp = null;
        // The error code from reCAPTCHA, if any
        $error = null;
        $reCaptcha = new ReCaptcha($secret);
        // Was there a reCAPTCHA response?
        if ($this->input->post('g-recaptcha-response')) {
            $resp = $reCaptcha->verifyResponse(
                    $_SERVER["REMOTE_ADDR"], $this->input->post('g-recaptcha-response')
            );
        }

        if ($this->input->post('submit')) {
            //validation
            $valid = $this->form_validation;
            $valid->set_rules('nama', 'Nama', 'required');
            $valid->set_rules('email', 'Email', 'strtolower|required|valid_email');
            $valid->set_rules('tlp', 'Telepon', 'required|integer');
            $valid->set_rules('kota', 'Kota', 'required');
            $valid->set_rules('negara', 'Negara', 'required');
            $valid->set_rules('perusahaan', 'Perusahaan', 'required');
            $valid->set_rules('isi', 'Isi Pesan', 'required|min_length[3]');

            if ($valid->run() == false) {
                
            } else {
                if ($resp != null && $resp->success) {

                    $config = array(
                            'protocol' => 'smtp',
                            'smtp_host' => 'smtp.mailgun.org',
                            'smtp_port' => 587,
                            'smtp_user' => 'postmaster@gramediamajalah.com',
                            'smtp_pass' => '7df21f61bff564ffd1eef1ca8f991ff7',
                            'mailtype' => 'text',
                            'charset' => 'utf-8',
                            'wordwrap' => true
                        );

                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from($this->input->post('email'), $this->input->post('nama'));
                    $this->email->to('Autobacs.ID@gmail.com');
                    $this->email->subject($this->input->post('nama'));
                    
                    $isi = "Nama: ".$this->input->post('nama')."\n"."Email: ".$this->input->post('email')."\n"."Telp: ".$this->input->post('tlp')."\n"."Kota: ".$this->input->post('kota')."\n"."Negara: ".$this->input->post('negara')."\n"."Perusahaan: ".$this->input->post('perusahaan')."\n\n"."Isi Pesan: \n".$this->input->post('isi');
                    $this->email->message($isi);
                    if ($this->email->send()) {
                        $this->session->set_flashdata('success', 'Email Sent');
                        redirect(current_url());
                    } else {
                        show_error($this->email->print_debugger());
                    }
                } else {
                    echo "<script>alert('Maaf kode captcha yang anda masukan tidak valid');</script>";
                }
            }
        }

        $data['mainpage'] = 'frontend/contactus';
        $this->load->view('frontend/templates', $data);
    }

    function updateCountCategory($id) {
        $query = $this->m_frontend->get_count_category($id);

        if (count($query) > 0) {
            $counter = array(
                'counter_count' => $query[0]['counter_count'] + 1,
                'counter_count_date' => date('Y-m-d H:i:s')
            );

            $this->m_frontend->count_view_category($counter, $id);
        } else {
            $counter = array(
                'counter_category_id' => $id,
                'counter_count' => 1,
                'counter_count_date' => date('Y-m-d H:i:s')
            );

            $this->m_frontend->save_count_view_category($counter);
        }
    }

    function updateCountProduct($id) {
        $query = $this->m_frontend->get_count_product($id);

        if (count($query) > 0) {
            $counter = array(
                'counter_count' => $query[0]['counter_count'] + 1,
                'counter_count_date' => date('Y-m-d H:i:s')
            );

            $this->m_frontend->count_view_product($counter, $id);
        } else {
            $counter = array(
                'counter_product_id' => $id,
                'counter_count' => 1,
                'counter_count_date' => date('Y-m-d H:i:s')
            );

            $this->m_frontend->save_count_view_product($counter);
        }
    }

    function updateCountKegiatan($id) {
        $query = $this->m_frontend->get_count_kegiatan($id);

        if (count($query) > 0) {
            $counter = array(
                'counter_count' => $query[0]['counter_count'] + 1,
                'counter_count_date' => date('Y-m-d H:i:s')
            );

            $this->m_frontend->count_view_kegiatan($counter, $id);
        } else {
            $counter = array(
                'counter_kegiatan_id' => $id,
                'counter_count' => 1,
                'counter_count_date' => date('Y-m-d H:i:s')
            );

            $this->m_frontend->save_count_view_kegiatan($counter);
        }
    }

}
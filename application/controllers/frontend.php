<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_frontend');
    }

    function updateCount($id) {
        $query = $this->m_frontend->get_count($id);

        if (count($query) > 0) {
            $counter = array(
                'counter_count' => $query[0]['counter_count'] + 1,
                'counter_count_date' => date('Y-m-d H:i:s')
            );

            $this->m_frontend->count_view($counter, $id);
        } else {
            $counter = array(
                'counter_article_id' => $id,
                'counter_count' => 1,
                'counter_count_date' => date('Y-m-d H:i:s')
            );

            $this->m_frontend->save_count_view($counter);
        }
    }

    public function index(){
    	$data['base'] = 'Home';

        $data['mainpage'] = 'frontend/home';
        $this->load->view('frontend/templates', $data);
    }

    public function contactus(){
        $data['base'] = 'Aboutus';

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

}
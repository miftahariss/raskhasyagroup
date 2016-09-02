<?php

/**
 * Description of acladmin
 *
 * @author digit002
 */
class Acladmin extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('acladminmodel');

        if (!$this->session->userdata('login')) {
            redirect('backend/cmsauth');
        }
        $this->sess_id = $this->session->userdata('user_id');
    }

    public function get_youtube_id_from_url($url)
    {
        if (stristr($url,'youtu.be/'))
            {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
        else 
            {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
    }

    private function onlyAdmin() {
        if ($this->session->userdata('role') != 1) {
            redirect('backend/acladmin');
        }
    }

    public function index() {
        $data['page'] = 'home';
        $data['title'] = 'Home';
        $this->load->view('acladmin/main', $data);
    }

    private function upload_gallery() {
        $this->load->library('image_lib');
        $format_upload = '';
        $files = $_FILES;
        $cpt = count($_FILES['galleryfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $rename = url_title(time()) . $i;

            $_FILES['galleryfile']['name'] = $files['galleryfile']['name'][$i];
            $_FILES['galleryfile']['type'] = $files['galleryfile']['type'][$i];
            $_FILES['galleryfile']['tmp_name'] = $files['galleryfile']['tmp_name'][$i];
            $_FILES['galleryfile']['error'] = $files['galleryfile']['error'][$i];
            $_FILES['galleryfile']['size'] = $files['galleryfile']['size'][$i];

            if (isset($_FILES['galleryfile']['name']) && $_FILES['galleryfile']['name'] != "") {

                $base_path = APPPATH . '../asset_admin/assets/uploads/cover/';
                chmod($base_path, 0777);
                $ori_path = $base_path . 'original/';

                $size = array(
                    array('width' => '150', 'height' => '150', 'type' => 'small'),
                    array('width' => '300', 'height' => '300', 'type' => 'medium'),
                    array('width' => '650', 'height' => '650', 'type' => 'large'),
                );

                //UPLOAD ORG IMAGE
                $config = array(
                    'upload_path' => $ori_path,
                    'allowed_types' => 'gif|jpg|jpeg|png',
                    'max_size' => '2048'
                );
                $this->load->library('upload', $config);
                $this->upload->do_upload('galleryfile');

                foreach ($size as $value) {

                    $image_data = $this->upload->data();

                    //RESIZE IMAGE
                    $config_thumb = array(
                        'image_library' => 'gd2',
                        'source_image' => $image_data['full_path'],
                        'new_image' => $base_path . $value["type"],
                        'create_thumb' => false,
                        'maintain_ratio' => true,
                        'width' => $value['width'],
                        'height' => $value['width']
                    );

                    $this->image_lib->initialize($config_thumb);
                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    }

                    //CROPING
                    switch ($value['type']) {
                        case 'small':
                            $meta_image['small'] = $base_path . 'small' . '/' . $rename . $image_data['file_ext'];
                            break;
                        case 'medium':
                            $meta_image['medium'] = $base_path . 'medium' . '/' . $rename . $image_data['file_ext'];
                            break;
                        case 'large':
                            $meta_image['large'] = $base_path . 'large' . '/' . $rename . $image_data['file_ext'];
                            break;
                    }

                    $config_crop = array(
                        'image_library' => 'gd2',
                        'source_image' => $base_path . $value["type"] . '/' . $image_data['raw_name'] . $image_data['file_ext'],
                        'new_image' => $base_path . $value["type"] . '/' . $rename . $image_data['file_ext'],
                        'create_thumb' => false,
                        'maintain_ratio' => true,
                    );

                    $this->image_lib->initialize($config_crop);
                    if (!$this->image_lib->crop()) {
                        echo $this->image_lib->display_errors();
                    }

                    //DELETE RESIZE IMAGE
                    unlink($base_path . $value["type"] . '/' . $image_data['raw_name'] . $image_data['file_ext']);
                    $this->image_lib->clear();
                }

                rename($image_data['full_path'], $ori_path . $rename . $image_data['file_ext']);
                $format_upload[] = $rename . $image_data['file_ext'];
            }
        }

        return $format_upload;
    }

    /**
     * Upload images
     * @return string
     */
    private function upload() {
        $this->load->library('image_lib');
        $format_upload = '';
        $rename = url_title(time());
        if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != "") {

            $base_path = APPPATH . '../asset_admin/assets/uploads/cover/';
            chmod($base_path, 0777);
            $ori_path = $base_path . 'original/';

            $size = array(
                array('width' => '150', 'height' => '150', 'type' => 'small'),
                array('width' => '300', 'height' => '300', 'type' => 'medium'),
                array('width' => '650', 'height' => '650', 'type' => 'large'),
            );

            //UPLOAD ORG IMAGE
            $config = array(
                'upload_path' => $ori_path,
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => '2048'
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload();

            foreach ($size as $value) {

                $image_data = $this->upload->data();

                //RESIZE IMAGE
                $config_thumb = array(
                    'image_library' => 'gd2',
                    'source_image' => $image_data['full_path'],
                    'new_image' => $base_path . $value["type"],
                    'create_thumb' => false,
                    'maintain_ratio' => true,
                    'width' => $value['width'],
                    'height' => $value['width']
                );

                $this->image_lib->initialize($config_thumb);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }

                //CROPING
                switch ($value['type']) {
                    case 'small':
                        $meta_image['small'] = $base_path . 'small' . '/' . $rename . $image_data['file_ext'];
                        break;
                    case 'medium':
                        $meta_image['medium'] = $base_path . 'medium' . '/' . $rename . $image_data['file_ext'];
                        break;
                    case 'large':
                        $meta_image['large'] = $base_path . 'large' . '/' . $rename . $image_data['file_ext'];
                        break;
                }

                $config_crop = array(
                    'image_library' => 'gd2',
                    'source_image' => $base_path . $value["type"] . '/' . $image_data['raw_name'] . $image_data['file_ext'],
                    'new_image' => $base_path . $value["type"] . '/' . $rename . $image_data['file_ext'],
                    'create_thumb' => false,
                    'maintain_ratio' => true,
                );

                $this->image_lib->initialize($config_crop);
                if (!$this->image_lib->crop()) {
                    echo $this->image_lib->display_errors();
                }

                //DELETE RESIZE IMAGE
                unlink($base_path . $value["type"] . '/' . $image_data['raw_name'] . $image_data['file_ext']);
                $this->image_lib->clear();
            }

            rename($image_data['full_path'], $ori_path . $rename . $image_data['file_ext']);
            $format_upload = $rename . $image_data['file_ext'];
        }

        return $format_upload;
    }

    private function upload_foto() {
        $this->load->library('image_lib');
        $format_upload = '';
        $rename = url_title(time());
        if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != "") {

            $base_path = APPPATH . '../asset_admin/assets/uploads/cover/';
            chmod($base_path, 0777);
            $ori_path = $base_path . 'original/';

            $size = array(
                array('width' => '150', 'height' => '150', 'type' => 'small'),
                array('width' => '300', 'height' => '300', 'type' => 'medium'),
                array('width' => '650', 'height' => '650', 'type' => 'large'),
            );

            //UPLOAD ORG IMAGE
            $config = array(
                'upload_path' => $ori_path,
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => '2048'
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload();

            foreach ($size as $value) {

                $image_data = $this->upload->data();

                //RESIZE IMAGE
                $config_thumb = array(
                    'image_library' => 'gd2',
                    'source_image' => $image_data['full_path'],
                    'new_image' => $base_path . $value["type"],
                    'create_thumb' => false,
                    'maintain_ratio' => true,
                    'width' => $value['width'],
                    'height' => $value['width']
                );

                $this->image_lib->initialize($config_thumb);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }

                //CROPING
                switch ($value['type']) {
                    case 'small':
                        $meta_image['small'] = $base_path . 'small' . '/' . $rename . $image_data['file_ext'];
                        break;
                    case 'medium':
                        $meta_image['medium'] = $base_path . 'medium' . '/' . $rename . $image_data['file_ext'];
                        break;
                    case 'large':
                        $meta_image['large'] = $base_path . 'large' . '/' . $rename . $image_data['file_ext'];
                        break;
                }

                $config_crop = array(
                    'image_library' => 'gd2',
                    'source_image' => $base_path . $value["type"] . '/' . $image_data['raw_name'] . $image_data['file_ext'],
                    'new_image' => $base_path . $value["type"] . '/' . $rename . $image_data['file_ext'],
                    'create_thumb' => false,
                    'maintain_ratio' => true,
                );

                $this->image_lib->initialize($config_crop);
                if (!$this->image_lib->crop()) {
                    echo $this->image_lib->display_errors();
                }

                //DELETE RESIZE IMAGE
                unlink($base_path . $value["type"] . '/' . $image_data['raw_name'] . $image_data['file_ext']);
                $this->image_lib->clear();
            }

            rename($image_data['full_path'], $ori_path . $rename . $image_data['file_ext']);
            $format_upload = $rename . $image_data['file_ext'];
        }

        return $format_upload;
    }

    public function add_category() {
        $permalink = url_title($this->input->post('title'), 'dash', true);
        if ($this->input->post('submit')) {
            // validation
            $valid = $this->form_validation;
            $valid->set_rules('title', 'Judul', 'required');
            //$valid->set_rules('short_desc', 'Short Desc', 'required');
            //$valid->set_rules('body', 'Isi', 'required');
            if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] == "") {
                $valid->set_rules('userfile', 'Foto', 'required');
            }

            if ($valid->run() == false) {
                // run
            } else {

                $format_upload = $this->upload();
                $data = array(
                    'title' => $this->input->post('title'),
                    //'short_desc' => $this->input->post('short_desc'),
                    //'body' => $this->input->post('body'),
                    'filename' => $format_upload,
                    //'headline'         => $this->input->post('headline') ? 1 : 0,
                    'permalink' => $permalink,
                    'created_date' => time(),
                    'modified_date' => null,
                    'created_by' => $this->sess_id,
                    'modified_by' => null,
                    'status' => 1,
                );

                $id = $this->acladminmodel->addCategory($data);

                redirect('backend/acladmin/view_category');
            }
        }
        $data['page'] = 'add_category';
        $data['title'] = 'Tambah Category Baru';

        $data['content'] = $this->load->view('acladmin/module/add_category', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function add_product() {
        $permalink = url_title($this->input->post('title'), 'dash', true);
        if ($this->input->post('submit')) {
            // validation
            $valid = $this->form_validation;
            $valid->set_rules('title', 'Judul', 'required');
            $valid->set_rules('short_desc', 'Short Desc', 'required');
            $valid->set_rules('id_category', 'Category', 'required');
            //$valid->set_rules('body', 'Isi', 'required');
            if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] == "") {
                $valid->set_rules('userfile', 'Foto', 'required');
            }

            if ($valid->run() == false) {
                // run
            } else {

                $format_upload = $this->upload();
                //$video_id = $this->get_youtube_id_from_url($this->input->post('video_id'));
                $data = array(
                    'id_category' => $this->input->post('id_category'),
                    'title' => $this->input->post('title'),
                    'short_desc' => $this->input->post('short_desc'),
                    'body' => $this->input->post('body'),
                    'filename' => $format_upload,
                    //'headline'         => $this->input->post('headline') ? 1 : 0,
                    'permalink' => $permalink,
                    'created_date' => time(),
                    'modified_date' => null,
                    'created_by' => $this->sess_id,
                    'modified_by' => null,
                    'status' => 1,
                );

                $id = $this->acladminmodel->addProduct($data);

                redirect('backend/acladmin/view_product');
            }
        }
        $data['page'] = 'add_product';
        $data['title'] = 'Tambah Product Baru';

        $data['content'] = $this->load->view('acladmin/module/add_product', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function add_kegiatan() {
        $permalink = url_title($this->input->post('title'), 'dash', true);
        if ($this->input->post('submit')) {
            // validation
            $valid = $this->form_validation;
            $valid->set_rules('title', 'Judul', 'required');
            $valid->set_rules('short_desc', 'Short Desc', 'required');
            //$valid->set_rules('body', 'Isi', 'required');
            if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] == "") {
                $valid->set_rules('userfile', 'Foto', 'required');
            }

            if ($valid->run() == false) {
                // run
            } else {

                $format_upload = $this->upload();
                $data = array(
                    'title' => $this->input->post('title'),
                    'short_desc' => $this->input->post('short_desc'),
                    'body' => $this->input->post('body'),
                    'filename' => $format_upload,
                    //'headline'         => $this->input->post('headline') ? 1 : 0,
                    'permalink' => $permalink,
                    'created_date' => time(),
                    'modified_date' => null,
                    'created_by' => $this->sess_id,
                    'modified_by' => null,
                    'status' => 1,
                );

                $id = $this->acladminmodel->addKegiatan($data);

                redirect('backend/acladmin/view_kegiatan');
            }
        }
        $data['page'] = 'add_kegiatan';
        $data['title'] = 'Tambah Kegiatan Baru';

        $data['content'] = $this->load->view('acladmin/module/add_kegiatan', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function add_mitra() {
        $permalink = url_title($this->input->post('title'), 'dash', true);
        if ($this->input->post('submit')) {
            // validation
            $valid = $this->form_validation;
            $valid->set_rules('title', 'Judul', 'required');
            $valid->set_rules('short_desc', 'Short Desc', 'required');
            //$valid->set_rules('body', 'Isi', 'required');
            if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] == "") {
                $valid->set_rules('userfile', 'Foto', 'required');
            }

            if ($valid->run() == false) {
                // run
            } else {

                $format_upload = $this->upload();
                $data = array(
                    'title' => $this->input->post('title'),
                    'short_desc' => $this->input->post('short_desc'),
                    'body' => $this->input->post('body'),
                    'filename' => $format_upload,
                    //'headline'         => $this->input->post('headline') ? 1 : 0,
                    'permalink' => $permalink,
                    'created_date' => time(),
                    'modified_date' => null,
                    'created_by' => $this->sess_id,
                    'modified_by' => null,
                    'status' => 1,
                );

                $id = $this->acladminmodel->addMitra($data);

                redirect('backend/acladmin/view_mitra');
            }
        }
        $data['page'] = 'add_mitra';
        $data['title'] = 'Tambah Mitra Baru';

        $data['content'] = $this->load->view('acladmin/module/add_mitra', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function add_kategori() {
        $permalink = url_title($this->input->post('title'), 'dash', true);
        if ($this->input->post('submit')) {
            // validation
            $valid = $this->form_validation;
            $valid->set_rules('title', 'Judul', 'required');
            $valid->set_rules('short_desc', 'Short Desc', 'required');

            if ($valid->run() == false) {
                // run
            } else {
                $data = array(
                    'id_account' => 1,
                    'title' => $this->input->post('title'),
                    'short_desc' => $this->input->post('short_desc'),
                    //'headline'         => $this->input->post('headline') ? 1 : 0,
                    'permalink' => $permalink,
                    'created_date' => time(),
                    'modified_date' => null,
                    'created_by' => $this->sess_id,
                    'modified_by' => null,
                    'status' => 1,
                );

                $id = $this->acladminmodel->addKategori($data);

                redirect('backend/acladmin/view_kategori');
            }
        }
        $data['page'] = 'add_kategori';
        $data['title'] = 'Tambah Kategori Baru';

        $data['content'] = $this->load->view('acladmin/module/add_kategori', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function add_article() {
        $permalink = url_title($this->input->post('title'), 'dash', true);
        if ($this->input->post('submit')) {
            // validation
            $valid = $this->form_validation;
            $valid->set_rules('title', 'Judul', 'required');
            $valid->set_rules('short_desc', 'Short Desc', 'required');
            $valid->set_rules('body', 'Isi', 'required');
            if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] == "") {
                $valid->set_rules('userfile', 'Foto', 'required');
            }

            if ($valid->run() == false) {
                // run
            } else {

                $format_upload = $this->upload();
                $video_id = $this->get_youtube_id_from_url($this->input->post('video_id'));
                $data = array(
                    'id_account' => 1,
                    'id_kategori' => $this->input->post('id_kategori'),
                    'title' => $this->input->post('title'),
                    'short_desc' => $this->input->post('short_desc'),
                    'video_id' => $video_id,
                    'body' => $this->input->post('body'),
                    'filename' => $format_upload,
                    'home' => $this->input->post('home') ? 1 : 0,
                    //'headline'         => $this->input->post('headline') ? 1 : 0,
                    'permalink' => $permalink,
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'meta_description' => $this->input->post('meta_description'),
                    'created_date' => time(),
                    'modified_date' => null,
                    'created_by' => $this->sess_id,
                    'modified_by' => null,
                    'status' => 1,
                );

                $id = $this->acladminmodel->addArticle($data);
                if ($id) {
                    $gallery = $this->upload_gallery();
                    $this->acladminmodel->addGalleryArticle($gallery, $id);
                }
                redirect('backend/acladmin/view_article');
            }
        }
        $data['page'] = 'add_article';
        $data['title'] = 'Tambah Article Baru';

        $data['content'] = $this->load->view('acladmin/module/add_article', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function add_slider() {
        $permalink = url_title($this->input->post('title'), 'dash', true);
        if ($this->input->post('submit')) {
            // validation
            $valid = $this->form_validation;
            $valid->set_rules('title', 'Judul', 'required');
            if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] == "") {
                //$valid->set_rules('userfile', 'Foto', 'required');
            }

            if ($valid->run() == false) {
                // run
            } else {

                $this->db->select('MAX(order_number) as max_order_number');
                $this->db->where('status', 1);
                $max_order = $this->db->get('slider')->row_array();
                $new_order = $max_order['max_order_number'] + 1;

                $format_upload = $this->upload();
                $data = array(
                    //'id_account' => 1,
                    'title' => $this->input->post('title'),
                    'link' => $this->input->post('link'),
                    'filename' => $format_upload,
                    'order_number' => $new_order,
                    'permalink' => $permalink,
                    'created_date' => time(),
                    'modified_date' => null,
                    'created_by' => $this->sess_id,
                    'modified_by' => null,
                    'status' => 1,
                );

                $id = $this->acladminmodel->addSlider($data);
//                if ($id) {
//                    $gallery = $this->upload_gallery();
//                    $this->acladminmodel->addGalleryArticle($gallery, $id);
//                }
                redirect('backend/acladmin/view_slider');
            }
        }
        $data['page'] = 'add_slider';
        $data['title'] = 'Tambah Slider Baru';

        $data['content'] = $this->load->view('acladmin/module/add_slider', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_category() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $this->load->library('pagination');
        $config['base_url'] = site_url('backend/acladmin/view_category');
        $config['per_page'] = $this->limit;
        $config['total_rows'] = $this->acladminmodel->countCategory(1);
        $config['uri_segment'] = 4;
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4) ? $this->uri->segment(4) : '');
        $data['media'] = $this->acladminmodel->fetchCategory($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['page'] = 'view_category';
        $data['title'] = 'Category';
        $data['content'] = $this->load->view('acladmin/module/view_category', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_product() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $this->load->library('pagination');
        $config['base_url'] = site_url('backend/acladmin/view_product');
        $config['per_page'] = $this->limit;
        $config['total_rows'] = $this->acladminmodel->countProduct(1);
        $config['uri_segment'] = 4;
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4) ? $this->uri->segment(4) : '');
        $data['media'] = $this->acladminmodel->fetchProduct($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['page'] = 'view_product';
        $data['title'] = 'Product';
        $data['content'] = $this->load->view('acladmin/module/view_product', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_kegiatan() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $this->load->library('pagination');
        $config['base_url'] = site_url('backend/acladmin/view_kegiatan');
        $config['per_page'] = $this->limit;
        $config['total_rows'] = $this->acladminmodel->countKegiatan(1);
        $config['uri_segment'] = 4;
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4) ? $this->uri->segment(4) : '');
        $data['media'] = $this->acladminmodel->fetchKegiatan($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['page'] = 'view_kegiatan';
        $data['title'] = 'Kegiatan';
        $data['content'] = $this->load->view('acladmin/module/view_kegiatan', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_mitra() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $this->load->library('pagination');
        $config['base_url'] = site_url('backend/acladmin/view_mitra');
        $config['per_page'] = $this->limit;
        $config['total_rows'] = $this->acladminmodel->countMitra(1);
        $config['uri_segment'] = 4;
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4) ? $this->uri->segment(4) : '');
        $data['media'] = $this->acladminmodel->fetchMitra($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['page'] = 'view_mitra';
        $data['title'] = 'Mitra';
        $data['content'] = $this->load->view('acladmin/module/view_mitra', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_profile() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $data['banner'] = $this->acladminmodel->fetchProfile();
        $data['page'] = 'view_profile';
        $data['title'] = 'Profile';
        $data['content'] = $this->load->view('acladmin/module/view_profile', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_contact() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $data['banner'] = $this->acladminmodel->fetchContact();
        $data['page'] = 'view_contact';
        $data['title'] = 'Contact';
        $data['content'] = $this->load->view('acladmin/module/view_contact', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_kategori() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $this->load->library('pagination');
        $config['base_url'] = site_url('backend/acladmin/view_kategori');
        $config['per_page'] = $this->limit;
        $config['total_rows'] = $this->acladminmodel->countKategori(1);
        $config['uri_segment'] = 4;
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4) ? $this->uri->segment(4) : '');
        $data['media'] = $this->acladminmodel->fetchKategori($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['page'] = 'view_product';
        $data['title'] = 'Kategori';
        $data['content'] = $this->load->view('acladmin/module/view_kategori', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_article() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $this->load->library('pagination');
        $config['base_url'] = site_url('backend/acladmin/view_article');
        $config['per_page'] = $this->limit;
        $config['total_rows'] = $this->acladminmodel->countArticle(1);
        $config['uri_segment'] = 4;
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4) ? $this->uri->segment(4) : '');
        $data['media'] = $this->acladminmodel->fetchArticle($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['page'] = 'view_article';
        $data['title'] = 'Article';
        $data['content'] = $this->load->view('acladmin/module/view_article', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_slider() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $data['banner'] = $this->acladminmodel->fetchSlider(1);
        $data['page'] = 'view_slider';
        $data['title'] = 'Slider';
        $data['content'] = $this->load->view('acladmin/module/view_slider', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_archive_slider() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $data['banner'] = $this->acladminmodel->fetchSlider(0);
        $data['page'] = 'view_archive_slider';
        $data['title'] = 'Archive Slider';
        $data['content'] = $this->load->view('acladmin/module/view_archive_slider', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_popup() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $data['banner'] = $this->acladminmodel->fetchPopup();
        $data['page'] = 'view_popup';
        $data['title'] = 'PopUp';
        $data['content'] = $this->load->view('acladmin/module/view_popup', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_store() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $data['banner'] = $this->acladminmodel->fetchStore();
        $data['page'] = 'view_store';
        $data['title'] = 'Store';
        $data['content'] = $this->load->view('acladmin/module/view_store', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function view_about() {
        $data['headline'] = $this->input->get('filter') ? $this->input->get('filter') : '1';
        $data['banner'] = $this->acladminmodel->fetchAbout();
        $data['page'] = 'view_about';
        $data['title'] = 'Store';
        $data['content'] = $this->load->view('acladmin/module/view_about', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function edit_category() {
        $id = $this->uri->segment(4);
        if ($id) {
            $permalink = url_title($this->input->post('title'), 'dash', true);
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');
                //$valid->set_rules('short_desc', 'Short Desc', 'required');
                //$valid->set_rules('body', 'Isi', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $format_upload = $this->upload();
                    //$video_id = $this->get_youtube_id_from_url($this->input->post('video_id'));
                    if ($format_upload != "") {
                        $data = array(
                            'id' => $id,
                            'title' => $this->input->post('title'),
                            //'short_desc' => $this->input->post('short_desc'),
                            //'body' => $this->input->post('body'),
                            'filename' => $format_upload,
                            //'headline'         => $this->input->post('headline') ? 1 : 0,
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateCategory($data, $id);
                    } else {
                        $data = array(
                            'id' => $id,
                            'title' => $this->input->post('title'),
                            //'short_desc' => $this->input->post('short_desc'),
                            //'body' => $this->input->post('body'),
                            //'headline'         => $this->input->post('headline'),
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateCategory($data, $id);
                    }

                    redirect('backend/acladmin/view_category');
                }
            }
            $data['page'] = 'edit_category';
            $data['title'] = 'Edit Category';
            $data['article'] = $this->acladminmodel->getIdCategory($id);
            
            $data['content'] = $this->load->view('acladmin/module/edit_category', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_category');
        }
    }

    public function edit_product() {
        $id = $this->uri->segment(4);
        if ($id) {
            $permalink = url_title($this->input->post('title'), 'dash', true);
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');
                $valid->set_rules('short_desc', 'Short Desc', 'required');
                //$valid->set_rules('body', 'Isi', 'required');
                $valid->set_rules('id_category', 'Category', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $format_upload = $this->upload();
                    if ($format_upload != "") {
                        $data = array(
                            'id' => $id,
                            'id_category' => $this->input->post('id_category'),
                            'title' => $this->input->post('title'),
                            'short_desc' => $this->input->post('short_desc'),
                            'body' => $this->input->post('body'),
                            'filename' => $format_upload,
                            //'headline'         => $this->input->post('headline') ? 1 : 0,
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateProduct($data, $id);
                    } else {
                        $data = array(
                            'id' => $id,
                            'id_category' => $this->input->post('id_category'),
                            'title' => $this->input->post('title'),
                            'short_desc' => $this->input->post('short_desc'),
                            'body' => $this->input->post('body'),
                            //'headline'         => $this->input->post('headline'),
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateProduct($data, $id);
                    }

                    redirect('backend/acladmin/view_product');
                }
            }
            $data['page'] = 'edit_product';
            $data['title'] = 'Edit Product';
            $data['article'] = $this->acladminmodel->getIdProduct($id);
            
            $data['content'] = $this->load->view('acladmin/module/edit_product', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_product');
        }
    }

    public function edit_kegiatan() {
        $id = $this->uri->segment(4);
        if ($id) {
            $permalink = url_title($this->input->post('title'), 'dash', true);
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');
                $valid->set_rules('short_desc', 'Short Desc', 'required');
                //$valid->set_rules('body', 'Isi', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $format_upload = $this->upload();
                    if ($format_upload != "") {
                        $data = array(
                            'id' => $id,
                            'title' => $this->input->post('title'),
                            'short_desc' => $this->input->post('short_desc'),
                            'body' => $this->input->post('body'),
                            'filename' => $format_upload,
                            //'headline'         => $this->input->post('headline') ? 1 : 0,
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateKegiatan($data, $id);
                    } else {
                        $data = array(
                            'id' => $id,
                            'title' => $this->input->post('title'),
                            'short_desc' => $this->input->post('short_desc'),
                            'body' => $this->input->post('body'),
                            //'headline'         => $this->input->post('headline'),
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateKegiatan($data, $id);
                    }

                    redirect('backend/acladmin/view_kegiatan');
                }
            }
            $data['page'] = 'edit_kegiatan';
            $data['title'] = 'Edit Kegiatan';
            $data['article'] = $this->acladminmodel->getIdKegiatan($id);
            
            $data['content'] = $this->load->view('acladmin/module/edit_kegiatan', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_kegiatan');
        }
    }

    public function edit_mitra() {
        $id = $this->uri->segment(4);
        if ($id) {
            $permalink = url_title($this->input->post('title'), 'dash', true);
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');
                $valid->set_rules('short_desc', 'Short Desc', 'required');
                //$valid->set_rules('body', 'Isi', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $format_upload = $this->upload();
                    if ($format_upload != "") {
                        $data = array(
                            'id' => $id,
                            'title' => $this->input->post('title'),
                            'short_desc' => $this->input->post('short_desc'),
                            'body' => $this->input->post('body'),
                            'filename' => $format_upload,
                            //'headline'         => $this->input->post('headline') ? 1 : 0,
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateMitra($data, $id);
                    } else {
                        $data = array(
                            'id' => $id,
                            'title' => $this->input->post('title'),
                            'short_desc' => $this->input->post('short_desc'),
                            'body' => $this->input->post('body'),
                            //'headline'         => $this->input->post('headline'),
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateMitra($data, $id);
                    }

                    redirect('backend/acladmin/view_mitra');
                }
            }
            $data['page'] = 'edit_mitra';
            $data['title'] = 'Edit Mitra';
            $data['article'] = $this->acladminmodel->getIdMitra($id);
            
            $data['content'] = $this->load->view('acladmin/module/edit_mitra', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_mitra');
        }
    }

    public function edit_profile() {
        $id = $this->uri->segment(4);
        if ($id) {
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');
                $valid->set_rules('body', 'Isi', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $format_upload = $this->upload();
                    if ($format_upload != "") {
                        $data = array(
                                'id' => $id,
                                'title' => $this->input->post('title'),
                                'body' => $this->input->post('body'),
                                'filename' => $format_upload,
                                'modified_date' => time(),
                                'modified_by' => $this->sess_id,
                                'status' => 1
                            );
                        $this->acladminmodel->updateProfile($data, $id);
                    } else {
                        $data = array(
                                'id' => $id,
                                'title' => $this->input->post('title'),
                                'body' => $this->input->post('body'),
                                'modified_date' => time(),
                                'modified_by' => $this->sess_id,
                                'status' => 1
                            );
                        $this->acladminmodel->updateProfile($data, $id);
                    }

//                    $gallery = $this->upload_gallery();
//                    $this->acladminmodel->addGalleryArticle($gallery, $id);

                    redirect('backend/acladmin/view_profile');
                }
            }
            $data['page'] = 'edit_profile';
            $data['title'] = 'Edit Profile';
            $data['article'] = $this->acladminmodel->getIdProfile($id);
            //$data['photos']  = $this->acladminmodel->getIdGalleryArticle($id);

            $data['content'] = $this->load->view('acladmin/module/edit_profile', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_profile');
        }
    }

    public function edit_contact() {
        $id = $this->uri->segment(4);
        if ($id) {
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('alamat', 'Alamat', 'required');
                $valid->set_rules('email', 'Email', 'required');
                $valid->set_rules('telepon', 'Telepon', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $format_upload = $this->upload();
                    if ($format_upload != "") {
                        $data = array(
                                'id' => $id,
                                'alamat' => $this->input->post('alamat'),
                                'email' => $this->input->post('email'),
                                'telepon' => $this->input->post('telepon'),
                                'modified_date' => time(),
                                'modified_by' => $this->sess_id,
                                'status' => 1
                            );
                        $this->acladminmodel->updateContact($data, $id);
                    } else {
                        $data = array(
                                'id' => $id,
                                'alamat' => $this->input->post('alamat'),
                                'email' => $this->input->post('email'),
                                'telepon' => $this->input->post('telepon'),
                                'modified_date' => time(),
                                'modified_by' => $this->sess_id,
                                'status' => 1
                            );
                        $this->acladminmodel->updateContact($data, $id);
                    }

//                    $gallery = $this->upload_gallery();
//                    $this->acladminmodel->addGalleryArticle($gallery, $id);

                    redirect('backend/acladmin/view_contact');
                }
            }
            $data['page'] = 'edit_contact';
            $data['title'] = 'Edit Contact';
            $data['article'] = $this->acladminmodel->getIdContact($id);
            //$data['photos']  = $this->acladminmodel->getIdGalleryArticle($id);

            $data['content'] = $this->load->view('acladmin/module/edit_contact', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_contact');
        }
    }

    public function edit_kategori() {
        $id = $this->uri->segment(4);
        if ($id) {
            $permalink = url_title($this->input->post('title'), 'dash', true);
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');
                $valid->set_rules('short_desc', 'Short Desc', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $data = array(
                            'id' => $id,
                            'title' => $this->input->post('title'),
                            'short_desc' => $this->input->post('short_desc'),
                            //'headline'         => $this->input->post('headline') ? 1 : 0,
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                    );
                    $this->acladminmodel->updateKategori($data, $id);

                    redirect('backend/acladmin/view_kategori');
                }
            }
            $data['page'] = 'edit_kategori';
            $data['title'] = 'Edit Kategori';
            $data['article'] = $this->acladminmodel->getIdKategori($id);
            
            $data['content'] = $this->load->view('acladmin/module/edit_kategori', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_kategori');
        }
    }

    public function edit_article() {
        $id = $this->uri->segment(4);
        if ($id) {
            $permalink = url_title($this->input->post('title'), 'dash', true);
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');
                $valid->set_rules('short_desc', 'Short Desc', 'required');
                $valid->set_rules('body', 'Isi', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $format_upload = $this->upload();
                    $video_id = $this->get_youtube_id_from_url($this->input->post('video_id'));
                    if ($format_upload != "") {
                        $data = array(
                            'id' => $id,
                            'id_kategori' => $this->input->post('id_kategori'),
                            'title' => $this->input->post('title'),
                            'short_desc' => $this->input->post('short_desc'),
                            'video_id' => $video_id,
                            'body' => $this->input->post('body'),
                            'filename' => $format_upload,
                            'home'         => $this->input->post('home') ? 1 : 0,
                            'permalink' => $permalink,
                            'meta_keywords' => $this->input->post('meta_keywords'),
                            'meta_description' => $this->input->post('meta_description'),
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateArticle($data, $id);
                    } else {
                        $data = array(
                            'id' => $id,
                            'id_kategori' => $this->input->post('id_kategori'),
                            'title' => $this->input->post('title'),
                            'short_desc' => $this->input->post('short_desc'),
                            'video_id' => $video_id,
                            'body' => $this->input->post('body'),
                            'home'         => $this->input->post('home') ? 1 : 0,
                            'permalink' => $permalink,
                            'meta_keywords' => $this->input->post('meta_keywords'),
                            'meta_description' => $this->input->post('meta_description'),
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateArticle($data, $id);
                    }

                    $gallery = $this->upload_gallery();
                    $this->acladminmodel->addGalleryArticle($gallery, $id);

                    redirect('backend/acladmin/view_article');
                }
            }
            $data['page'] = 'edit_article';
            $data['title'] = 'Edit Article';
            $data['article'] = $this->acladminmodel->getIdArticle($id);
            $data['photos']  = $this->acladminmodel->getIdGalleryArticle($id);
            
            $data['content'] = $this->load->view('acladmin/module/edit_article', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_article');
        }
    }

    public function edit_product_gallery_foto() {
        $id3 = $this->uri->segment(4);
        $id4 = $this->uri->segment(5);
        if ($id3 && $id4) {
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules("title", "Judul Foto", "required");
                $valid->set_rules("body", "Deskripsi Foto", "required");

                if ($valid->run() == false) {
                    // view
                } else {
                    $format_upload = $this->upload();
                    if ($format_upload != '') {
                        $data = array(
                            'title' => $this->input->post('title'),
                            'body' => $this->input->post('body'),
                            'filename' => $format_upload,
                            'status' => 1
                        );
                        //var_dump($data);exit;
                        $this->acladminmodel->updateProductGalleryFoto($data, $id4);
//                        redirect(getenv('HTTP_REFERER'));
                        redirect('backend/acladmin/edit_product/' . $id3);
                    } else {
                        $data = array(
                            'title' => $this->input->post('title'),
                            'body' => $this->input->post('body'),
                            'status' => 1
                        );
                        $this->acladminmodel->updateProductGalleryFoto($data, $id4);
//                        redirect(getenv('HTTP_REFERER'));
                        redirect('backend/acladmin/edit_product/' . $id3);
                    }
                }
            }
        } else {
            redirect('backend/acladmin/view_product');
        }

        $data['title'] = 'Edit Galeri Foto';
//        $data['albums']  = $this->acladminmodel->getIdGalleryAlbum($id3);
        $data['photos'] = $this->acladminmodel->getIdProductGalleryFoto($id4);
        $data['page'] = 'edit_product_gallery_foto';
        $data['content'] = $this->load->view('acladmin/module/edit_product_gallery_foto', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function edit_article_gallery_foto() {
        $id3 = $this->uri->segment(4);
        $id4 = $this->uri->segment(5);
        if ($id3 && $id4) {
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules("title", "Judul Foto", "required");
                $valid->set_rules("body", "Deskripsi Foto", "required");

                if ($valid->run() == false) {
                    // view
                } else {
                    $format_upload = $this->upload();
                    if ($format_upload != '') {
                        $data = array(
                            'title' => $this->input->post('title'),
                            'body' => $this->input->post('body'),
                            'filename' => $format_upload,
                            'status' => 1
                        );
                        //var_dump($data);exit;
                        $this->acladminmodel->updateArticleGalleryFoto($data, $id4);
//                        redirect(getenv('HTTP_REFERER'));
                        redirect('backend/acladmin/edit_article/' . $id3);
                    } else {
                        $data = array(
                            'title' => $this->input->post('title'),
                            'body' => $this->input->post('body'),
                            'status' => 1
                        );
                        $this->acladminmodel->updateArticleGalleryFoto($data, $id4);
//                        redirect(getenv('HTTP_REFERER'));
                        redirect('backend/acladmin/edit_article/' . $id3);
                    }
                }
            }
        } else {
            redirect('backend/acladmin/view_article');
        }

        $data['title'] = 'Edit Galeri Foto';
//        $data['albums']  = $this->acladminmodel->getIdGalleryAlbum($id3);
        $data['photos'] = $this->acladminmodel->getIdArticleGalleryFoto($id4);
        $data['page'] = 'edit_article_gallery_foto';
        $data['content'] = $this->load->view('acladmin/module/edit_article_gallery_foto', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function edit_slider() {
        $id = $this->uri->segment(4);
        if ($id) {
            $permalink = url_title($this->input->post('title'), 'dash', true);
            $data['page'] = 'edit_slider';
            $data['title'] = 'Edit Slider';
            $data['article'] = $this->acladminmodel->getIdSlider($id);
            //$data['photos']  = $this->acladminmodel->getIdGalleryArticle($id);
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');
                $valid->set_rules('order_number', 'Slider Number', 'required|numeric');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    if($this->input->post('order_number') != $data['article']->order_number){
                        $this->db->where('status', 1);
                        $this->db->where('order_number', $this->input->post('order_number'));
                        $cekorder = $this->db->get('slider');

                        if ($cekorder->num_rows() > 0) {
                            echo "<script>alert('Slider number sudah terpakai');</script>";
                            echo"<meta http-equiv='refresh' content='0;URL=' />";
                            exit;
                        }
                    }

                    $format_upload = $this->upload();
                    if ($format_upload != "") {
                        $data = array(
                            'id' => $id,
                            'title' => $this->input->post('title'),
                            'link' => $this->input->post('link'),
                            'order_number' => $this->input->post('order_number'),
                            'filename' => $format_upload,
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateSlider($data, $id);
                    } else {
                        $data = array(
                            'id' => $id,
                            'title' => $this->input->post('title'),
                            'link' => $this->input->post('link'),
                            'order_number' => $this->input->post('order_number'),
                            'permalink' => $permalink,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                        $this->acladminmodel->updateSlider($data, $id);
                    }

//                    $gallery = $this->upload_gallery();
//                    $this->acladminmodel->addGalleryArticle($gallery, $id);

                    redirect('backend/acladmin/view_slider');
                }
            }

            $data['content'] = $this->load->view('acladmin/module/edit_slider', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_slider');
        }
    }

    public function edit_popup() {
        $id = $this->uri->segment(4);
        if ($id) {
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                        $data = array(
                                'id' => $id,
                                'title' => $this->input->post('title'),
                                'modified_date' => time(),
                                'modified_by' => $this->sess_id,
                                'status' => 1
                            );
                        $this->acladminmodel->updatePopup($data, $id);

//                    $gallery = $this->upload_gallery();
//                    $this->acladminmodel->addGalleryArticle($gallery, $id);

                    redirect('backend/acladmin/view_popup');
                }
            }
            $data['page'] = 'edit_popup';
            $data['title'] = 'Edit PopUp';
            $data['article'] = $this->acladminmodel->getIdPopup($id);
            //$data['photos']  = $this->acladminmodel->getIdGalleryArticle($id);

            $data['content'] = $this->load->view('acladmin/module/edit_popup', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_popup');
        }
    }

    public function edit_popup_video() {
        $id = $this->uri->segment(4);
        if ($id) {
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('video_id', 'Video URL', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $this->db->select('filename');
                    $this->db->where('id', $id);
                    $query = $this->db->get('popup')->result_array();
                    if($query[0]['filename'] != ""){
                        echo "<script>alert('Hapus dahulu popup foto');</script>";
                        echo"<meta http-equiv='refresh' content='0;URL=' />";
                        exit;
                    }

                    $video_id = $this->get_youtube_id_from_url($this->input->post('video_id'));
                    $data = array(
                            'id' => $id,
                            'video_id' => $video_id,
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                    $this->acladminmodel->updatePopup($data, $id);

                    redirect('backend/acladmin/edit_popup/'.$id);
                }
            }
            $data['page'] = 'edit_popup_video';
            $data['title'] = 'Edit PopUp Video';
            $data['article'] = $this->acladminmodel->getIdPopup($id);

            $data['content'] = $this->load->view('acladmin/module/edit_popup_video', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_popup');
        }
    }

    public function edit_popup_foto() {
        $id = $this->uri->segment(4);
        if ($id) {
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('filename_link', 'Link', 'required');

                if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] == "") {
                    $valid->set_rules('userfile', 'Foto', 'required');
                }

                if ($valid->run() == false) {
                    // show error in view
                } else {
                    $this->db->select('video_id');
                    $this->db->where('id', $id);
                    $query = $this->db->get('popup')->result_array();
                    if($query[0]['video_id'] != ""){
                        echo "<script>alert('Hapus dahulu popup video');</script>";
                        echo"<meta http-equiv='refresh' content='0;URL=' />";
                        exit;
                    }

                    $format_upload = $this->upload();
                    $data = array(
                            'id' => $id,
                            'filename' => $format_upload,
                            'filename_link' => $this->input->post('filename_link'),
                            'modified_date' => time(),
                            'modified_by' => $this->sess_id,
                            'status' => 1
                        );
                    $this->acladminmodel->updatePopup($data, $id);

                    redirect('backend/acladmin/edit_popup/'.$id);
                }
            }
            $data['page'] = 'edit_popup_foto';
            $data['title'] = 'Edit PopUp Foto';
            $data['article'] = $this->acladminmodel->getIdPopup($id);

            $data['content'] = $this->load->view('acladmin/module/edit_popup_foto', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_popup');
        }
    }

    public function edit_store() {
        $id = $this->uri->segment(4);
        if ($id) {
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('body', 'Isi', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                        $data = array(
                                'id' => $id,
                                'body' => $this->input->post('body'),
                                'modified_date' => time(),
                                'modified_by' => $this->sess_id,
                                'status' => 1
                            );
                        $this->acladminmodel->updateStore($data, $id);

//                    $gallery = $this->upload_gallery();
//                    $this->acladminmodel->addGalleryArticle($gallery, $id);

                    redirect('backend/acladmin/view_store');
                }
            }
            $data['page'] = 'edit_store';
            $data['title'] = 'Edit Store';
            $data['article'] = $this->acladminmodel->getIdStore($id);
            //$data['photos']  = $this->acladminmodel->getIdGalleryArticle($id);

            $data['content'] = $this->load->view('acladmin/module/edit_store', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_store');
        }
    }

    public function edit_about() {
        $id = $this->uri->segment(4);
        if ($id) {
            if ($this->input->post('submit')) {
                $valid = $this->form_validation;
                $valid->set_rules('title', 'Judul', 'required');
                $valid->set_rules('short_desc', 'Short Description', 'required');
                $valid->set_rules('body', 'Isi', 'required');

                if ($valid->run() == false) {
                    // show error in view
                } else {
                        $data = array(
                                'id' => $id,
                                'title' => $this->input->post('title'),
                                'short_desc' => $this->input->post('short_desc'),
                                'body' => $this->input->post('body'),
                                'modified_date' => time(),
                                'modified_by' => $this->sess_id,
                                'status' => 1
                            );
                        $this->acladminmodel->updateAbout($data, $id);

//                    $gallery = $this->upload_gallery();
//                    $this->acladminmodel->addGalleryArticle($gallery, $id);

                    redirect('backend/acladmin/view_about');
                }
            }
            $data['page'] = 'edit_about';
            $data['title'] = 'Edit About';
            $data['article'] = $this->acladminmodel->getIdAbout($id);
            //$data['photos']  = $this->acladminmodel->getIdGalleryArticle($id);

            $data['content'] = $this->load->view('acladmin/module/edit_about', $data, true);
            $this->load->view('acladmin/main', $data);
        } else {
            redirect('backend/acladmin/view_about');
        }
    }

    public function delete_category() {
        if ($this->uri->segment(4)) {
            $data = array('status' => 0);
            $id = $this->uri->segment(4);
            $this->acladminmodel->deleteCategory($data, $id);
            redirect('backend/acladmin/view_category');
        } else {
            redirect('backend/acladmin/view_category');
        }
    }

    public function delete_product() {
        if ($this->uri->segment(4)) {
            $data = array('status' => 0);
            $id = $this->uri->segment(4);
            $this->acladminmodel->deleteProduct($data, $id);
            redirect('backend/acladmin/view_product');
        } else {
            redirect('backend/acladmin/view_product');
        }
    }

    public function delete_kegiatan() {
        if ($this->uri->segment(4)) {
            $data = array('status' => 0);
            $id = $this->uri->segment(4);
            $this->acladminmodel->deleteKegiatan($data, $id);
            redirect('backend/acladmin/view_kegiatan');
        } else {
            redirect('backend/acladmin/view_kegiatan');
        }
    }

    public function delete_mitra() {
        if ($this->uri->segment(4)) {
            $data = array('status' => 0);
            $id = $this->uri->segment(4);
            $this->acladminmodel->deleteMitra($data, $id);
            redirect('backend/acladmin/view_mitra');
        } else {
            redirect('backend/acladmin/view_mitra');
        }
    }

    public function delete_kategori() {
        if ($this->uri->segment(4)) {
            $data = array('status' => 0);
            $id = $this->uri->segment(4);
            $this->acladminmodel->deleteKategori($data, $id);
            redirect('backend/acladmin/view_kategori');
        } else {
            redirect('backend/acladmin/view_kategori');
        }
    }

    public function delete_article() {
        if ($this->uri->segment(4)) {
            $data = array('status' => 0);
            $id = $this->uri->segment(4);
            $this->acladminmodel->deleteArticle($data, $id);
            redirect('backend/acladmin/view_article');
        } else {
            redirect('backend/acladmin/view_article');
        }
    }

    public function delete_product_gallery_foto() {
        $idarticle = $this->uri->segment(4);
        $idphoto = $this->uri->segment(5);
        $data = array('status' => 0);
        $this->acladminmodel->deleteProductGalleryFoto($idphoto, $data);

        redirect('backend/acladmin/edit_product/' . $idarticle);
    }

    public function delete_article_gallery_foto() {
        $idarticle = $this->uri->segment(4);
        $idphoto = $this->uri->segment(5);
        $data = array('status' => 0);
        $this->acladminmodel->deleteArticleGalleryFoto($idphoto, $data);

        redirect('backend/acladmin/edit_article/' . $idarticle);
    }

    public function delete_slider() {
        if ($this->uri->segment(4)) {
            $data = array('status' => 0);
            $id = $this->uri->segment(4);
            $this->acladminmodel->deleteSlider($data, $id);
            redirect('backend/acladmin/view_slider');
        } else {
            redirect('backend/acladmin/view_slider');
        }
    }

    public function delete_popup_video() {
        if ($this->uri->segment(4)) {
            $data = array(
                'video_id' => ''
            );
            $id = $this->uri->segment(4);
            $this->acladminmodel->deletePopupvideo($data, $id);
            redirect('backend/acladmin/edit_popup/'.$this->uri->segment(4));
        } else {
            redirect('backend/acladmin/edit_popup/'.$this->uri->segment(4));
        }
    }

    public function delete_popup_foto() {
        if ($this->uri->segment(4)) {
            $data = array(
                'filename' => '',
                'filename_link' => ''
            );
            $id = $this->uri->segment(4);
            $this->acladminmodel->deletePopupfoto($data, $id);
            redirect('backend/acladmin/edit_popup/'.$this->uri->segment(4));
        } else {
            redirect('backend/acladmin/edit_popup/'.$this->uri->segment(4));
        }
    }

    public function search_category() {
        $search = $this->input->post('search');
        $submit = $this->input->post('submit');
        if ($search && $submit) {
            $data['media'] = $this->acladminmodel->search_category($search);
        } else {
            redirect(getenv('HTTP_REFERER'));
        }
        $data['page'] = 'search_category';
        $data['title'] = 'Search Results';
        $data['content'] = $this->load->view('acladmin/module/search_category', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function search_product() {
        $search = $this->input->post('search');
        $submit = $this->input->post('submit');
        if ($search && $submit) {
            $data['media'] = $this->acladminmodel->search_product($search);
        } else {
            redirect(getenv('HTTP_REFERER'));
        }
        $data['page'] = 'search_product';
        $data['title'] = 'Search Results';
        $data['content'] = $this->load->view('acladmin/module/search_product', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    
    public function add_user() {
        $this->onlyAdmin();

        if ($this->input->post('submit')) {
            // validation
            $valid = $this->form_validation;
            $valid->set_rules('name', 'Nama User', 'required');
            $valid->set_rules('email', 'Email', 'required|valid_email');
            $valid->set_rules('role', 'Hak Akses', 'required');
            $valid->set_rules('password', 'Password', 'min_length[5]|required');
            $valid->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]');

            if ($valid->run() == false) {
                // run
            } else {
                $name = $this->input->post('name');
                $email = $this->input->post('email');

                //cek user/email exist
                $exist = $this->userEmailExist($name, $email);

                if (!$exist) {
                    $data = array(
                        'name' => $name,
                        'email' => $email,
                        'role' => $this->input->post('role'),
                        'password' => sha1(md5($this->input->post('password'))),
                        'created_date' => time(),
                        'modified_date' => null,
                        'status' => 1
                    );

                    $this->acladminmodel->addUser($data);
                    redirect('backend/acladmin/view_user');
                }
            }
        }
        $data['page'] = 'add_user';
        $data['title'] = 'Tambah User Baru';
        $data['content'] = $this->load->view('acladmin/module/add_user', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    /**
     * check user/email
     */
    public function userEmailExist($name, $email, $id = false) {
        //check username
        $username = $this->acladminmodel->checkUsernameExist($name, $id);

        if ($username->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Nama User Sudah Digunakan');
            redirect(getenv('HTTP_REFERER'));
        }

        //check email
        $email = $this->acladminmodel->checkEmailExist($email, $id);

        if ($email->num_rows > 0) {
            $this->session->set_flashdata('error', 'Email Sudah Digunakan');
            redirect(getenv('HTTP_REFERER'));
        }

        return false;
    }

    /**
     * list user
     * status 1
     */
    public function view_user() {
        $this->onlyAdmin();

        $this->load->library('pagination');
        $config['base_url'] = site_url('backend/acladmin/view_user');
        $config['per_page'] = $this->limit;
        $config['total_rows'] = $this->acladminmodel->countUser(1);
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4) ? $this->uri->segment(4) : '');
        $data['list'] = $this->acladminmodel->fetchUser($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['page'] = 'view_user';
        $data['title'] = 'User';
        $data['content'] = $this->load->view('acladmin/module/view_user', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    /**
     * edit user
     */
    public function edit_user() {
        $this->onlyAdmin();

        $id = $this->uri->segment(4);
        if ($id) {
            if ($this->input->post('submit')) {
                // validation
                $valid = $this->form_validation;
                $valid->set_rules('name', 'Nama User', 'required');
                $valid->set_rules('email', 'Email', 'required|valid_email');
                $valid->set_rules('role', 'Hak Akses', 'required');
                $valid->set_rules('password', 'Password', 'min_length[5]|required');
                $valid->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]');

                if ($valid->run() == false) {
                    // run
                } else {
                    $name = $this->input->post('name');
                    $email = $this->input->post('email');

                    //cek user/email exist
                    $exist = $this->userEmailExist($name, $email, $id);

                    if (!$exist) {
                        $data = array(
                            'name' => $name,
                            'email' => $email,
                            'role' => $this->input->post('role'),
                            'modified_date' => time(),
                            'status' => 1
                        );

                        $password = $this->input->post('password');
                        $old_password = $this->input->post('oldpass');

                        if ($password != $old_password)
                            $data['password'] = sha1(md5($password));

                        $this->acladminmodel->updateUser($data, $id);
                        redirect('backend/acladmin/view_user');
                    }
                }
            }
            $id = $this->uri->segment(4);
            $data['edit'] = $this->acladminmodel->getIdUser($id);
            $data['page'] = 'edit_user';
            $data['title'] = 'Edit User';
            $data['content'] = $this->load->view('acladmin/module/add_user', $data, true);
        } else {
            redirect('backend/acladmin/view_user');
        }
        $this->load->view('acladmin/main', $data);
    }

    /**
     * edit user
     */
    public function edit_password() {
        if ($this->input->post('submit')) {
            // validation
            $valid = $this->form_validation;
            $valid->set_rules('old_password', 'Password Lama', 'required');
            $valid->set_rules('new_password', 'Password Baru', 'min_length[5]|required');
            $valid->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[new_password]');

            if ($valid->run() == false) {
                // run
            } else {

                $cek_password = $this->acladminmodel->checkPassword($this->input->post('old_password'));
                if ($cek_password) {
                    $data = array(
                        'password' => sha1(md5($this->input->post('new_password'))),
                        'modified_date' => time()
                    );
                    $id = $this->session->userdata('user_id');
                    $this->acladminmodel->updateUser($data, $id);
                    $this->session->set_flashdata('success', 'Berhasil Ubah Password');
                } else {
                    $this->session->set_flashdata('error', 'Password Lama Salah');
                }
                redirect(getenv('HTTP_REFERER'));
            }
        }
        $data['page'] = 'edit_password';
        $data['title'] = 'Edit Password';
        $data['content'] = $this->load->view('acladmin/module/edit_password', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    /**
     * delete channel
     * change status 1 to 0
     */
    public function delete_user() {
        $this->onlyAdmin();

        if ($this->uri->segment(4)) {
            $data = array('status' => 0);
            $id = $this->uri->segment(4);
            $this->acladminmodel->deleteUser($data, $id);
        }
        redirect('backend/acladmin/view_user');
    }

    /**
     * list channel status 0
     */
    public function archive_user() {
        $this->onlyAdmin();

        $this->load->library('pagination');
        $config['base_url'] = site_url('backend/acladmin/archive_user');
        $config['per_page'] = $this->limit;
        $config['total_rows'] = $this->acladminmodel->countUser(0);
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4) ? $this->uri->segment(4) : '');
        $data['content'] = $this->acladminmodel->fetchArchiveUser($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['page'] = 'archive_user';
        $data['title'] = 'Arsip User';
        $data['content'] = $this->load->view('acladmin/module/archive_user', $data, true);
        $this->load->view('acladmin/main', $data);
    }

    public function active_user() {
        $this->onlyAdmin();

        if ($this->uri->segment(4)) {
            $id = $this->uri->segment(4);
            $data = array('status' => 1);
            $this->acladminmodel->activeUser($data, $id);
        }
        redirect('backend/acladmin/view_user');
    }

    public function active_slider() {
        $this->onlyAdmin();

        if ($this->uri->segment(4)) {
            $id = $this->uri->segment(4);

            $this->db->select('MAX(order_number) as max_order_number');
            $this->db->where('status', 1);
            $max_order = $this->db->get('slider')->row_array();
            $new_order = $max_order['max_order_number'] + 1;

            $data = array('order_number' => $new_order, 'status' => 1);
            $this->acladminmodel->activeSlider($data, $id);
        }
        redirect('backend/acladmin/view_slider');
    }

    /*     * ***************** END OFF USER ***************** */
}

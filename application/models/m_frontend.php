<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_frontend extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    /* START RASKHASYA */

    public function getSlider(){
        $this->db->order_by('order_number', 'asc');
        $this->db->where('status', '1');
        $query = $this->db->get('slider');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getCategory(){
        $this->db->order_by('id', 'asc');
        $this->db->where('status', '1');
        $query = $this->db->get('category');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getCategoryId($permalink){
        $this->db->select('id, title');
        $this->db->where('status', '1');
        $this->db->where('permalink', $permalink);
        $query = $this->db->get('category');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getProduct($id){
        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id_category', $id);
        $query = $this->db->get('product');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getProductDetail($permalink){
        $this->db->where('status', '1');
        $this->db->where('permalink', $permalink);
        $query = $this->db->get('product');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getKegiatan(){
        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $query = $this->db->get('kegiatan');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getKegiatanDetail($permalink){
        $this->db->where('status', '1');
        $this->db->where('permalink', $permalink);
        $query = $this->db->get('kegiatan');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getMitra(){
        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $query = $this->db->get('mitra');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getProfile(){
        $this->db->where('status', '1');
        $query = $this->db->get('profile');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getContact(){
        $this->db->where('status', '1');
        $query = $this->db->get('contact');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    /* COUNT CATEGORY */
    function get_count_category($id) {
        $this->db->where('counter_category_id', $id);
        $query = $this->db->get('category_counter');
        return $query->result_array();
    }

    function count_view_category($data, $id) {
        $this->db->where('counter_category_id', $id);
        $this->db->update('category_counter', $data);
    }

    function save_count_view_category($data) {
        $this->db->insert('category_counter', $data);
    }
    /* END OF COUNT CATEGORY */

     /* COUNT PRODUCT */
    function get_count_product($id) {
        $this->db->where('counter_product_id', $id);
        $query = $this->db->get('product_counter');
        return $query->result_array();
    }

    function count_view_product($data, $id) {
        $this->db->where('counter_product_id', $id);
        $this->db->update('product_counter', $data);
    }

    function save_count_view_product($data) {
        $this->db->insert('product_counter', $data);
    }
    /* END OF COUNT PRODUCT */

    /* COUNT KEGIATAN */
    function get_count_kegiatan($id) {
        $this->db->where('counter_kegiatan_id', $id);
        $query = $this->db->get('kegiatan_counter');
        return $query->result_array();
    }

    function count_view_kegiatan($data, $id) {
        $this->db->where('counter_kegiatan_id', $id);
        $this->db->update('kegiatan_counter', $data);
    }

    function save_count_view_kegiatan($data) {
        $this->db->insert('kegiatan_counter', $data);
    }
    /* END OF COUNT KEGIATAN */

    /* END RASKHASYA */

}
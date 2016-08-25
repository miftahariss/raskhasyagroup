<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_frontend extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    public function get_all_product_detail($id){
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id !=', $id);
        $query = $this->db->get('product');
        
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM product WHERE status=1");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_all_product = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_product($limit){
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->limit($limit);
        $query = $this->db->get('product');
        
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM product WHERE status=1");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_product = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_product_loadmore($limit,$id){
        //print_r($id);
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id < ', $id);
        $this->db->limit($limit);
        $query = $this->db->get('product');
        //echo $this->db->last_query();
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM product WHERE status=1 AND id < '$id'");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_product_loadmore = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_product_sub_article($id,$limit) {
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id_sub', $id);
        $this->db->limit($limit);
        $query = $this->db->get('product');
        
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM product WHERE status=1 AND id_sub='$id'");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_product_sub = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_product_sub_loadmore($limit,$id,$id_sub){
        //print_r($id);
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id < ', $id);
        $this->db->where('id_sub', $id_sub);
        $this->db->limit($limit);
        $query = $this->db->get('product');
        //echo $this->db->last_query();
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM product WHERE status=1 AND id < '$id' AND id_sub='$id_sub'");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_product_sub_loadmore = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_product_detail($id) {
        $data = array();

        //$this->db->order_by('id', 'asc');
        $this->db->where('status', '1');
        $this->db->where('id', $id);
        $query = $this->db->get('product');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }

        $query->free_result();
        return $data;
    }

    public function get_product_gallery_foto($id) {
        $this->db->select('*');
        $this->db->from('product_gallery_foto');
        $this->db->where('id_product', $id);
        $this->db->where('status', 1);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_product_kategori(){
        $data = array();

        $this->db->order_by('id', 'asc');
        $this->db->where('status', '1');
        $query = $this->db->get('product_kategori');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }

        $query->free_result();
        return $data;
    }

    public function get_product_category($id,$limit) {
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id_kategori', $id);
        $this->db->limit($limit);
        $query = $this->db->get('product');
        
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM product WHERE status=1 AND id_kategori='$id'");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_product_category = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_product_category_loadmore($limit,$id,$id_kategori){
        //print_r($id);
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id < ', $id);
        $this->db->where('id_kategori', $id_kategori);
        $this->db->limit($limit);
        $query = $this->db->get('product');
        //echo $this->db->last_query();
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM product WHERE status=1 AND id < '$id' AND id_kategori='$id_kategori'");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_product_category_loadmore = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_article($id_headline,$limit){
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id !=',$id_headline);
        $this->db->limit($limit);
        $query = $this->db->get('article');
        
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM article WHERE status=1 AND id != $id_headline");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_article = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_article_headline($limit) {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('status', 1);
        $this->db->order_by('id','desc');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_article_loadmore($id_headline,$limit,$id){
        //print_r($id);
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id < ', $id);
        $this->db->where('id !=',$id_headline);
        $this->db->limit($limit);
        $query = $this->db->get('article');
        //echo $this->db->last_query();
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM article WHERE status=1 AND id < '$id' AND id != $id_headline");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_article_loadmore = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_article_gallery_foto($id) {
        $this->db->select('*');
        $this->db->from('article_gallery_foto');
        $this->db->where('id_article', $id);
        $this->db->where('status', 1);
        $this->db->order_by('id','desc');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_article_detail($id) {
        $data = array();

        //$this->db->order_by('id', 'asc');
        $this->db->where('status', '1');
        $this->db->where('id', $id);
        $query = $this->db->get('article');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }

        $query->free_result();
        return $data;
    }

    public function get_article_other($id,$limit){
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->where('id !=', $id);
        $this->db->limit($limit);
        $query = $this->db->get('article');
        
        $jumlah = $this->db->query("SELECT COUNT(*) AS jumlah FROM article WHERE status=1 AND id != '$id'");
        $jumlah = $jumlah->row_array();
        $jumlah = $jumlah['jumlah'];

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }
        
        $this->jumlah_article_other = $jumlah;

        $query->free_result();
        return $data;
    }

    public function get_article_home($limit) {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('home', 1);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_article_latest_home($limit){
        $data = array();

        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');
        $this->db->limit($limit);
        $query = $this->db->get('article');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }

        $query->free_result();
        return $data;
    }

    function get_popular_article($offset,$limit){
         
        $this->db->where('article.status',1);
        
        //$this->db->where('MONTH(article.created_date) ', date('m'));
        //$this->db->where('YEAR(article.created_date) ', date('Y'));
        //$oneweekbefore = date("Y-m-d H:i:s",strtotime("-1 week"));
        $this->db->where('article.created_date >=', strtotime('-1 month'));//one month before
        $this->db->where('article.created_date <=', time());//today
        $this->db->join('article_counter','article_counter.counter_article_id = article.id','left');
        $this->db->order_by('article_counter.counter_count','desc');
        $query = $this->db->get('article',$limit,$offset);
        //var_dump($this->db->last_query());exit;
        return $query->result_array();
    }

    /* COUNT ARTICLE MEDIA */
    function get_count($id) {
        $this->db->where('counter_article_id', $id);
        $query = $this->db->get('article_counter');
        return $query->result_array();
    }

    function count_view($data, $id) {
        $this->db->where('counter_article_id', $id);
        $this->db->update('article_counter', $data);
    }

    function save_count_view($data) {
        $this->db->insert('article_counter', $data);
    }
    /* END OF COUNT ARTICLE MEDIA */

    public function get_slider(){
        $data = array();

        $this->db->order_by('order_number', 'asc');
        $this->db->where('order_number !=', 0);
        $this->db->where('status', '1');
        $query = $this->db->get('slider');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }

        $query->free_result();
        return $data;
    }

    public function get_store(){
        $data = array();

        $this->db->where('status', '1');
        $query = $this->db->get('store');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }

        $query->free_result();
        return $data;
    }

    public function get_about(){
        $data = array();

        $this->db->where('status', '1');
        $query = $this->db->get('about');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = $rows;
            }
        }

        $query->free_result();
        return $data;
    }

    public function get_popup(){
      $this->db->where('video_id !=', '');
      $this->db->or_where('filename !=', '');
      $this->db->where('status', 1);
      $this->db->order_by('created_date', 'desc');
      $query = $this->db->get('popup');

      if ($query->num_rows() > 0) {
          return $query->result();
      }
      return false;
    }

}
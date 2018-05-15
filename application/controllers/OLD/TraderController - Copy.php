<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class TraderController extends REST_Controller {

    function __construct() {

        // Construct the parent class
        parent::__construct();
        $this->load->library(array(
            'session',
            'form_validation',
            'email'
        ));
        $this->load->library('pagination');
        $this->load->Model('Trader_mdl');
         $this->load->Model('Api_mdl');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
    function now(){
        $now= time();
        return $now;
    }
    public function GetPostList_get() {
        $li = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $limit = $li * $per_page_cnt;
        $config = array();
        $config['base_url'] = base_url() . "Trader/view_car_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_car();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // $query = $this->Trader_mdl->get_post_lists($config["per_page"], $page);
        //$query = $this->Trader_mdl->get_post_lists($limit, $page);
        $query = $this->Trader_mdl->get_post_lists($per_page_cnt, $limit);
        $str_links = $this->pagination->create_links();
        $data['result'] = '200';
        $data['messageEn'] = 'Post list details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
//             $data["links"] = explode('&nbsp;', $str_links);
        $data['data'] = [
            'Post' => $query,
            'page' => $limit,
            'perPageCount' => $per_page_cnt
        ];
        //$data['post_list']=$this->Trader_mdl->get_post_lists(); 
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function CarAddPost_post() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }

        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = strtotime(now());/***me*/
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image =$uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
//
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp4';
            $config['file_name'] = strtotime(now());/***me*/
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $uploadData['file_name'];/***me*/
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }

        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = strtotime(now());
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail =$uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }








        $post_date = date('Y-m-d h:i:sa');
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
        $data['productCBrand'] = $brand;
        $data['productCModel'] = $model;
        $data['productCReleaseYear'] = $year;
        $data['productCPrice'] = $price;
        $data['productCCallPrice'] = $callforprice;
        $data['productCDesc'] = $details;
        $data['productCSubmitDate'] = $post_date;
        $data['cartCType'] = $cartype;
        $data['Cpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productcar', $data);
        $last_prd_id = $this->db->insert_id();

        $postdata['traderID'] = $traderID;
        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();
        
        if (isset($_FILES['images']['name'])) {

            
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {
echo $key;
echo $value;

                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];
                $rand_val = rand(10, 100);
                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;
                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $updimg_data);
                } else {
                    $msg = "error in uploading";
                    $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        }



        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);


        $query = $this->Trader_mdl->Car_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '1');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'message' => 'Product Car Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function CarUpdatePost_post() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];

        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];



        if (isset($_FILES['image']['name'])) {

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }


//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
//        $data['productCategoryID']=$categoryID;
        $data['productCBrand'] = $brand;
        $data['productCModel'] = $model;
        $data['productCReleaseYear'] = $year;
        $data['productCCallPrice'] = $callforprice;
        $data['productCPrice'] = $price;
        $data['productCDesc'] = $details;
        $data['productCSubmitDate'] = $post_date;
        $data['Cpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productcar', $data);
        //$last_prd_id = $this->db->insert_id();
        //$postdata['productID']= $last_prd_id;
        //$postdata['productCategoryID']= $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);
        //$last_post_id = $this->db->insert_id();
        //$updimg_data['productID'] = $last_prd_id;
        //$updimg_data['postID'] = $last_post_id;
        //$updimg_data['productCategoryID'] = $categoryID;
//            $updimg_data['traderID'] = '';



        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';

        $config['overwrite'] = FALSE;

        $this->load->library('upload');
        if (isset($_FILES['images']['name'])) {
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;





                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }



        if ($this->db->update('productcar', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Car Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function BikeAddPost_post() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
//       $categoryname=$_GET['categoryname'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
//        $data['productCategoryName']=$categoryname;
        $data['cartBType'] = $cartype;
        $data['productBBrand'] = $brand;
        $data['productBModel'] = $model;
        $data['productBReleaseYear'] = $year;
        $data['productBCallPrice'] = $callforprice;
        $data['productBPrice'] = $price;
        $data['productBDesc'] = $details;
        $data['productBSubmitDate'] = $post_date;
        $data['Bpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productbike', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['traderID'] = $traderID;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();

        if (isset($_FILES['images']['name'])) {

            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;




                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }





        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);





        $query = $this->Trader_mdl->Bike_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '2');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'message' => 'Product Bike Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function BikeUpdatePost_post() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $location = $_GET['location'];

        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;



        if (isset($_FILES['image']['name'])) {

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
//        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $data['productCategoryID'] = $categoryID;
        $data['productBBrand'] = $brand;
        $data['productBModel'] = $model;
        $data['productBReleaseYear'] = $year;
        $data['productBCallPrice'] = $callforprice;
        $data['productBPrice'] = $price;
        $data['productBDesc'] = $details;
        $data['productBSubmitDate'] = $post_date;
        $data['Bpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productbike', $data);




        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);
        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

//         $updimg_data['traderID'] = '';
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }

            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }




        if ($this->db->update('productbike', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Bike Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function VertuAddPost_post() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
        $data['productVBrand'] = $brand;
        $data['productVModel'] = $model;
        $data['cartVType'] = $cartype;
//        $data['productVReleaseYear']=$year;
        $data['productVCallPrice'] = $callforprice;
        $data['productVPrice'] = $price;
        $data['productVDesc'] = $details;
        $data['productVSubmitDate'] = $post_date;
        $data['Vpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productvertu', $data);
        $last_prd_id = $this->db->insert_id();

        $postdata['traderID'] = $traderID;
        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();

        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;





                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }



        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);




        $query = $this->Trader_mdl->Vertu_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '4');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Vertu Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function VertuUpdatePost_post() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];

        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        if (isset($_FILES['image']['name'])) {

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }


        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['productVBrand'] = $brand;
        $data['productVModel'] = $model;
//        $data['productVReleaseYear']=$year;
        $data['productVCallPrice'] = $callforprice;
        $data['productVPrice'] = $price;
        $data['productVDesc'] = $details;
        $data['productVSubmitDate'] = $post_date;
        $data['Vpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productvertu', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);
        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

//            $updimg_data['traderID'] = '';
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }

        if ($this->db->update('productvertu', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product vertu Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function WatchAddPost_post() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
//       $price = $_GET['price'];
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }

//
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
        $data['productWBrand'] = $brand;
        $data['productWModel'] = $model;
        $data['productWCallPrice'] = $callforprice;
        $data['cartWType'] = $cartype;
        //$data['productWReleaseYear']=$year;
        $data['productWPrice'] = $price;
        $data['productWDesc'] = $details;
        $data['productWSubmitDate'] = $post_date;
        $data['Wpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productwatch', $data);
        $last_prd_id = $this->db->insert_id();

        $postdata['traderID'] = $traderID;
        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();
        if (isset($_FILES['images']['name'])) {

            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;








                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }




        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);

        $query = $this->Trader_mdl->Watch_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '5');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Watch Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function WatchUpdatePost_post() {
        $rand_val = rand(10, 100);
        $data = array();
//       $location = $_GET['location'];
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];


        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
//        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }


        $post_date = date('Y-m-d h:i:sa');
        //$data['productLocation'] = $location;
        $data['productCategoryID'] = $categoryID;
        $data['productWBrand'] = $brand;
        $data['productWModel'] = $model;
        //$data['productWReleaseYear']=$year;
        $data['productWCallPrice'] = $callforprice;
        $data['productWPrice'] = $price;
        $data['productWDesc'] = $details;
        $data['productWSubmitDate'] = $post_date;
        $data['Wpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productwatch', $data);



        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);

        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

                    //       $updimg_data['productImage'] = base_url().'uploads/product_images/'.$rand_val.'_'.$_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }




        if ($this->db->update('productwatch', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Watch Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function BoatAddPost_post() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];

        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {

            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['traderID'] = $traderID;
        $data['productBtBrand'] = $brand;
        $data['productBtModel'] = $model;
        $data['productBtCallPrice'] = $callforprice;
//        $data['productBReleaseYear']=$year;
        $data['cartBTType'] = $cartype;
        $data['productBTPrice'] = $price;
        $data['productBDesc'] = $details;
        $data['productBTSubmitDate'] = $post_date;
        $data['BTpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productboat', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();
        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;



                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }



        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);




        $query = $this->Trader_mdl->Boat_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '7');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Boat Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function BoatUpdatePost_post() {
        $rand_val = rand(10, 100);
        $data = array();
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }

        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];

        if (isset($_FILES['image']['name'])) {


            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
//        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');

        $data['productCategoryID'] = $categoryID;
        $data['productBtBrand'] = $brand;
        $data['productBtModel'] = $model;

        $data['productBtCallPrice'] = $callforprice;
        $data['productBTPrice'] = $price;
        $data['productBDesc'] = $details;
        $data['productBTSubmitDate'] = $post_date;
        $data['BTpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productboat', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);


        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

//            $updimg_data['traderID'] = '';
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }



        if ($this->db->update('productboat', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Boat Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function PhoneAddPost_post() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];


        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }

//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['traderID'] = $traderID;
        $data['productPBrand'] = $brand;
        $data['productPModel'] = $model;
//        $data['productPReleaseYear']=$year;
        $data['productPhCallPrice'] = $callforprice;
        $data['cartPHType'] = $cartype;
        $data['productPHPrice'] = $price;
        $data['productPDesc'] = $details;
        $data['productPSubmitDate'] = $post_date;
        $data['PHpost_main_img'] = base_url() . 'uploads/product_images/' . $image;

        $this->db->insert('productphone', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();
        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';

        $config['overwrite'] = FALSE;

        $this->load->library('upload');
        if (isset($_FILES['images']['name'])) {
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }




        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);







        $query = $this->Trader_mdl->Phone_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '8');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Phone Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];

            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function PhoneUpdatePost_post() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['productPBrand'] = $brand;
        $data['productPModel'] = $model;
//        $data['productPReleaseYear']=$year;
        $data['productPhCallPrice'] = $callforprice;
        $data['productPHPrice'] = $price;
        $data['productPDesc'] = $details;
        $data['productPSubmitDate'] = $post_date;
        $data['PHpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productphone', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);

//            $updimg_data['traderID'] = '';



        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }






        if ($this->db->update('productphone', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Phone Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function NoplateAddPost_post() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $emirate = $_POST['emirate'];
        $templateId = $_POST['templateId'];
        $code = $_POST['code'];
        $digitNumber = $_POST['digitNumber'];
        $numberPlateNumber = $_POST['numberPlateNumber'];
//        $image = $_GET['image'];

        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }






        $post_date = date('Y-m-d h:i:sa');
        $data['cartNPType'] = $cartype;
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['traderID'] = $traderID;
        $data['productNPEmrites'] = $emirate;
        $data['productNPTemplate'] = $templateId;
        $data['productNPCode'] = $code;
        $data['productNPDigits'] = $digitNumber;
        $data['productNPNmbr'] = $numberPlateNumber;
        $data['productNPCallPrice'] = $callforprice;
        $data['productNPPrice'] = $price;
        $data['productNPDesc'] = $details;
        $data['productNPSubmitDate'] = $post_date;
        $data['NPpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productnp', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();

        /* $updimg_data['productID'] = $last_prd_id;
          $updimg_data['postID'] = $last_post_id;
          $updimg_data['productCategoryID'] = $categoryID;
          $updimg_data['traderID'] = '';
          $updimg_data['productImage'] = $mod_medialist;
          $updimg_data['productVideo'] = $video;
          $updimg_data['cartType'] = '';
          $updimg_data['productLive'] = '';
          $updimg_data['productVideoCount'] = '';
          $updimg_data['productViewCount'] = '';
          $updimg_data['productLastAccess'] = '';
          $updimg_data['productSubmitDate'] = $post_date; */

//             $this->db->insert('post', $postdata);



        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);







        $query = $this->Trader_mdl->NP_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '3');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Number plate  Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];

            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function NoplateUpdatePost_post() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }

        $details = $_POST['details'];
        $emirate = $_POST['emirate'];
        $templateId = $_POST['templateId'];
        $code = $_POST['code'];
        $digitNumber = $_POST['digitNumber'];
        $numberPlateNumber = $_POST['numberPlateNumber'];
//        $image = $_GET['image'];

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }




        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation'] = $location;
        $data['productCategoryID'] = $categoryID;

        $data['productNPEmrites'] = $emirate;
        $data['productNPTemplate'] = $templateId;
        $data['productNPCode'] = $code;
        $data['productNPDigits'] = $digitNumber;
        $data['productNPNmbr'] = $numberPlateNumber;
        $data['productNPCallPrice'] = $callforprice;
        $data['productNPPrice'] = $price;
        $data['productNPDesc'] = $details;
        $data['productNPSubmitDate'] = $post_date;
        $data['NPpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productnp', $data);
//        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        //$this->db->insert('post',$postdata);
        //$last_post_id = $this->db->insert_id();

        /* $updimg_data['productID'] = $last_prd_id;
          $updimg_data['postID'] = $last_post_id;
          $updimg_data['productCategoryID'] = $categoryID;
          $updimg_data['traderID'] = '';
          $updimg_data['productImage'] = $mod_medialist;
          $updimg_data['productVideo'] = $video;
          $updimg_data['cartType'] = '';
          $updimg_data['productLive'] = '';
          $updimg_data['productVideoCount'] = '';
          $updimg_data['productViewCount'] = '';
          $updimg_data['productLastAccess'] = '';
          $updimg_data['productSubmitDate'] = $post_date; */
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        if ($this->db->update('post', $postdata)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Number Plate Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function MobileNoAddPost_post() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = '';
        }
        $details = $_POST['details'];
        $operatorId = $_POST['operatorId'];
        if ($operatorId == 1) {
            $operator = "DU";
        } else if ($operatorId == 2) {
            $operator = "Etisalat";
        } else if ($operatorId == 3) {
            $operator = "Others";
        }
        $prefix = $_POST['prefix'];
        $digitType = $_POST['digitType'];
        $mobileNumber = $_POST['mobileNumber'];
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }

        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }



        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['traderID'] = $traderID;
        $data['productOperator'] = $operator;
        $data['productMNPrefix'] = $prefix;
        $data['productMNDigits'] = $digitType;
        $data['cartMNType'] = $cartype;
        $data['productMNNmbr'] = $mobileNumber;
        $data['productMNCallPrice'] = $callforprice;
        $data['productMNPrice'] = $price;
        $data['productMNDesc'] = $details;
        $data['productMNSubmitDate'] = $post_date;
        $data['MNpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productmn', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();


        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);




        $query = $this->Trader_mdl->MN_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '6');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Mobile  Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];

            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function MobileNoUpdatePost_post() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = '';
        }


        $details = $_POST['details'];

        $operatorId = $_POST['operatorId'];
        if ($operatorId == 1) {
            $operator = "DU";
        } else if ($operatorId == 2) {
            $operator = "Etisalat";
        } else if ($operatorId == 3) {
            $operator = "Others";
        }
        $prefix = $_POST['prefix'];
        $digitType = $_POST['digitType'];
        $mobileNumber = $_POST['mobileNumber'];
//        $image = $_GET['image'];

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }





        $post_date = date('Y-m-d h:i:sa');

        $data['productCategoryID'] = $categoryID;

        $data['productOperator'] = $operator;
        $data['productMNPrefix'] = $prefix;
        $data['productMNDigits'] = $digitType;
        $data['productMNNmbr'] = $mobileNumber;
        $data['productMNCallPrice'] = $callforprice;
        $data['productMNPrice'] = $price;
        $data['productMNDesc'] = $details;
        $data['productMNSubmitDate'] = $post_date;
        $data['MNpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productmn', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';

        //$last_post_id = $this->db->insert_id();

        /* $updimg_data['productID'] = $last_prd_id;
          $updimg_data['postID'] = $last_post_id;
          $updimg_data['productCategoryID'] = $categoryID;
          $updimg_data['traderID'] = '';
          $updimg_data['productImage'] = $mod_medialist;
          $updimg_data['productVideo'] = $video;
          $updimg_data['cartType'] = '';
          $updimg_data['productLive'] = '';
          $updimg_data['productVideoCount'] = '';
          $updimg_data['productViewCount'] = '';
          $updimg_data['productLastAccess'] = '';
          $updimg_data['productSubmitDate'] = $post_date; */
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        if ($this->db->update('post', $postdata)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Mobile Number Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function PropertyAddPost_post() {
        $data = array();
        $rand_val = rand(10, 100);
//        $location = $_GET['location'];
        $categoryID = $_POST['categoryID'];
        $traderID = $_POST['traderID'];
        $callforprice = $_POST['callforprice'];
//        $price = $_GET['price'];
        $details = $_POST['details'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
//        $property_type = $_GET['property_type'];
        $itemId = $_POST['itemId'];
        if ($itemId == 1) {
            $category = "Rent";
        } else if ($itemId == 2) {
            $category = "Buy";
        } else if ($itemId == 3) {
            $category = "Hotels";
        } else if ($itemId == 4) {
            $category = "stores";
        }
        $subcategoryId = $_POST['subcategoryId'];
        if ($subcategoryId == 1) {
            $subcategory = "studio";
        } else if ($subcategoryId == 2) {
            $subcategory = " 1 BHK";
        } else if ($subcategoryId == 3) {
            $subcategory = " 2BHK";
        } else if ($subcategoryId == 4) {
            $subcategory = " 3 BHK";
        } else if ($subcategoryId == 5) {
            $subcategory = "More";
        } else if ($subcategoryId == 6) {
            $subcategory = "Land";
        } else if ($subcategoryId == 7) {
            $subcategory = "Apartment";
        } else if ($subcategoryId == 8) {
            $subcategory = "Flat";
        } else if ($subcategoryId == 9) {
            $subcategory = "studio";
        } else if ($subcategoryId == 10) {
            $subcategory = " 1 Bed";
        } else if ($subcategoryId == 11) {
            $subcategory = "2 Bed";
        } else if ($subcategoryId == 12) {
            $subcategory = "3 Bed";
        } else if ($subcategoryId == 12) {
            $subcategory = "0-100 sqft";
        } else if ($subcategoryId == 13) {
            $subcategory = "100-500 sqft";
        } else if ($subcategoryId == 14) {
            $subcategory = "500-5000 sqft";
        } else if ($subcategoryId == 15) {
            $subcategory = "5000 and more sqft";
        }

        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
        $data['productPropSC'] = $subcategory;
        $data['productPropType'] = $category;
        $data['productPropCallPrice'] = $callforprice;
        $data['productPRPrice'] = $price;
        $data['productDesc'] = $details;
        $data['productPRSubmitDate'] = $post_date;
        $data['PRpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productproperty', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();


        if (isset($_FILES['images']['name'])) {

            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;




                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }


        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);





        $query = $this->Trader_mdl->Property_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '9');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Property Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];

            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function PropertyUpdatePost_post() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];


        $itemId = $_POST['itemId'];
        if ($itemId == 1) {
            $category = "Rent";
        } else if ($itemId == 2) {
            $category = "Buy";
        } else if ($itemId == 3) {
            $category = "Hotels";
        } else if ($itemId == 4) {
            $category = "stores";
        }
        $subcategoryId = $_POST['subcategoryId'];
        if ($subcategoryId == 1) {
            $subcategory = "studio";
        } else if ($subcategoryId == 2) {
            $subcategory = " 1 BHK";
        } else if ($subcategoryId == 3) {
            $subcategory = " 2BHK";
        } else if ($subcategoryId == 4) {
            $subcategory = " 3 BHK";
        } else if ($subcategoryId == 5) {
            $subcategory = "More";
        } else if ($subcategoryId == 6) {
            $subcategory = "Land";
        } else if ($subcategoryId == 7) {
            $subcategory = "Apartment";
        } else if ($subcategoryId == 8) {
            $subcategory = "Flat";
        } else if ($subcategoryId == 9) {
            $subcategory = "studio";
        } else if ($subcategoryId == 10) {
            $subcategory = " 1 Bed";
        } else if ($subcategoryId == 11) {
            $subcategory = "2 Bed";
        } else if ($subcategoryId == 12) {
            $subcategory = "3 Bed";
        } else if ($subcategoryId == 12) {
            $subcategory = "0-100 sqft";
        } else if ($subcategoryId == 13) {
            $subcategory = "100-500 sqft";
        } else if ($subcategoryId == 14) {
            $subcategory = "500-5000 sqft";
        } else if ($subcategoryId == 15) {
            $subcategory = "5000 and more sqft";
        }


//        $property_type = $_GET['property_type'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['video']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('video')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
//        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }

        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['productPropSC'] = $subcategory;
        $data['productPropType'] = $category;
        $data['productPropCallPrice'] = $callforprice;
        $data['productPRPrice'] = $price;
        $data['productDesc'] = $details;
        $data['productPRSubmitDate'] = $post_date;
        $data['PRpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productproperty', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();


        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];
                $rand_val = rand(10, 100);
                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;






//            $updimg_data['traderID'] = '';
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }

        if ($this->db->update('productproperty', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product property Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function GetPostByCategoryId() {
        $category_id = $_GET['categoryId'];
        $data['result'] = '200';
        $data['message'] = 'Category details retrieved';
        $data['data']['posts'] = $this->Trader_mdl->get_post_catid($category_id);
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['result'] = '200';
            $data['message'] = 'Inavlid request';
            $this->response($data, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function getpost_traders_get() {
        $li = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $limit = $li * $per_page_cnt;
        $trader_id = $_GET['traderId'];
        $data['qry'] = $this->Trader_mdl->checktrader($trader_id);

        if (count($data['qry']) == 0) {

            $msg = "No result found.";
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $config = array();
            $config['base_url'] = base_url() . "Trader/view_car_category";
            $config["total_rows"] = $this->Trader_mdl->record_count_car();
            $config["per_page"] = 1;
            $config["uri_segment"] = 3;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $query = $this->Trader_mdl->get_post_traderid($trader_id, $per_page_cnt, $limit);
            $str_links = $this->pagination->create_links();
//            $data["links"] = explode('&nbsp;', $str_links);
            $data['result'] = '200';
            $data['messageEn'] = 'Trader Post list details retrieved';
            $data['messageAr'] = 'تم استجاع البيانات بنجاح';
            $data['data'] = $query;
            if ($data) {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function GetHomeContent_get() {
        $video = $this->Trader_mdl->gethome_product_list();
        $car = $this->Trader_mdl->carrecent();
        $bike = $this->Trader_mdl->bikerecent();
        $np = $this->Trader_mdl->nprecent();
        $vertu = $this->Trader_mdl->verturecent();
        $watch = $this->Trader_mdl->watchrecent();
        $MN = $this->Trader_mdl->mnrecent();
        $boat = $this->Trader_mdl->boatrecent();
        $phone = $this->Trader_mdl->phonerecent();
        $property = $this->Trader_mdl->propertyrecent();
        $data['result'] = '200';
        $data['messageEn'] = 'Dashboard details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
        $data['data'] = array();
        $data['data']['toptraders'] = $this->Trader_mdl->gethome_traders_list();
        $data['data']['latestVideo'] = $video[0];

        $data['data']['categories'] = [
            $car[0], $bike[0], $np[0], $vertu[0], $watch[0], $MN[0], $boat[0], $phone[0], $property[0],
        ];

        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['result'] = '100';
            $data['message'] = 'Invalid Request';
            $this->response($data, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function chk_carttype_get() {
        $product_id = $_GET['product_id'];
        $cart_type = $_GET['cart_type'];
        $customer_id = $_GET['cust_id'];
        $data['qry'] = $this->Trader_mdl->get_prod_trader($product_id);
        $data['msg'] = 'You can contact trader.';

        if ($cart_type == 0) {

            $this->response($data, REST_Controller::HTTP_OK);
        } else {

            $this->addcart_post();
        }
    }

    public function GetPostById_get() {
        $post_id = $_GET['postId'];
        $data['qry'] = $this->Trader_mdl->checkpostId($post_id);

        if (count($data['qry']) == 0) {

            $msg = "No result found.";
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        } else {


            $images = $this->Trader_mdl->get_post_images($post_id);
            $media = $this->Trader_mdl->get_post_medialist($post_id);
            $post = $this->Trader_mdl->get_post_byid($post_id);
            $traderInfo = $this->Trader_mdl->get_post_traderinfo($post_id);
            $data['result'] = '200';
            $data['messageEn'] = 'Post list details retrieved';
            $data['messageAr'] = ' تم استجاع البيانات بنجاح';
            $data['data'] = [
                'ProductInfo' => $post,
                'trdaerInfo' => $traderInfo,
                'Images' => $images,
                'Video' => $media
            ];

            if ($data) {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function register_post() {
        $email = $_POST['email'];
        $data['qry'] = $this->Trader_mdl->emailcheck($email);
        if (count($data['qry']) > 0) {
            $msg = "username is already taken.";
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $name = $_POST['name'];
            $mobile = $_POST['mobile'];

            $password = $_POST['password'];
            $place = $_POST['place'];
            //$web = $_POST['web'];
            // $facebook = $_POST['facebook'];
            //$instagram = $_POST['instagram'];
            //$snapchat = $_POST['snapchat'];
            //$twitter = $_POST['twitter'];
            $companyDescription = $_POST['companyDescription'];
            $deviceId = $_POST['deviceId'];
            //$planId = $_POST['planId'];
            $userTypeId = $_POST['userTypeId'];
            $config['upload_path'] = 'uploads/trader_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['profileImage']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('profileImage')) {
                $uploadData = $this->upload->data();
                $profileImage = $uploadData['file_name'];
            } else {
                $profileImage = 'noimage.png';
            }
            $config['upload_path'] = 'uploads/trader_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['idImage1']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('idImage1')) {
                $uploadData = $this->upload->data();

                $idImage1 = $uploadData['file_name'];
            } else {
                $idImage1 = 'noimage.png';
            }


            $data = array(
                'traderFullName' => $name,
                'traderContactNum' => $mobile,
                'traderEmailID' => $email,
                'traderUserName' => $email,
                'traderPasswd' => $password,
                'traderLocation' => $place,
                //'socialWeb' => $web,
                //'socialFb' => $facebook,
                //'socialInsta' => $instagram,
                // 'socialSnap' => $snapchat,
                // 'socialtwitter' => $twitter,
                'traderIDProof' => base_url() . 'uploads/trader_images/' . $idImage1,
                'traderImage' => base_url() . 'uploads/trader_images/' . $profileImage,
                'traderInfo' => $companyDescription,
                'deviceId' => $deviceId,
                'usertype' => $userTypeId,
                    //'planID'=> $planId ,
            );

            if ($this->db->insert('trader', $data)) {
                $userId = $this->db->insert_id();
                $image = $this->Trader_mdl->profileimage($userId);

                $data = [
                    'result' => '200',
                    'messageEn' => 'Successfully added Trader details',
                    'messageAr' => 'تم استجاع البيانات بنجاح'
                ];
                $data['data'] = [
                    'userId' => $userId,
                    'profileimage' => $image[0]
                ];
                $this->set_response($data, REST_Controller::HTTP_OK);
                //$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Please select the payment method.</div>');
            } else {
                $message = [
                    'message' => 'Please try again'
                ];
                $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    function UpdateUser_post() {
        $userId = $_POST['userId'];
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $place = $_POST['place'];

        $website = $_POST['website'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $snapchat = $_POST['snapchat'];
        $twitter = $_POST['twitter'];
        $description = $_POST['description'];
        $deviceId = $_POST['deviceId'];



        $config['upload_path'] = 'uploads/trader_images/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $_FILES['profileImage']['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('profileImage')) {
            $uploadData = $this->upload->data();

            $profileImage = $uploadData['file_name'];
        } else {
            $profileImage = 'noimage.png';
        }


        $config['upload_path'] = 'uploads/trader_images/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $_FILES['idImage1']['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('idImage1')) {
            $uploadData = $this->upload->data();

            $idImage1 = $uploadData['file_name'];
        } else {
            $idImage1 = 'noimage.png';
        }




        $config['upload_path'] = 'uploads/trader_images/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $_FILES['idImage2']['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('idImage2')) {
            $uploadData = $this->upload->data();

            $idImage2 = $uploadData['file_name'];
        } else {
            $idImage2 = 'noimage.png';
        }











        $data = array(
            'traderFullName' => $name,
            'traderContactNum' => $mobile,
//                'traderEmailID' => $email,
//                'traderUserName' => $username,
            'traderPasswd' => $password,
            'traderLocation' => $place,
            'socialWeb' => $website,
            'socialFb' => $facebook,
            'socialInsta' => $instagram,
            'socialSnap' => $snapchat,
            'socialtwitter' => $twitter,
            'traderIDProof' => base_url() . 'uploads/trader_images/' . $idImage1,
            'traderIDProofsecond' => base_url() . 'uploads/trader_images/' . $idImage2,
            'traderImage' => base_url() . 'uploads/trader_images/' . $profileImage,
            'traderInfo' => $description,
            'deviceId' => $deviceId
        );
        $this->db->where('traderID', $userId);

        if ($this->db->update('trader', $data)) {
            $image = $this->Trader_mdl->profileimage($userId);
            $message = [
                'result' => '200',
                'messageEn' => 'Trader Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح',
                'userId' => $userId,
                'profileimage' => $image[0]
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $message = [
                'result' => '100',
                'message' => 'Please try again'
            ];
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function AddToCart_post() {
        $userId = $_GET['userId'];
        $postId = $_GET['postId'];
        $productcategoryId = $_GET['productcategoryId'];
        $productId = $_GET['productId'];
        $this->Trader_mdl->addtocart($userId, $postId, $productcategoryId, $productId);
        $message = [
            'result' => '200',
            'messageEn' => 'Added to cart',
            'messageAr' => 'تم استجاع البيانات بنجاح'
        ];
        $this->set_response($message, REST_Controller::HTTP_OK);
    }

    public function GetCartItems_get() {
        $userId = $_GET['userId'];

//       $trader=$this->Trader_mdl->get_cart_traderinfo($userId);
        $data['qry'] = $this->Trader_mdl->checkcart($userId);

        if (count($data['qry']) == 0) {

            $msg = "No result found.";
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $cart = $this->Trader_mdl->get_cart_traderid($userId);
            $data['result'] = '200';
            $data['messageEn'] = 'Cart details retrieved';
            $data['messageAr'] = 'تم استجاع البيانات بنجاح';

            $data['data'] = $this->Trader_mdl->get_cart_traderid($userId);

            if ($data) {

                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function RemoveFromCart_post() {
        $userId = $_GET['userId'];
        $postId = $_GET['postId'];
        $this->db->where('traderID', $userId);
        $this->db->where('postID', $postId);
        if ($this->db->delete('cartlist')) {
            $message = [
                'result' => '200',
                'messageEn' => 'Successfully Deleted',
                'messageAr' => 'تم استجاع البيانات بنجاح'
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
            //$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Please select the payment method.</div>');
        } else {
            $message = [
                'message' => 'Please try again'
            ];
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function SetFavourite_post() {
        $userId = $_GET['userId'];
        $postId = $_GET['postId'];
        $productcategoryId = $_GET['productcategoryId'];
        $productId = $_GET['productId'];

        $this->Trader_mdl->addtofavourite($userId, $postId, $productcategoryId, $productId);
        $message = [
            'result' => '200',
            'messageEn' => 'Added to favourite',
            'messageAr' => ' تم استجاع البيانات بنجاح'
        ];
        $this->set_response($message, REST_Controller::HTTP_OK);
    }

    public function GetFavourites_get() {
        $userId = $_GET['userId'];
//       $product= $this->Trader_mdl->get_favourite_traderid($userId);
//       $trader=$this->Trader_mdl->get_info_traderid($userId);
        $data['qry'] = $this->Trader_mdl->checktrader($userId);

        if (count($data['qry']) == 0) {

            $msg = "No result found.";
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data['result'] = '200';
            $data['messageEn'] = 'Favourite item details retrieved';
            $data['messageAr'] = 'تم استجاع البيانات بنجاح';
            $data['data'] = $this->Trader_mdl->get_favourite_traderid($userId);

            if ($data) {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function addcart_post() {
        $product_id = $_GET['product_id'];
        $customer_id = $_GET['customer_id'];
        $this->Trader_mdl->addto_cart($product_id, $customer_id);
        $message = [
            'message' => 'Added to cart'
        ];
        $this->set_response($message, REST_Controller::HTTP_OK);
    }

    public function view_cart_get() {
        $customer_id = $_GET['customer_id'];
        $data['cart_qry'] = $this->Trader_mdl->showcart_cnt($customer_id);
        $data['watch_qry'] = $this->Trader_mdl->showwatch_cnt($customer_id);
        $data['qry'] = $this->Trader_mdl->showcart_details($customer_id);
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function view_watch_get() {
        $customer_id = $_GET['customer_id'];
        $data['cart_qry'] = $this->Trader_mdl->showcart_cnt($customer_id);
        $data['watch_qry'] = $this->Trader_mdl->showwatch_cnt($customer_id);

        $data['qry'] = $this->Trader_mdl->showwatch_details($customer_id);
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function traders_get() {
        $data['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $data['watch_qry'] = $this->Trader_mdl->watch_cnt();
        $query = $this->Trader_mdl->all_traders();
        $data['records'] = $query['records'];
        $data['count'] = $query['count'];
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function getpostbycategoryid_get() {
        $limit = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $categoryId = $_GET['categoryId'];
        $config = array();
        $config['base_url'] = base_url() . "Trader/view_car_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_car();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->get_post_bycatid($categoryId, $per_page_cnt, $limit);
        $str_links = $this->pagination->create_links();
//           
        $data['result'] = '200';
        $data['message'] = 'category details retrieved';
        $data['data']['Category'] = $query;
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getraderbytraderId_get() {
        $traderId = $_GET['traderId'];

        $trader = $this->Trader_mdl->get_trader_bytraderId($traderId);
//        $tr=$tr.substring(1,$trader.length-1);
        if ($trader) {
            $data['result'] = '200';
            $data['messageEn'] = 'Trader details retrieved';
            $data['messageAr'] = "تم استجاع البيانات بنجاح";

            $data['data'] = $trader[0];

            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['result'] = '100';
            $data['message'] = 'Inavalid Data';
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getbrandmodels_get() {
        $data['result'] = '200';
        $data['messageEn'] = 'Brand and model details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
//        $data['data'] = array();
        $carbrands = $this->Trader_mdl->carbrand();
        $bikebrands = $this->Trader_mdl->bikebrand();
        $boatbrands = $this->Trader_mdl->boatbrands();
        $vertubrands = $this->Trader_mdl->vertubrands();
        $watchbrands = $this->Trader_mdl->watchbrands();
        $phonebrands = $this->Trader_mdl->phonebrands();
        
        foreach ($carbrands as $k) {
            $carmodels = $this->Trader_mdl->carmodel($k->brandName);
           
            $data['data']['Carbrands'] = ['brandName' => $k->brandName, 'brandModels' => $carmodels];
        }
        foreach ($bikebrands as $k) {
            $bikemodels = $this->Trader_mdl->bikemodel($k->brandName);
            $data['data']['Bikebrands'] = ['brandName' => $k->brandName, 'brandModels' => $bikemodels];
        }
        foreach ($boatbrands as $k) {
            $boatmodels = $this->Trader_mdl->boatmodel($k->brandName);
            $data['data']['Boatbrands'] = ['brandName' => $k->brandName, 'brandModels' => $boatmodels];
        }
       foreach ($vertubrands as $k) {
            $vertumodels = $this->Trader_mdl->vertumodel($k->brandName);
            $data['data']['Vertubrands'] = ['brandName' => $k->brandName, 'brandModels' => $vertumodels];
        }
        foreach ($watchbrands as $k) {
            $watchmodels = $this->Trader_mdl->watchmodel($k->brandName);
            $data['data']['Watchbrands'] = ['brandName' => $k->brandName, 'brandModels' => $watchmodels];
        }
        foreach ($phonebrands as $k) {
            $phonemodels = $this->Trader_mdl->phonemodel($k->brandName);
            $data['data']['Phonebrands'] = ['brandName' => $k->brandName, 'brandModels' => $phonemodels];
        }


        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getbankdetails_get() {
        $bank = $this->Trader_mdl->getbank();
        $data['result'] = '200';
        $data['messageEn'] = 'Bank account details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
        $data['data'] = array();
        $data['data'] = $bank[0];
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getalshamillocations_get() {
        $locations = $this->Trader_mdl->getlocation();
        $data['result'] = '200';
        $data['messageEn'] = 'Alshamil locations details retrieved';
        $data['messageAr'] = ' تم استجاع البيانات بنجاح';
        $data['data'] = array();
        $data['data']['Locations'] = $locations;
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getreportpost_post() {
        $userId = $_POST['userId'];
        $postId = $_POST['postId'];
        $reason = $_POST['reason'];
        $this->Trader_mdl->addtoflag($userId, $postId, $reason);
        $message = [
            'result' => '200',
            'messageEn' => 'Added to flag list',
            'messageAr' => 'تم استجاع البيانات بنجاح'
        ];
        $this->set_response($message, REST_Controller::HTTP_OK);
    }

    function getplans_get() {
        $data['result'] = '200';
        $data['messageEn'] = 'Plan details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
        $data['data'] = array();
        $data['data']['Plans'] = $this->Trader_mdl->getplans();
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getuserapprovedpost_get() {
        $li = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $limit = $li * $per_page_cnt;
        $userId = $_GET['userId'];
        $data['qry'] = $this->Trader_mdl->checkapproved($userId);

        if (count($data['qry']) == 0) {

            $msg = "No result found.";
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $config = array();
            $config['base_url'] = base_url() . "Trader/view_car_category";
            $config["total_rows"] = $this->Trader_mdl->record_count_car();
            $config["per_page"] = 1;
            $config["uri_segment"] = 3;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            // $query = $this->Trader_mdl->get_post_lists($config["per_page"], $page);
            //$query = $this->Trader_mdl->get_post_lists($limit, $page);
            $query = $this->Trader_mdl->get_post_approved($per_page_cnt, $limit, $userId);
            $str_links = $this->pagination->create_links();
            $count = $this->Trader_mdl->get_countapproved($userId);

            $new = $count[0]->approved_count;
            $data['result'] = '200';
            $data['messageEn'] = 'user approved post list details retrieved';
            $data['messageAr'] = 'تم استجاع البيانات بنجاح';
//             $data["links"] = explode('&nbsp;', $str_links);
            $data['data'] = [
                'count' => $new,
                'posts' => $query,
//                'page'=>$limit,
//                'per_page_cnt'=>$per_page_cnt
//           
            ];
            //$data['post_list']=$this->Trader_mdl->get_post_lists(); 
            if ($data) {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Gettraders_get() {
        $li = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $limit = $li * $per_page_cnt;
        $userId = $_GET['userId'];

        $config = array();
        $config['base_url'] = base_url() . "Trader/view_car_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_car();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
//      $data['cart_qry']= $this->Trader_mdl->cart_cnt();
//           $data['watch_qry']= $this->Trader_mdl->watch_cnt();
        $query = $this->Trader_mdl->all_traders($userId, $per_page_cnt, $limit);

        $str_links = $this->pagination->create_links();
        $count = $this->Trader_mdl->count_traders();
        $new = $count[0]->total_entries;
        $data['result'] = '200';
        $data['messageEn'] = 'Post list details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';

        $data['data'] = [
            'total' => $new,
            'traders' => $query
        ];
//             $data['total']=$new;
//             $data['data']['trader'] = $query['records'];
//            $data['count'] = $query['count'];
//            $data["links"] = explode('&nbsp;', $str_links);
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getmyprofile_get() {

        $userId = $_GET['userId'];

        $trader = $this->Trader_mdl->get_myprofile($userId);
        if ($trader) {
            $data['result'] = '200';
            $data['messageEn'] = 'Trader details retrieved';
            $data['messageAr'] = 'تم استجاع البيانات بنجاح';
            $data['data'] = $trader[0];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['result'] = '100';
            $data['message'] = 'Inavalid Data';
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getuserbookedpost_get() {
        $li = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $limit = $li * $per_page_cnt;
        $userId = $_GET['userId'];
        $config = array();
        $config['base_url'] = base_url() . "Trader/view_car_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_car();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // $query = $this->Trader_mdl->get_post_lists($config["per_page"], $page);
        //$query = $this->Trader_mdl->get_post_lists($limit, $page);
        $query = $this->Trader_mdl->get_post_booked($per_page_cnt, $limit, $userId);
        $booked = $this->Trader_mdl->get_bookeduser($userId);
        $count = $this->Trader_mdl->get_countbooked($userId);
        $new = $count[0]->booked_count;
        $str_links = $this->pagination->create_links();
        $data['result'] = '200';
        $data['messageEn'] = 'user booked post list details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
//             $data["links"] = explode('&nbsp;', $str_links);
        $data['data'] = [
            'count' => $new,
            'post' => $query,
//                'booked user Info'=>$booked
//                'page'=>$limit,
//                'per_page_cnt'=>$per_page_cnt
//           
        ];
        //$data['post_list']=$this->Trader_mdl->get_post_lists(); 
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getnotification_get() {
        $userId = $_GET['userId'];
        $data['qry'] = $this->Trader_mdl->checknotification($userId);

        if (count($data['qry']) == 0) {

            $msg = "No result found.";
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $query = $this->Trader_mdl->get_notification($userId);
//        $count = $this->Trader_mdl->get_notificationtype($userId);
//        $new=$count[0]->notificationtype;
//        $trader = $this->Trader_mdl->get_traderinfo($userId);
            $data['result'] = '200';
            $data['messageEn'] = 'user notification  details retrieved';
            $data['messageAr'] = 'تم استجاع البيانات بنجاح';

            $data['data']['NotificationList'] = [
//            'NotificationType'=>$new,
                $query[0],
//                'traderInfo'=>$trader
            ];

            if ($data) {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function RemoveFavourite_post() {
        $userId = $_GET['userId'];
        $postId = $_GET['postId'];
        $this->db->where('traderID', $userId);
        $this->db->where('postID', $postId);
        if ($this->db->delete('watchlist')) {
            $message = [
                'result' => '200',
                'messageEn' => 'Successfully Removed From Favourites',
                'messageAr' => 'تم استجاع البيانات بنجاح'
            ];
            $this->set_response($message, REST_Controller::HTTP_OK);
            //$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Please select the payment method.</div>');
        } else {
            $message = [
                'result' => '100',
                'message' => 'Please try again'
            ];
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getuserpendingpost_get() {
        $li = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $limit = $li * $per_page_cnt;
        $userId = $_GET['userId'];

        $config = array();
        $config['base_url'] = base_url() . "Trader/view_car_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_car();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // $query = $this->Trader_mdl->get_post_lists($config["per_page"], $page);
        //$query = $this->Trader_mdl->get_post_lists($limit, $page);
        $query = $this->Trader_mdl->get_post_pending($per_page_cnt, $limit, $userId);
        $str_links = $this->pagination->create_links();
        $count = $this->Trader_mdl->get_countpending($userId);
        $new = $count[0]->pending_count;
        $data['result'] = '200';
        $data['messageEn'] = 'user pending post list details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
//             $data["links"] = explode('&nbsp;', $str_links);
        $data['data'] = [
            'count' => $new,
            'posts' => $query,
//                'page'=>$limit,
//                'per_page_cnt'=>$per_page_cnt
//           
        ];
        //$data['post_list']=$this->Trader_mdl->get_post_lists(); 
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getuserrejectedpost_get() {
        $li = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $limit = $li * $per_page_cnt;
        $userId = $_GET['userId'];
        $config = array();
        $config['base_url'] = base_url() . "Trader/view_car_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_car();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // $query = $this->Trader_mdl->get_post_lists($config["per_page"], $page);
        //$query = $this->Trader_mdl->get_post_lists($limit, $page);
        $query = $this->Trader_mdl->get_post_rejected($per_page_cnt, $limit, $userId);
        $count = $this->Trader_mdl->get_countrejected($userId);
        $new = $count[0]->rejected_count;
        $str_links = $this->pagination->create_links();
        $data['result'] = '200';
        $data['messageEn'] = 'user rejected post list details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
//             $data["links"] = explode('&nbsp;', $str_links);
        $data['data'] = [
            'count' => $new,
            'posts' => $query,
//                'page'=>$limit,
//                'per_page_cnt'=>$per_page_cnt
//           
        ];
        //$data['post_list']=$this->Trader_mdl->get_post_lists(); 
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getusersoldoutpost_get() {
        $li = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $limit = $li * $per_page_cnt;
        $userId = $_GET['userId'];
        $config = array();
        $config['base_url'] = base_url() . "Trader/view_car_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_car();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // $query = $this->Trader_mdl->get_post_lists($config["per_page"], $page);
        //$query = $this->Trader_mdl->get_post_lists($limit, $page);
        $query = $this->Trader_mdl->get_post_soldout($per_page_cnt, $limit, $userId);
        $count = $this->Trader_mdl->get_countsold($userId);
        $new = $count[0]->sold_count;
        $buyer = $this->Trader_mdl->get_buyer($userId);
        $str_links = $this->pagination->create_links();
        $data['result'] = '200';
        $data['messageEn'] = 'user sold post list details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
//             $data["links"] = explode('&nbsp;', $str_links);
        $data['data'] = [
            'count' => $new,
            'posts' => $query,
//                'buyer'=>$buyer,
//                'page'=>$limit,
//                'per_page_cnt'=>$per_page_cnt
//           
        ];
        //$data['post_list']=$this->Trader_mdl->get_post_lists(); 
        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function getpostcategoryId_get() {

        $categoryId = $_GET['categoryId'];
        $li = $_GET['page'];
        $per_page_cnt = $_GET['perPageCount'];
        $limit = $li * $per_page_cnt;
        $carBrand = $_GET['carBrand'];
        $carModel = $_GET['carModel'];
        $carStartDate = $_GET['carStartDate'];
        $carEndDate = $_GET['carEndDate'];
        $bikeBrand = $_GET['bikeBrand'];
        $bikeModel = $_GET['bikeModel'];
        $bikeStartDate = $_GET['bikeStartDate'];
        $bikeEndDate = $_GET['bikeEndDate'];
        $npEmirate = $_GET['npEmirate'];
        $npCode = $_GET['npCode'];
        $npDigitCount = $_GET['npDigitCount'];
        $vertuBrand = $_GET['vertuBrand'];
        $vertuModel = $_GET['vertuModel'];
        $watchBrand = $_GET['watchBrand'];
        $watchModel = $_GET['watchModel'];

        $mnPrefix = $_GET['mnPrefix'];
        $mnOperator = $_GET['mnOperator'];
        $mnDigitCount = $_GET['mnDigitCount'];

        $boatBrand = $_GET['boatBrand'];
        $boatModel = $_GET['boatModel'];
        $phoneBrand = $_GET['phoneBrand'];
        $phoneModel = $_GET['phoneModel'];
        $propertiesCategory = $_GET['propertiesCategory'];
        $propertiesSubCategory = $_GET['propertiesSubCategory'];
        $query = $this->Trader_mdl->filter($categoryId, $carBrand, $carModel, $carStartDate, $carEndDate, $bikeBrand, $bikeModel, $bikeStartDate, $bikeEndDate, $npEmirate, $npCode, $npDigitCount, $vertuBrand, $vertuModel, $watchBrand, $watchModel, $mnPrefix, $mnOperator, $mnDigitCount, $boatBrand, $boatModel, $phoneBrand, $phoneModel, $propertiesCategory, $propertiesSubCategory, $per_page_cnt, $limit);
//       echo '<pre>';print_r($query);exit();
        $data['result'] = '200';
        $data['messageEn'] = 'Category details retrieved';
        $data['messageAr'] = 'تم استجاع البيانات بنجاح';
        $data['data'] = [
            'posts' => $query,
        ];

        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function login_post() {
        if (!empty($_POST['username']) && (!empty($_POST['password']))) {
            $txtemail = $_POST['username'];
            $txtpassword = $_POST['password'];
            $txtusertype = $_POST['userTypeId'];
            $deviceId = $_POST['deviceId'];

            $result = $this->Trader_mdl->get_traderlist($txtemail, $txtpassword, $txtusertype, $deviceId);

            if ($result) {
                $data['result'] = '200';
                $data['messageEn'] = 'trader details retreived';
                $data['messageAr'] = 'تم استجاع البيانات بنجاح';
                $data['data'] = $result;
                $this->response($data, REST_Controller::HTTP_OK);
            } else {

                $data['result'] = '100';
                $data['message'] = 'error';
                $this->response($data, REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $data['result'] = '100';
            $data['message'] = 'please enter your details';
            $this->response($data, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function check_database($txtpassword) {
        $txtusertype = $this->input->post('txtusertype');
        $txtemail = $this->input->post('txtemail');
        $result = $this->Trader_mdl->get_trader($txtemail, $txtpassword, $txtusertype);
        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'trader_id' => $row->traderID,
                    'txtemail' => $row->traderEmailID,
                    'txtusertype' => $row->usertype
                );

                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', '<div class="alert alert-danger text-center">Invalid Username and Password!</div>');
            return false;
        }
    }

    function AttachDepositSlip_post() {
        $userId = $_POST['userId'];
        $planId = $_POST['planId'];
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $_FILES['depositSlipImage']['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('depositSlipImage')) {
            $uploadData = $this->upload->data();

            $depositSlipImage = $uploadData['file_name'];
        } else {
            $depositSlipImage = 'noimage.png';
        }

        $data = array(
            'traderID' => $userId,
            'planID' => $planId,
            'planDepositSlip' => $depositSlipImage,
        );

        if ($this->db->insert('tradersubscriptionplan', $data)) {

            $data = [
                'result' => '200',
                'messageEn' => 'Successfully attached payslip',
                'messageAr' => ' تم استجاع البيانات بنجاح',
            ];

            $this->set_response($data, REST_Controller::HTTP_OK);
            //$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Please select the payment method.</div>');
        } else {
            $message = [
                'result' => '100',
                'message' => 'Please try again'
            ];
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function checkout_get() {
        $data = array();
        $postId = $_GET['postId'];
        $userId = $_GET['userId'];

//      
        $sum = 0;
        foreach ($postId as $key => $value) {

            $price = $this->Trader_mdl->getprice($value);
            $product = $this->Trader_mdl->getproductid($value);
            $sum = $sum + $price[0]->productCPrice;
            $sum = $sum + $price[0]->productBPrice;
            $sum = $sum + $price[0]->productWPrice;
            $sum = $sum + $price[0]->productVPrice;
            $sum = $sum + $price[0]->productPRPrice;
            $sum = $sum + $price[0]->productNPPrice;
            $sum = $sum + $price[0]->productMNPrice;
            $sum = $sum + $price[0]->productBTPrice;
            $sum = $sum + $price[0]->productPHPrice;
            $ecotax = '1000';
            $vat = (10 / 100) * $sum;
            $total = $sum + $ecotax + $vat;
        }
        if ($postId) {
            $data['result'] = '200';
            $data['messageEn'] = 'checkout details retreived';
            $data['messageAr'] = 'تم استجاع البيانات بنجاح';
            $data['data'] = [
                'subtotal' => $sum,
                'ecotax' => $ecotax,
                'vatpercentage' => '10',
                'vatamount' => $vat,
                'totalamount' => $total,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $data['result'] = '100';
            $data['message'] = 'error';
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }



    function setplan_post() {
        if(isset($_POST['planId'])&&isset($_POST['traderId'])){
            $inpt['planID'] = $_POST['planId'];
            $inpt['traderID']= $_POST['traderId'];
            $check= $this->Api_mdl->isExists("traderID",$inpt['traderID'],"tradersubscriptionplan");
            if(!$check){
                if ($this->db->insert('tradersubscriptionplan', $inpt)) {

                    $data = [
                        'result' => '200',
                        'message' => 'Successfully Added subscriber'
                        ];
                }
            
            }else{
                $data = [
                    'result' => '201',
                    'message' => 'Already subscribed'
                    ];
            }
        }else{
             $data = [
                    'result' => '204',
                    'message' => 'Data Incomplete'
                    ];
        }

        if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    

    function setpayment_post() {
        //paymentTypeChosen
        if(isset($_POST['paymentType'])&&isset($_POST['traderId'])){
            $ptype=$_POST['paymentType'];
            $tid = $_POST['traderId'];
            switch ($_POST['paymentType']) {
                case 1:
                     $inpt = [
                    'paymentTypeChosen' => $ptype,
                    'traderID' =>  $tid,
                    'paymentProof' => ''
                    ];
                    break;
                case 2:
                     $inpt = [
                    'paymentTypeChosen' => $ptype,
                    'traderID' =>  $tid,
                    'paymentProof' =>$this->Api_mdl->uploadfile(0,"payment") //image uploaded
                    ];
                    break;
                case 3:
                     $inpt = [
                    'paymentTypeChosen' =>$ptype,
                    'traderID' =>  $tid,
                    'paymentProof' =>$_POST['transactionId']
                    ];
                    break;
                
                default:
                    $inpt = [
                    'paymentTypeChosen' =>0,
                    'traderID' =>  $tid,
                    'paymentProof' => ''
                    ];
            }
             $this->db->where('traderID',  $tid);
               if ($this->db->update('tradersubscriptionplan', $inpt)) {

                $data = [
                    'result' => '200',
                    'message' => 'Paid subscriber added successfully'
                    ];
            }

        }else{
            $data = [
                    'result' => '204',
                    'message' => 'Data Incomplete'
                    ];
        }

if ($data) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
    }


/*******************BBBBBB******************************/
 public function CarAddPost() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }

        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
//
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp4';
            $config['file_name'] = time();
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }

        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = time();
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }








        $post_date = date('Y-m-d h:i:sa');
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
        $data['productCBrand'] = $brand;
        $data['productCModel'] = $model;
        $data['productCReleaseYear'] = $year;
        $data['productCPrice'] = $price;
        $data['productCCallPrice'] = $callforprice;
        $data['productCDesc'] = $details;
        $data['productCSubmitDate'] = $post_date;
        $data['cartCType'] = $cartype;
        $data['Cpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productcar', $data);
        $last_prd_id = $this->db->insert_id();

        $postdata['traderID'] = $traderID;
        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();
        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {
                $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);
                
             $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;
                $rand_val = rand(10, 100);
                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key],$target_file)) {
                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() .  $target_file;
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $updimg_data);
                } else {
                    $msg = "error in uploading";
                    $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        }



        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);


        $query = $this->Trader_mdl->Car_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '1');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'message' => 'Product Car Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function CarUpdatePost() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];

        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];



        if (isset($_FILES['image']['name'])) {

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }


//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
//        $data['productCategoryID']=$categoryID;
        $data['productCBrand'] = $brand;
        $data['productCModel'] = $model;
        $data['productCReleaseYear'] = $year;
        $data['productCCallPrice'] = $callforprice;
        $data['productCPrice'] = $price;
        $data['productCDesc'] = $details;
        $data['productCSubmitDate'] = $post_date;
        $data['Cpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productcar', $data);
        //$last_prd_id = $this->db->insert_id();
        //$postdata['productID']= $last_prd_id;
        //$postdata['productCategoryID']= $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);
        //$last_post_id = $this->db->insert_id();
        //$updimg_data['productID'] = $last_prd_id;
        //$updimg_data['postID'] = $last_post_id;
        //$updimg_data['productCategoryID'] = $categoryID;
//            $updimg_data['traderID'] = '';



        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';

        $config['overwrite'] = FALSE;

        $this->load->library('upload');
        if (isset($_FILES['images']['name'])) {
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;





                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }



        if ($this->db->update('productcar', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Car Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function BikeAddPost() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
//       $categoryname=$_GET['categoryname'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
//        $data['productCategoryName']=$categoryname;
        $data['cartBType'] = $cartype;
        $data['productBBrand'] = $brand;
        $data['productBModel'] = $model;
        $data['productBReleaseYear'] = $year;
        $data['productBCallPrice'] = $callforprice;
        $data['productBPrice'] = $price;
        $data['productBDesc'] = $details;
        $data['productBSubmitDate'] = $post_date;
        $data['Bpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productbike', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['traderID'] = $traderID;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();

        if (isset($_FILES['images']['name'])) {

            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;




                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }





        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);





        $query = $this->Trader_mdl->Bike_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '2');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'message' => 'Product Bike Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function BikeUpdatePost() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $location = $_GET['location'];

        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;



        if (isset($_FILES['image']['name'])) {

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
//        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $data['productCategoryID'] = $categoryID;
        $data['productBBrand'] = $brand;
        $data['productBModel'] = $model;
        $data['productBReleaseYear'] = $year;
        $data['productBCallPrice'] = $callforprice;
        $data['productBPrice'] = $price;
        $data['productBDesc'] = $details;
        $data['productBSubmitDate'] = $post_date;
        $data['Bpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productbike', $data);




        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);
        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

//         $updimg_data['traderID'] = '';
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }

            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }




        if ($this->db->update('productbike', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Bike Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function VertuAddPost() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
        $data['productVBrand'] = $brand;
        $data['productVModel'] = $model;
        $data['cartVType'] = $cartype;
//        $data['productVReleaseYear']=$year;
        $data['productVCallPrice'] = $callforprice;
        $data['productVPrice'] = $price;
        $data['productVDesc'] = $details;
        $data['productVSubmitDate'] = $post_date;
        $data['Vpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productvertu', $data);
        $last_prd_id = $this->db->insert_id();

        $postdata['traderID'] = $traderID;
        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();

        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;





                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }



        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);




        $query = $this->Trader_mdl->Vertu_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '4');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Vertu Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function VertuUpdatePost() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];

        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        if (isset($_FILES['image']['name'])) {

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }


        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['productVBrand'] = $brand;
        $data['productVModel'] = $model;
//        $data['productVReleaseYear']=$year;
        $data['productVCallPrice'] = $callforprice;
        $data['productVPrice'] = $price;
        $data['productVDesc'] = $details;
        $data['productVSubmitDate'] = $post_date;
        $data['Vpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productvertu', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);
        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

//            $updimg_data['traderID'] = '';
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }

        if ($this->db->update('productvertu', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product vertu Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function WatchAddPost() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
//       $price = $_GET['price'];
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }

//
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
        $data['productWBrand'] = $brand;
        $data['productWModel'] = $model;
        $data['productWCallPrice'] = $callforprice;
        $data['cartWType'] = $cartype;
        //$data['productWReleaseYear']=$year;
        $data['productWPrice'] = $price;
        $data['productWDesc'] = $details;
        $data['productWSubmitDate'] = $post_date;
        $data['Wpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productwatch', $data);
        $last_prd_id = $this->db->insert_id();

        $postdata['traderID'] = $traderID;
        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();
        if (isset($_FILES['images']['name'])) {

            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;








                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }




        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);

        $query = $this->Trader_mdl->Watch_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '5');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Watch Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function WatchUpdatePost() {
        $rand_val = rand(10, 100);
        $data = array();
//       $location = $_GET['location'];
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];


        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
//        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }


        $post_date = date('Y-m-d h:i:sa');
        //$data['productLocation'] = $location;
        $data['productCategoryID'] = $categoryID;
        $data['productWBrand'] = $brand;
        $data['productWModel'] = $model;
        //$data['productWReleaseYear']=$year;
        $data['productWCallPrice'] = $callforprice;
        $data['productWPrice'] = $price;
        $data['productWDesc'] = $details;
        $data['productWSubmitDate'] = $post_date;
        $data['Wpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productwatch', $data);



        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);

        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

                    //       $updimg_data['productImage'] = base_url().'uploads/product_images/'.$rand_val.'_'.$_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }




        if ($this->db->update('productwatch', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Watch Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function BoatAddPost() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];

        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {

            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['traderID'] = $traderID;
        $data['productBtBrand'] = $brand;
        $data['productBtModel'] = $model;
        $data['productBtCallPrice'] = $callforprice;
//        $data['productBReleaseYear']=$year;
        $data['cartBTType'] = $cartype;
        $data['productBTPrice'] = $price;
        $data['productBDesc'] = $details;
        $data['productBTSubmitDate'] = $post_date;
        $data['BTpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productboat', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();
        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;



                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }



        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);




        $query = $this->Trader_mdl->Boat_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '7');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Boat Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function BoatUpdatePost() {
        $rand_val = rand(10, 100);
        $data = array();
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }

        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];

        if (isset($_FILES['image']['name'])) {


            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
//        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');

        $data['productCategoryID'] = $categoryID;
        $data['productBtBrand'] = $brand;
        $data['productBtModel'] = $model;

        $data['productBtCallPrice'] = $callforprice;
        $data['productBTPrice'] = $price;
        $data['productBDesc'] = $details;
        $data['productBTSubmitDate'] = $post_date;
        $data['BTpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productboat', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);


        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

//            $updimg_data['traderID'] = '';
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }



        if ($this->db->update('productboat', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Boat Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function PhoneAddPost() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
//       $price = $_GET['price'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];


        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }

//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['traderID'] = $traderID;
        $data['productPBrand'] = $brand;
        $data['productPModel'] = $model;
//        $data['productPReleaseYear']=$year;
        $data['productPhCallPrice'] = $callforprice;
        $data['cartPHType'] = $cartype;
        $data['productPHPrice'] = $price;
        $data['productPDesc'] = $details;
        $data['productPSubmitDate'] = $post_date;
        $data['PHpost_main_img'] = base_url() . 'uploads/product_images/' . $image;

        $this->db->insert('productphone', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();
        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';

        $config['overwrite'] = FALSE;

        $this->load->library('upload');
        if (isset($_FILES['images']['name'])) {
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }




        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);







        $query = $this->Trader_mdl->Phone_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '8');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Phone Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];

            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function PhoneUpdatePost() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
//        $year = $_GET['year'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];
        $post_date = date('Y-m-d h:i:sa');
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['productPBrand'] = $brand;
        $data['productPModel'] = $model;
//        $data['productPReleaseYear']=$year;
        $data['productPhCallPrice'] = $callforprice;
        $data['productPHPrice'] = $price;
        $data['productPDesc'] = $details;
        $data['productPSubmitDate'] = $post_date;
        $data['PHpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productphone', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);

//            $updimg_data['traderID'] = '';



        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;

                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }






        if ($this->db->update('productphone', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Phone Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function NoplateAddPost() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];
        $emirate = $_POST['emirate'];
        $templateId = $_POST['templateId'];
        $code = $_POST['code'];
        $digitNumber = $_POST['digitNumber'];
        $numberPlateNumber = $_POST['numberPlateNumber'];
//        $image = $_GET['image'];

        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }






        $post_date = date('Y-m-d h:i:sa');
        $data['cartNPType'] = $cartype;
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['traderID'] = $traderID;
        $data['productNPEmrites'] = $emirate;
        $data['productNPTemplate'] = $templateId;
        $data['productNPCode'] = $code;
        $data['productNPDigits'] = $digitNumber;
        $data['productNPNmbr'] = $numberPlateNumber;
        $data['productNPCallPrice'] = $callforprice;
        $data['productNPPrice'] = $price;
        $data['productNPDesc'] = $details;
        $data['productNPSubmitDate'] = $post_date;
        $data['NPpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productnp', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();

        /* $updimg_data['productID'] = $last_prd_id;
          $updimg_data['postID'] = $last_post_id;
          $updimg_data['productCategoryID'] = $categoryID;
          $updimg_data['traderID'] = '';
          $updimg_data['productImage'] = $mod_medialist;
          $updimg_data['productVideo'] = $video;
          $updimg_data['cartType'] = '';
          $updimg_data['productLive'] = '';
          $updimg_data['productVideoCount'] = '';
          $updimg_data['productViewCount'] = '';
          $updimg_data['productLastAccess'] = '';
          $updimg_data['productSubmitDate'] = $post_date; */

//             $this->db->insert('post', $postdata);



        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);







        $query = $this->Trader_mdl->NP_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '3');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Number plate  Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];

            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function NoplateUpdatePost() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }

        $details = $_POST['details'];
        $emirate = $_POST['emirate'];
        $templateId = $_POST['templateId'];
        $code = $_POST['code'];
        $digitNumber = $_POST['digitNumber'];
        $numberPlateNumber = $_POST['numberPlateNumber'];
//        $image = $_GET['image'];

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }




        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation'] = $location;
        $data['productCategoryID'] = $categoryID;

        $data['productNPEmrites'] = $emirate;
        $data['productNPTemplate'] = $templateId;
        $data['productNPCode'] = $code;
        $data['productNPDigits'] = $digitNumber;
        $data['productNPNmbr'] = $numberPlateNumber;
        $data['productNPCallPrice'] = $callforprice;
        $data['productNPPrice'] = $price;
        $data['productNPDesc'] = $details;
        $data['productNPSubmitDate'] = $post_date;
        $data['NPpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productnp', $data);
//        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        //$this->db->insert('post',$postdata);
        //$last_post_id = $this->db->insert_id();

        /* $updimg_data['productID'] = $last_prd_id;
          $updimg_data['postID'] = $last_post_id;
          $updimg_data['productCategoryID'] = $categoryID;
          $updimg_data['traderID'] = '';
          $updimg_data['productImage'] = $mod_medialist;
          $updimg_data['productVideo'] = $video;
          $updimg_data['cartType'] = '';
          $updimg_data['productLive'] = '';
          $updimg_data['productVideoCount'] = '';
          $updimg_data['productViewCount'] = '';
          $updimg_data['productLastAccess'] = '';
          $updimg_data['productSubmitDate'] = $post_date; */
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        if ($this->db->update('post', $postdata)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Number Plate Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function MobileNoAddPost() {
        $data = array();
        $rand_val = rand(10, 100);
//       $location = $_GET['location'];
        $traderID = $_POST['traderID'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = '';
        }
        $details = $_POST['details'];
        $operatorId = $_POST['operatorId'];
        if ($operatorId == 1) {
            $operator = "DU";
        } else if ($operatorId == 2) {
            $operator = "Etisalat";
        } else if ($operatorId == 3) {
            $operator = "Others";
        }
        $prefix = $_POST['prefix'];
        $digitType = $_POST['digitType'];
        $mobileNumber = $_POST['mobileNumber'];
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }

        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }



        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['traderID'] = $traderID;
        $data['productOperator'] = $operator;
        $data['productMNPrefix'] = $prefix;
        $data['productMNDigits'] = $digitType;
        $data['cartMNType'] = $cartype;
        $data['productMNNmbr'] = $mobileNumber;
        $data['productMNCallPrice'] = $callforprice;
        $data['productMNPrice'] = $price;
        $data['productMNDesc'] = $details;
        $data['productMNSubmitDate'] = $post_date;
        $data['MNpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productmn', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();


        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);




        $query = $this->Trader_mdl->MN_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '6');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Mobile  Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];

            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function MobileNoUpdatePost() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = '';
        }


        $details = $_POST['details'];

        $operatorId = $_POST['operatorId'];
        if ($operatorId == 1) {
            $operator = "DU";
        } else if ($operatorId == 2) {
            $operator = "Etisalat";
        } else if ($operatorId == 3) {
            $operator = "Others";
        }
        $prefix = $_POST['prefix'];
        $digitType = $_POST['digitType'];
        $mobileNumber = $_POST['mobileNumber'];
//        $image = $_GET['image'];

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }





        $post_date = date('Y-m-d h:i:sa');

        $data['productCategoryID'] = $categoryID;

        $data['productOperator'] = $operator;
        $data['productMNPrefix'] = $prefix;
        $data['productMNDigits'] = $digitType;
        $data['productMNNmbr'] = $mobileNumber;
        $data['productMNCallPrice'] = $callforprice;
        $data['productMNPrice'] = $price;
        $data['productMNDesc'] = $details;
        $data['productMNSubmitDate'] = $post_date;
        $data['MNpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productmn', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';

        //$last_post_id = $this->db->insert_id();

        /* $updimg_data['productID'] = $last_prd_id;
          $updimg_data['postID'] = $last_post_id;
          $updimg_data['productCategoryID'] = $categoryID;
          $updimg_data['traderID'] = '';
          $updimg_data['productImage'] = $mod_medialist;
          $updimg_data['productVideo'] = $video;
          $updimg_data['cartType'] = '';
          $updimg_data['productLive'] = '';
          $updimg_data['productVideoCount'] = '';
          $updimg_data['productViewCount'] = '';
          $updimg_data['productLastAccess'] = '';
          $updimg_data['productSubmitDate'] = $post_date; */
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        if ($this->db->update('post', $postdata)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Mobile Number Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function PropertyAddPost() {
        $data = array();
        $rand_val = rand(10, 100);
//        $location = $_GET['location'];
        $categoryID = $_POST['categoryID'];
        $traderID = $_POST['traderID'];
        $callforprice = $_POST['callforprice'];
//        $price = $_GET['price'];
        $details = $_POST['details'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
//        $property_type = $_GET['property_type'];
        $itemId = $_POST['itemId'];
        if ($itemId == 1) {
            $category = "Rent";
        } else if ($itemId == 2) {
            $category = "Buy";
        } else if ($itemId == 3) {
            $category = "Hotels";
        } else if ($itemId == 4) {
            $category = "stores";
        }
        $subcategoryId = $_POST['subcategoryId'];
        if ($subcategoryId == 1) {
            $subcategory = "studio";
        } else if ($subcategoryId == 2) {
            $subcategory = " 1 BHK";
        } else if ($subcategoryId == 3) {
            $subcategory = " 2BHK";
        } else if ($subcategoryId == 4) {
            $subcategory = " 3 BHK";
        } else if ($subcategoryId == 5) {
            $subcategory = "More";
        } else if ($subcategoryId == 6) {
            $subcategory = "Land";
        } else if ($subcategoryId == 7) {
            $subcategory = "Apartment";
        } else if ($subcategoryId == 8) {
            $subcategory = "Flat";
        } else if ($subcategoryId == 9) {
            $subcategory = "studio";
        } else if ($subcategoryId == 10) {
            $subcategory = " 1 Bed";
        } else if ($subcategoryId == 11) {
            $subcategory = "2 Bed";
        } else if ($subcategoryId == 12) {
            $subcategory = "3 Bed";
        } else if ($subcategoryId == 12) {
            $subcategory = "0-100 sqft";
        } else if ($subcategoryId == 13) {
            $subcategory = "100-500 sqft";
        } else if ($subcategoryId == 14) {
            $subcategory = "500-5000 sqft";
        } else if ($subcategoryId == 15) {
            $subcategory = "5000 and more sqft";
        }

        if ($traderID == 1) {
            $cartype = 1;
        } else {
            $cartype = 0;
        }
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['productVideo']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productVideo')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
            //        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }
        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['traderID'] = $traderID;
        $data['productCategoryID'] = $categoryID;
        $data['productPropSC'] = $subcategory;
        $data['productPropType'] = $category;
        $data['productPropCallPrice'] = $callforprice;
        $data['productPRPrice'] = $price;
        $data['productDesc'] = $details;
        $data['productPRSubmitDate'] = $post_date;
        $data['PRpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->insert('productproperty', $data);
        $last_prd_id = $this->db->insert_id();


        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = $categoryID;
        $postdata['traderID'] = $traderID;
        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();


        if (isset($_FILES['images']['name'])) {

            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;




                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = $categoryID;
                    $updimg_data['traderID'] = $traderID;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->insert('productiv', $updimg_data);
        }


        $traderqry = $this->Trader_mdl->traderpostcount($traderID);
        $tr_post_cnt = $traderqry[0]->traderPostCount;
        $update_tr_post_cnt = $tr_post_cnt + 1;
        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $traderID);
        $this->db->update('trader', $tdata);





        $query = $this->Trader_mdl->Property_postcount();
        $result = $query[0]->categoryProductCount;
        $update_count = $result + 1;
        $cnt_data['categoryProductCount'] = $update_count;
        $this->db->where('productCategoryID', '9');
        if ($this->db->update('category', $cnt_data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product Property Details Added Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];

            $data['data'] = [
                'PostId' => $last_post_id,
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    public function PropertyUpdatePost() {
        $data = array();
        $rand_val = rand(10, 100);
        $postId = $_POST['postId'];
        $productId = $_POST['productId'];
        $categoryID = $_POST['categoryID'];
//       $location = $_GET['location'];
        $callforprice = $_POST['callforprice'];
        if ($callforprice == 0) {
            $price = $_POST['price'];
        } else {
            $price = ' ';
        }
        $details = $_POST['details'];


        $itemId = $_POST['itemId'];
        if ($itemId == 1) {
            $category = "Rent";
        } else if ($itemId == 2) {
            $category = "Buy";
        } else if ($itemId == 3) {
            $category = "Hotels";
        } else if ($itemId == 4) {
            $category = "stores";
        }
        $subcategoryId = $_POST['subcategoryId'];
        if ($subcategoryId == 1) {
            $subcategory = "studio";
        } else if ($subcategoryId == 2) {
            $subcategory = " 1 BHK";
        } else if ($subcategoryId == 3) {
            $subcategory = " 2BHK";
        } else if ($subcategoryId == 4) {
            $subcategory = " 3 BHK";
        } else if ($subcategoryId == 5) {
            $subcategory = "More";
        } else if ($subcategoryId == 6) {
            $subcategory = "Land";
        } else if ($subcategoryId == 7) {
            $subcategory = "Apartment";
        } else if ($subcategoryId == 8) {
            $subcategory = "Flat";
        } else if ($subcategoryId == 9) {
            $subcategory = "studio";
        } else if ($subcategoryId == 10) {
            $subcategory = " 1 Bed";
        } else if ($subcategoryId == 11) {
            $subcategory = "2 Bed";
        } else if ($subcategoryId == 12) {
            $subcategory = "3 Bed";
        } else if ($subcategoryId == 12) {
            $subcategory = "0-100 sqft";
        } else if ($subcategoryId == 13) {
            $subcategory = "100-500 sqft";
        } else if ($subcategoryId == 14) {
            $subcategory = "500-5000 sqft";
        } else if ($subcategoryId == 15) {
            $subcategory = "5000 and more sqft";
        }


//        $property_type = $_GET['property_type'];
//        $medialist = $_GET['medialist'];
//        $mod_medialist = serialize($medialist);
//        $mediaTypeId = $_GET['mediaTypeId'];
//        $image = $_GET['image'];
//        $video = $_GET['video'];

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();

                $image = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $image = 'noimage.png';
            }
        } else {
            $image = '';
        }
        if (isset($_FILES['video']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('video')) {
                $uploadData = $this->upload->data();
                $video = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $video = '';
            }
        } else {
            $video = '';
        }
        if (isset($_FILES['videoThumbnail']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = $_FILES['videoThumbnail']['name'];
//        $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoThumbnail')) {
                $uploadData = $this->upload->data();
                $videoThumbnail = $rand_val . '_' . $uploadData['file_name'];
            } else {
                $videoThumbnail = '';
            }
        } else {
            $videoThumbnail = '';
        }

        $post_date = date('Y-m-d h:i:sa');
//        $data['productLocation']=$location;
        $data['productCategoryID'] = $categoryID;
        $data['productPropSC'] = $subcategory;
        $data['productPropType'] = $category;
        $data['productPropCallPrice'] = $callforprice;
        $data['productPRPrice'] = $price;
        $data['productDesc'] = $details;
        $data['productPRSubmitDate'] = $post_date;
        $data['PRpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('productproperty', $data);

        $postdata['postDesc'] = $details;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '-1';
        $this->db->where('productID', $productId);
        $this->db->where('productCategoryID', $categoryID);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();


        if (isset($_FILES['images']['name'])) {
            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $val) {


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['images']['name'][$key];
                $rand_val = rand(10, 100);
                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;






//            $updimg_data['traderID'] = '';
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            $this->db->where('productID', $productId);
            $this->db->where('productCategoryID', $categoryID);
            $this->db->update('productiv', $updimg_data);
        }

        if ($this->db->update('productproperty', $data)) {
            $data = [
                'result' => '200',
                'messageEn' => 'Product property Details Updated Succesfully',
                'messageAr' => ' تم استجاع البيانات بنجاح'
            ];
            $data['data'] = [
                'PostId' => $postId
            ];
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
    }

    /*********************Adj********bbbbb*******************/
public function addpost_post() {
       //$this->load->library('../controllers/TraderController2');
   
    if(isset($_POST['categoryID'])&&isset($_POST['traderID'])){
     
      //  $postdata['traderID'] = $_POST['traderID'];
      //  $postdata['categoryID'] = $_POST['categoryID'];
      //  $postdata['productCCallPrice'] = $_POST['callforprice'];
        /*$_FILES['images[0]']['name'];
        $_FILES['image']['name'];
        $_FILES['productVideo']['name'];
        $_FILES['videoThumbnail']['name'];*/
        /*
        $postdata['productCPrice'] = $_POST['price'];
        $postdata['pro(ductCDesc'] = $_POST['details'];
        $postdata['productCBrand'] = $_POST['brand'];
        $postdata['productCModel'] = $_POST['model'];
        $postdata['productCReleaseYear'] = $_POST['year'];
        */
        //$postdata['productID'] = $_POST['images'];
        // $data['Cpost_main_img'] = base_url() . 'uploads/product_images/' . $image;
        
       if(isset($_POST['categoryID'])){
             $prodtype= $_POST['categoryID'];  
             
             if(isset($_POST['PostId'])){
		$postid=$_POST['PostId'] ; 
                switch ($prodtype) {
                    case 1:
                        $this->CarUpdatePost();
                        break;
                    case 2:
                        $this->BikeUpdatePost();
                        break;
                    case 3:
                        $this->NoplateUpdatePost(); 
                        break;
                    case 4:
                        $this->VertuUpdatePost();
                        break;
                    case 5:
                        $this->WatchUpdatePost();
                        break;
                    case 6:
                        $this->MobileNoUpdatePost();
                        break;
                    case 7:
                        $this->BoatUpdatePost();
                        break;
                    case 8:
                        $this->PhoneUpdatePost();
                        break;
                    case 9:
                        $this->PropertyUpdatePost();
                        break;
                    
                    default:
                    echo "NONE";
                }
            }else{
                  switch ($prodtype) {
                    case 1:
                        $this->CarAddPost();
                        break;
                    case 2:
                        $this->BikeAddPost();
                        break;
                    case 3:
                        $this->NoplateAddPost(); 
                        break;
                    case 4:
                        $this->VertuAddPost();
                        break;
                    case 5:
                        $this->WatchAddPost();
                        break;
                    case 6:
                        $this->MobileNoAddPost();
                        break;
                    case 7:
                        $this->BoatAddPost();
                        break;
                    case 8:
                        $this->PhoneAddPost();
                        break;
                    case 9:
                        $this->PropertyAddPost();
                        break;
                    
                    default:
                    echo "NONE";
                }
            }


        }else{
            $data = [
                        'result' => '204',
                        'messageEn' => 'Please specify product category'
                        ];
        }


    }else{
         $data = [
                        'result' => '204',
                        'messageEn' => 'Data Incomplete'
                        ];
    }

}




}

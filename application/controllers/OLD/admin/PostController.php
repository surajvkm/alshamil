<?php
defined('BASEPATH') OR exit('No direct script access allowed');


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
class PostController extends Admin_Controller {
        function __construct() {

        // Construct the parent class
        parent::__construct();
        $this->load->library(array(
            'session',
            'form_validation',
            'email'
        ));
        //$this->load->library('pagination');
        $this->load->Model('Trader_mdl');
       //  $this->load->Model('Api_mdl');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
      //  $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
      //  $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
      //  $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
   
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);
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
                    $updimg_data['productVideo'] = base_url() . $video;
                    $updimg_data['thumbVideo'] = base_url() . $videoThumbnail;
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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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

            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
        $details=(isset($_POST['details'])) ? $_POST['details'] : "";
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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
            $config['file_name'] = time();
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
        $imagepath=base_url() . 'uploads/product_images/' . $image;
        $data['NPpost_main_img'] = $imagepath;
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
            'imagename'=>$_FILES['image']['name'],
            "path"=>$imagepath
           
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
            $config['file_name'] = time();
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
       // $digitType = $_POST['digitType'];
        $mobileNumber = $_POST['mobileNumber'];
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time();
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
      //  $data['productMNDigits'] = $digitType;
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
    //    $digitType = $_POST['digitType'];
        $mobileNumber = $_POST['mobileNumber'];
//        $image = $_GET['image'];

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time();
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





        $post_date = date('Y-m-d h:i:sa');

        $data['productCategoryID'] = $categoryID;

        $data['productOperator'] = $operator;
        $data['productMNPrefix'] = $prefix;
      //  $data['productMNDigits'] = $digitType;
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
            $config['file_name'] = time();
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
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

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
         
         $details =(isset($_POST['details']))?$_POST['details']:"";

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
            $config['file_name'] = time();
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
        if (isset($_FILES['video']['name'])) {
            $config['upload_path'] = 'uploads/videos/';
            $config['allowed_types'] = 'mp3|mp4|3gp|mpg';
            $config['file_name'] = time();
            $config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('video')) {
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
            foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);


                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;
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


}

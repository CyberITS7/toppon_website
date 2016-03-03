<?php
class Publisher extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library('upload');

        $this->load->model('User_model');
        $this->load->model('Publisher_model');
    }

    function index(){
        if(!$this->session->userdata('logged_in')){
            $this->loginAndRegister();
        }
        else{
            $this->dashboard();
        }
    }

    function dashboard($start=1){
        if(!$this->session->userdata('logged_in')){
            redirect($this->loginAndRegister());
        }
        else{
            //get Publisher List data
            $num_per_page = 10;
            $start = ($start - 1)* $num_per_page;
            $limit = $num_per_page;

            $publisher_page = $this->Publisher_model->getPublisherList($start, $limit);
            $count_publisher = $this->Publisher_model ->getCountPublisherList();

            $config['base_url']= site_url('Publisher/dashboard');

            $config ['total_rows'] = $count_publisher;
            $config ['per_page']=$num_per_page;
            $config['use_page_numbers']=TRUE;
            $config['uri_segment']=3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['publisher']= $publisher_page;

            if ($this->input->post('ajax')){
                $this->load->view('admin/publisher_list_view', $data);
            }else{
                $data['data_content'] = 'admin/publisher_list_view';
                $this->load->view('includes/member_area_template_view',$data);
            }
        }
    }

    function createPublisher(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $name = $this->input->post('name');
        $img = $_FILES['img'];
        $userID = $this->session->userdata('user_id');
        $check_name = $this->Publisher_model->checkPublisher($name);

        if($check_name){
            $data_post=array(
                'publisherName'=>$name,
                'publisherImage'=>$img['name'],
                'isActive'=>1,
                "created" => $datetime,
                "createdBy" => $userID,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            $dir = "./img/publisher";
            //config upload Image
            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024 * 5;
            $config['overwrite'] = 'TRUE';
            $this->upload->initialize($config);

            $this->db->trans_begin();
            $this->Publisher_model->createPublisher($data_post);

            //Upload Image
            if (!$this->upload->do_upload('img'))
            {
                // Upload Failed
                $this->db->trans_rollback();
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else {
                // Upload Success
                $data = $this->upload->data();
                $this->db->trans_commit();
                $status = 'success';
                $msg = "Publisher has been create successfully!";
            }

        }else{
            $status = 'error';
            $msg = $name." already exist";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function updatePublisher(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $name = $this->input->post('name');
        $isUpdateImg = $this->input->post('isUpdateImg');
        $userID = $this->session->userdata('user_id');
        $publisherID = $this->input->post('id');
        $check_name = $this->Publisher_model->checkPublisherEdit($name,$publisherID);

        if($check_name){
            $data_post=array(
                'publisherName'=>$name,
                'isActive'=>1,
                "created" => $datetime,
                "lastUpdated"=>$datetime,
                "lastUpdatedBy"=>$userID
            );

            if($isUpdateImg==1){
                $data_post['publisherImage']= $_FILES['img']['name'];
                $dir = "./img/publisher";
                //config upload Image
                $config['upload_path'] = $dir;
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 1024 * 5;
                $config['overwrite'] = 'TRUE';
                $this->upload->initialize($config);

                $this->db->trans_begin();
                $this->Publisher_model->updatePublisher($data_post,$publisherID);

                //Upload Image
                if (!$this->upload->do_upload('img'))
                {
                    // Upload Failed
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = $this->upload->display_errors('', '');
                }
                else {
                    // Upload Success
                    $data = $this->upload->data();
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Publisher has been updated successfully!";
                }
            }else{
                $this->db->trans_begin();
                $update = $this->Publisher_model->updatePublisher($data_post,$publisherID);

                if($update){
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Publisher has been updated successfully!";
                }else{
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = "Publisher can't be updated!";
                }
            }

        }else{
            $status = 'error';
            $msg = $name." already exist";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deletePublisher(){
        $status = "";
        $msg="";

        $datetime = date('Y-m-d H:i:s', time());
        $publisherID = $this->input->post('id');
        $userID = $this->session->userdata('user_id');

        $data_post=array(
            'isActive'=>0,
            "created" => $datetime,
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$userID
        );

        $this->db->trans_begin();
        $update = $this->Publisher_model->updatePublisher($data_post,$publisherID);

        if($update){
            $this->db->trans_commit();
            $status = 'success';
            $msg = "Publisher has been delete successfully!";
        }else{
            $this->db->trans_rollback();
            $status = 'error';
            $msg = "Publisher can't be delete!";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function loginAndRegister($errorParam = null, $whereAt = null){
        if(!$this->session->userdata('logged_in')){
            if($errorParam == null){
                $data['error_param']="";
                $data['where_at']="";
                $this->load->view('login_view', $data);
            }
            else{
                $data['error_param']=$errorParam;
                $data['where_at']=$whereAt;
                $this->load->view('login_view', $data);
            }
        }
        else{
            redirect($this->dashboard());
        }
    }

}
?>
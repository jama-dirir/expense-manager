<?php
include("../config/conn.php");
header('content-type: application/json');

//Read All Links in View Files
function readAllSystemActions(){
    $data=array();
    $data_array=array();
    $seach_results= glob("../views/*.php");
    
    foreach($seach_results as $src){
        $pure_link=explode("/",$src);
       $data_array[]=$pure_link[2]; //[] This symbol stand for append.
    }

    if(count($seach_results)>0){
        $data=array("status"=>true, "data"=>$data_array);
    }else{
        $data=array("status"=>true, "data"=>"Not found");
    }

    echo json_encode($data);
    
}

//Read All Link_id From The Database
function ReadALinkId($conn){
    $data=array();
    $query="SELECT `id`, `link` FROM `sys_links` WHERE 1";
    $result=$conn->query($query);

    if($result){
       while($row=$result->fetch_assoc()){
        $data[]=$row;
       }
       $data=array("status"=>true, "data"=>$data);
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}

//Register System Action
function registerSystemAction($conn){
    $data=array();
    extract($_POST);
    $query="INSERT INTO `system_actions`(`name`, `system_action`, `link_id`) VALUES('$name','$action','$link_id')";
    $result=$conn->query($query);

    if($result){
            $data=array("status"=>true, "data"=> "registered successfully");
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}

//Update System Action 
function updateSystemAction($conn){
    extract($_POST);
    $data=array();
    $query= $query="UPDATE system_actions set name='$name', system_action='$system_action', link_id='$link_id' where id='$id'";
    $result=$conn->query($query);
    if($result){
        $data=array("status"=>true, "data"=> "update successfully");
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}



//Read All Sytem Actions 
function readAllSystemAction($conn){
    $data=array();
    $query="SELECT `id`, `name`, `system_action`, `link_id` FROM `system_actions` WHERE 1";
    $result=$conn->query($query);

    if($result){
       while($row=$result->fetch_assoc()){
        $data[]=$row;
       }
       $data=array("status"=>true, "data"=>$data);
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}



//Fetch System Action ID
function fetchActionId($conn){
    $data=array();
    extract($_POST);
    $query="SELECT  *FROM system_actions WHERE id='$id'";
    $result=$conn->query($query);

    if($result){
      $row=$result->fetch_assoc();
       $data=array("status"=>true, "data"=>$row);
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}


//Delete System Action
function deleteSystemAction($conn){
    $data=array();
    extract($_POST);
    $query="DELETE FROM system_actions WHERE id='$id'";
    $result=$conn->query($query);
    if($result){
       $data=array("status"=>true, "data"=>"Record Deleted Succefully");
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}


if(isset($_POST['action'])){
    $action=$_POST['action'];
    $action($conn);
}else{
   echo json_encode(array("status"=>false, "data"=> "action required..."));
}



?>
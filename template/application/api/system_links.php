<?php
include("../config/conn.php");
header('content-type: application/json');

//Read all view files
function readAllSystemLinks(){
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

//Register System Links
function registerLink($conn){
    $data=array();
    extract($_POST);
    $query="INSERT INTO `sys_links`(`name`, `link`, `category_id`) VALUES('$name','$link','$category_id')";
    $result=$conn->query($query);

    if($result){
            $data=array("status"=>true, "data"=> "registered successfully");
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}

//Update System Links
function updateLink($conn){
    $data=array();
    extract($_POST);
    $query= $query="UPDATE sys_links set name='$name',link='$link', category_id='$category_id' where id='$id'";
    $result=$conn->query($query);
    if($result){
        $data=array("status"=>true, "data"=> "update successfully");
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}



//Read All Links From Database
function ReadAllLinks($conn){
    $data=array();
    $query="SELECT `id`, `name`, `link`, `category_id` FROM `sys_links` WHERE 1";
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

//Read All Category
function ReadAllCategory($conn){
    $data=array();
    extract($_POST);
    $query="SELECT `id`, `name` FROM `category` WHERE 1";
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

//Fetch Link ID
function fetchLinkId($conn){
    $data=array();
    extract($_POST);
    $query="SELECT  *FROM sys_links WHERE id='$id'";
    $result=$conn->query($query);

    if($result){
      $row=$result->fetch_assoc();
       $data=array("status"=>true, "data"=>$row);
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}


//Delete Link
function DeleteLink($conn){
    $data=array();
    extract($_POST);
    $query="DELETE FROM sys_links WHERE id='$id'";
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
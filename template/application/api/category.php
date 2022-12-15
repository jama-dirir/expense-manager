<?php
include("../config/conn.php");
header('content-type: application/json');

//Register Transaction
function registerCategory($conn){
    $data=array();
    extract($_POST);
    $query="INSERT INTO `category`(`name`, `icon`, `role`) VALUES('$name','$icon','$role')";
    $result=$conn->query($query);
    if($result){
            $data=array("status"=>true, "data"=> "registered successfully");
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}

//Update Transaction
function updateCategory($conn){
    $data=array();
    extract($_POST);
    $query= $query="UPDATE category set name='$name',icon='$icon', role='$role' where id='$id'";
    $result=$conn->query($query);
    if($result){
        $data=array("status"=>true, "data"=> "update successfully");
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}



//Get All Transaction
function read_all_category($conn){
    $data=array();
    $query="SELECT `id`, `name`, `icon`, `role` FROM `category` WHERE 1";
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

//Get user Transaction
function get_one_category($conn){
    $data=array();
    extract($_POST);
    $query="SELECT  *FROM category WHERE id='$id'";
    $result=$conn->query($query);

    if($result){
      $row=$result->fetch_assoc();
       $data=array("status"=>true, "data"=>$row);
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}



//Delete Transaction
function Delete_category($conn){
    $data=array();
    extract($_POST);
    $query="DELETE FROM category WHERE id='$id'";
    $result=$conn->query($query);
    if($result){
       $data=array("status"=>true, "data"=>"Deleted successfully");
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
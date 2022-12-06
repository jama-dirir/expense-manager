<?php
include("../config/conn.php");
header('content-type: application/json');

//Register Transaction
function registerExpense($conn){
    $data=array();
    extract($_POST);
    $query="CALL register_expense_Sp('','$amount','$type','$description','USER001')";
    $result=$conn->query($query);

    if($result){
        $row=$result->fetch_assoc();
        if($row['Message']=='Deny'){
            $data=array("status"=>false, "data"=> "Insuficient Balance &#x1F602;");
        }else if($row['Message']=='Registered'){
            $data=array("status"=>true, "data"=> "registered successfully");
        }
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}

//Update Transaction
function updateExpense($conn){
    $data=array();
    extract($_POST);
    $query="CALL register_expense_Sp('$id','$amount','$type','$description','USER001')";
    $result=$conn->query($query);

    if($result){
        $row=$result->fetch_assoc();   
        if($row['Message']=='Updated'){
        $data=array("status"=>true, "data"=> "update successfully");
        }
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}



//Get All Transaction
function get_All_transaction($conn){
    $data=array();
    $query="SELECT `id`, `amount`, `type`, `description` FROM `expense` WHERE 1";
    $result=$conn->query($query);

    if($result){
       while($row=$result->fetch_assoc()){
        $arr_data[]=$row;
       }
       $data=array("status"=>true, "data"=>$arr_data);
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}

//Get user Transaction
function get_user_transaction($conn){
    $data=array();
    extract($_POST);
    $query="SELECT  *FROM expense WHERE id='$id'";
    $result=$conn->query($query);

    if($result){
      $row=$result->fetch_assoc();
       $data=array("status"=>true, "data"=>$row);
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}


//Get user statement
function Get_user_statement($conn){
    extract($_POST);
    $data=array();
    $query="CALL get_user_statement('USER001','$from','$to')";
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
function Delete_user_transaction($conn){
    $data=array();
    extract($_POST);
    $query="DELETE FROM expense WHERE id='$id'";
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
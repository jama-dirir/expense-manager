<?php
include("../config/conn.php");
header('content-type: application/json');

//Generate ID
function generateId($conn){
    $data=array();
    $newId='';
    extract($_POST);
    $query="SELECT * FROM `users` WHERE 1 order by users.id DESC limit 1";
    $result=$conn->query($query);

    if($result){
        $num_rows=$result->num_rows;
        if($num_rows > 0){
            $row=$result->fetch_assoc();
            $newId= ++$row['id'];
      }else{
          $newId='STR_001';
        }
        //print
    }else{
        $data=array("status"=>false, "data"=>$conn->error);
    }
    //we can use newId any.
    return $newId;
    
}

//REGISTER USER
function registerUser($conn){
    //Register User
    $new_id=generateId($conn);
    extract($_POST);
    $data=array();
    $array_error=array();

    $file_name=$_FILES['image']['name'];
    $file_type=$_FILES['image']['type'];
    $file_size=$_FILES['image']['size'];
    
    $save_name=$new_id.'.png';
    $allowedImages=["image/jpg","image/png","image/jpeg"];
    $max_size=5 * 1024 * 1024;

    if(in_array($file_type,$allowedImages)){
        if($file_size >  $max_size){
            $array_error[]=($file_size/1024/1024).' '.'file size must be less than'.' '.($max_size/1024/1024).''.'MB';
        }
    }  else{
        $array_error[]='file type not allowed to be'.' '.$file_type;
    }

    if(count($array_error) <= 0){
        $query="INSERT INTO `users` (`id`, `username`, `password`, `image`) VALUES('$new_id','$username',MD5('$password'),'$save_name')";
       
        $result=$conn->query($query);

        if($result){
           move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$save_name);
           $data=array("status"=>true, "data"=>"succefully registered");
        }else{
            $data=array("status"=>false, "data"=> $conn->error);
        }
    }else{
        $data=array("status"=>false, "data"=> $array_error);
    }
    echo json_encode($data);
}

//UPDATE USER
function updateUser($conn){ 
    extract($_POST);
    $data=array();
    $array_error=array();
    $save_name=$update_id.'.png';
    
    if(!empty($_FILES['image']['tmp_name'])){
        $file_name=$_FILES['image']['name'];
        $file_type=$_FILES['image']['type'];
        $file_size=$_FILES['image']['size'];
        
     
        $allowedImages=["image/jpg","image/png","image/jpeg"];
        $max_size=15 * 1024 * 1024;
    
        if(in_array($file_type,$allowedImages)){
            if($file_size >  $max_size){
                $array_error[]=($file_size/1024/1024).' '.'file size must be less than'.' '.($max_size/1024/1024).''.'MB';
            }
        }  else{
            $array_error[]='file type not allowed to be'.' '.$file_type;
        }
    
        if(count($array_error) <= 0){
            $query="UPDATE users set users.username='$username',password=MD5('$password') where users.id='$update_id'";
           
            $result=$conn->query($query);
    
            if($result){
                move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$save_name);
               $data=array("status"=>true, "data"=>"Record succefully updated");
            }else{
                $data=array("status"=>false, "data"=> $conn->error);
            }
        }else{
            $data=array("status"=>false, "data"=> $array_error);
        }
    }else{
        $query="UPDATE users set users.username='$username',password=MD5('$password')  where users.id='$update_id'";
           
            $result=$conn->query($query);
    
            if($result){
               $data=array("status"=>true, "data"=>"succefully updated");
            }else{
                $data=array("status"=>false, "data"=> $conn->error);
            }
    }
  
    echo json_encode($data);
}


//Get users list
function get_users_list($conn){
    $data=array();
    $query="SELECT *FROM `users`";
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
function get_user_info($conn){
    $data=array();
    extract($_POST);
    $query="SELECT  *FROM users WHERE id='$id'";
    $result=$conn->query($query);

    if($result){
      $row=$result->fetch_assoc();
       $data=array("status"=>true, "data"=>$row);
    }else{
        $data=array("status"=>false, "data"=> $conn->error);
    }
    echo json_encode($data);
}

//Delete User
function Delete_user_info($conn){
    $data=array();
    extract($_POST);
    $query="DELETE FROM users WHERE id='$id'";
    $result=$conn->query($query);

    if($result){
        unlink("../uploads/".$id.'.png');
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
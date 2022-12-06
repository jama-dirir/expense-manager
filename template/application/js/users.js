//Calling Loading...
LoadData();

let btnAction="Insert";

//Showing Model
$("#addUser").on("click",function(){
    $("#usersModal").modal("show");
    $('#showImage').hide();

})

$("#image").on("change",function(){
  if($("#image").val()==0){
    $("#from").attr("disabled",true)
    $("#to").attr("disabled",true)
  }else{
    $("#from").attr("disabled",false)
    $("#to").attr("disabled",false)
  }
})
//Show Image

let fileImage=document.querySelector("#image");
let showInput=document.querySelector("#showImage");

const reader=new FileReader();

fileImage.addEventListener('change',(e)=>{
    let selectedImage=e.target.files[0];
   reader.readAsDataURL(selectedImage)
  
  
})

reader.onload=e=>{
    showInput.src=e.target.result;
    $('#showImage').show();
}


//Register API
$("#usersForm").submit(function(event){
    event.preventDefault();

    // let amount=$("#amount").val();
    // let type=$("#type").val();
    // let description=$("#description").val();
    // let id=$("#get_update_id").val();
    // console.log("amount:",amount)
    // console.log("amount:",type)
    // console.log("amount:",description)
    let sendinData={}

    //get all form_data
    let form_data=new FormData($("#usersForm")[0]);

    //add form_data image field
    form_data.append("image",$("input[type=file]")[0].files[0]);

    if(btnAction=="Insert"){
        form_data.append("action","registerUser")
    }else{
        form_data.append("action","updateUser")
    }
    
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/users.php",
        data:form_data,
        processData:false,
        contentType:false,
        success:function(data){
            let status=data.status;
            let response=data.data;
            if(status){
                    displayMessage("success",response);
                    LoadData()
                    btnAction="Insert";
                    $("#usersForm")[0].reset()
                }else{
                    displayMessage("Err",response);
                }
           
        },
        error:function(data){ 
            let error=data.responseText;
            displayMessage("error",error);  
             
        }
    })
})



//Fetch specific user
function fetch_User_Info(id){
    let sendinData={
        "action":"get_user_info",
        "id":id,
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/users.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;
            // console.log(response);
            if(status){
                btnAction="Update";
                $("#update_id").val(response['id']);
                $("#username").val(response['username']);
                $("#showImage").attr('src',`../uploads/${response['image']}`);
                $("#usersModal").modal("show");
                
            }
        },
        error:function(data){  
            let error=data.responseText="Error occurs ?";
            displayMessage("error",error);    
        }
    })
    
}


//Delete transaction user
// function delete_User_Trans(id){
//     let sendinData={
//         "action":"Delete_user_transaction",
//         "id":id,
//     }
//     $.ajax({
//         method:"POST",
//         dataType:"JSON",
//         url:"../api/users.php",
//         data:sendinData,
//         success:function(data){
//             let response=data.data;
//             let status=data.status;

//             // console.log(response);
//             if(status){
//                 swal("Good job!", response, "success");
//                 LoadData()
//             }else{
//                 swall(response);
//             }
//         },
//         error:function(data){  
//             let error=data.responseText="Error occurs ?";
//             displayMessage("error",error);    
//         }
//     })
    
// }

//LoadData API

function LoadData(){
    $("#usersTable tbody").html("");
    let sendinData={
        "action":"get_users_list",
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/users.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;
            let tr='';
            let th='';
            if(status){
                response.forEach(res=>{
                    th="<tr>";
                    for(let i in res){
                        if(i=="password"){
                        
                        }else{
                            th+=`<td>${i}</td>`;

                        }
                    }

                    th+="<td>Active</td></tr>";


                    tr+="<tr>";
                    for(let r in res){
                       if(r=="image"){
                            tr+=`<td><img 
                            style="
                            width:70px;
                            height:70px;
                            border-radius:50%;
                            object_fit:cover;
                            " 
                            src="../uploads/${res[r]}"></td>`;
                       }else if(r=='password'){
                         
                       }else{
                        tr+=`<td>${res[r]}</td>`;
                       }
                    }
                    tr+=`<td><a class="btn btn-info update_info"  update_id=${res['id']}><i class="fas fa-edit" style="color:#fff";></i></a>&nbsp;&nbsp;
                    <a class="btn btn-danger delete_info"  delete_id=${res['id']}><i class="fas fa-trash" style="color:#fff";></i></a></td>`;
                    tr+="</tr>";
                })
                $("#usersTable tbody").append(th);
                $("#usersTable tbody").append(tr);

            }
        },
        error:function(data){  
            let error=data.responseText="Error occurs ?";
            displayMessage("error",error);    
        }
    })
    
}

//Message Success or Error
function displayMessage(type,message){
    let success=document.querySelector(".alert-success");
    let Err=document.querySelector(".alert-danger");

    if(type=="success"){
        Err.classList= "alert alert-danger d-none"; 
        success.classList= "alert alert-success"; 
        success.innerHTML=message;
        setTimeout(()=>{
            $('#usersModal').modal("hide");
            $('#usersForm')[0].reset();
            success.classList= "alert alert-success d-none"; 
        },2000)
    }else{
        // error.classList= "alert alert-danger d-none"; 
        Err.classList= "alert alert-danger"; 
        Err.innerHTML=message;
    }
}

$("#usersTable").on("click","a.update_info",function(){
    id=$(this).attr("update_id");
    console.log("ID :",id)
    // console.log("Update_Id:",$updateId);
    fetch_User_Info(id);
})

$("#usersTable").on("click","a.delete_info",function(){
    id=$(this).attr("delete_id");
    // console.log(id)
    if(confirm("Are you sure to delete this record?")){
        delete_User_Trans(id);
    }
})
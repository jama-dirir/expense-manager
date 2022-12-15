//Calling Loading...
LoadData();
fill_links();

//Showing Model
$("#addAction").on("click",function(){
    $("#actionModal").modal("show");
})

let btnAction="Insert";

//Register API
$("#actionForm").submit(function(event){
    event.preventDefault();
    let name=$("#name").val();
    let system_action=$("#system_action").val();
    let link_id=$("#link_id").val();
    let sendinData={}
    if(btnAction=="Insert"){
        sendinData={
            name,
            system_action,
            link_id,
            "action":"registerSystemAction",
        }
    }else{
        sendinData={
            id,
            name,
            system_action,
            link_id,
            "action":"updateSystemAction",
        }
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_actions.php",
        data:sendinData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            
            if(status){
                btnAction="Insert";
                displayMessage("success",response);
                $("#actionForm")[0].reset()
                LoadData();
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

//Update user
function fetch_action(id){
    let sendinData={
        "action":"fetchActionId",
        "id":id,
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_actions.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;

             console.log('UPDATE :',response);
            if(status){
                    btnAction="Update";
                    $("#update_id").val(response['id']);
                    $("#name").val(response['name']);
                    $("#system_action").val(response['system_action']);
                    $("#link_id").val(response['link_id']);
                    $("#actionModal").modal("show");
            }
        },
        error:function(data){  
            let error=data.responseText;
            displayMessage("error",error);    
        }
    })
    
}

//Fill All Links
function fill_links(){
    let sendinData={
        "action":"ReadALinkId",
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_actions.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;
            console.log('res :',response)
            let opt='';
            if(status){
                response.forEach(res=>{
                        opt+=`<option value="${res['id']}">${res['link']}</option>`;
                })
                $("#link_id").append(opt);
            }
        },
        error:function(data){  
            let error=data.responseText;
            displayMessage("error",error);    
        }
    })
    
}


//LoadData API
function LoadData(){
    $("#actionTable tbody").html("");
    let sendinData={
        "action":"readAllSystemAction",
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_actions.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;
            let tr='';
            if(status){
                response.forEach(res=>{
                    tr+="<tr>";
                    for(let r in res){
                        tr+=`<td>${res[r]}</td>`;
                    }
                    tr+=`<td><a class="btn btn-info update_info"  update_id=${res['id']}><i class="fas fa-edit" style="color:#fff";></i></a>&nbsp;&nbsp;
                    <a class="btn btn-danger delete_info"  delete_id=${res['id']}><i class="fas fa-trash" style="color:#fff";></i></a></td>`;
                    tr+="</tr>";
                })
                $("#actionTable tbody").append(tr);

            }
        },
        error:function(data){  
            let error=data.responseText;
            displayMessage("error",error);    
        }
    })
    
}

//Delete transaction user
function delete_action(id){
    let sendinData={
        "action":"deleteSystemAction",
        "id":id,
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_actions.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;
            console.log("Status :",status)
            console.log("Delete :",response)
            
            console.log('stut :',status)
            if(status){
                swal("Good job!", response, "success");
                LoadData()
            }else{
                swal(response);
            }
        },
        error:function(data){  
            let error=data.responseText;
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
            $('#actionModal').modal("hide");
            $('#actionForm')[0].reset();
            success.classList= "alert alert-success d-none"; 
        },2000)
    }else{
        // error.classList= "alert alert-danger d-none"; 
        Err.classList= "alert alert-danger"; 
        Err.innerHTML=message;
    }
}

$("#actionTable").on("click","a.update_info",function(){
    id=$(this).attr("update_id");
    fetch_action(id);
    console.log('update_id :',id)
})

$("#actionTable").on("click","a.delete_info",function(){
    id=$(this).attr("delete_id");
    console.log("Delete :",id)
    if(confirm("Are you sure to delete record?")){
        delete_action(id);
    }
})
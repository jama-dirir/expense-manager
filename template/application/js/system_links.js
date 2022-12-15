//Calling Loading...
LoadData();
fill_links();
fill_category();

//Showing Model
$("#addLink").on("click",function(){
    $("#linkModal").modal("show");
})

let btnAction="Insert";

//Register API
$("#linkForm").submit(function(event){
    event.preventDefault();
    let name=$("#name").val();
    let link=$("#file_links").val();
    let category_id=$("#category_id").val();
    let sendinData={}
    if(btnAction=="Insert"){
        sendinData={
            name,
            link,
            category_id,
            "action":"registerLink",
        }
    }else{
        sendinData={
            id,
            name,
            link,
            category_id,
            "action":"updateLink",
        }
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_links.php",
        data:sendinData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            
            if(status){
                btnAction="Insert";
                displayMessage("success",response);
                LoadData();
                $("#linkForm")[0].reset()
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
function fetch_link(id){
    let sendinData={
        "action":"fetchLinkId",
        "id":id,
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_links.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;

             console.log('UPDATE :',response);
            if(status){
                    btnAction="Update";
                    $("#update_id").val(response['id']);
                    $("#name").val(response['name']);
                    $("#link").val(response['link']);
                    $("#category_id").val(response['category_id']);

                    $("#linkModal").modal("show");
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
        "action":"readAllSystemLinks",
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_links.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;
            let opt='';
            if(status){
                response.forEach(res=>{
                        opt+=`<option value="${res}">${res}</option>`;
                })
                $("#file_links").append(opt);
            }
        },
        error:function(data){  
            let error=data.responseText;
            displayMessage("error",error);    
        }
    })
    
}

//Fill All Categories
function fill_category(){
    let sendinData={
        "action":"ReadAllCategory",
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_links.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;
            
            let opt='';
            if(status){
                response.forEach(res=>{
                    opt+=`<option value="${res['id']}">${res['name']}</option>`;
            })
                $("#category_id").append(opt);
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
    $("#linkTable tbody").html("");
    let sendinData={
        "action":"ReadAllLinks",
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_links.php",
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
                $("#linkTable tbody").append(tr);

            }
        },
        error:function(data){  
            let error=data.responseText;
            displayMessage("error",error);    
        }
    })
    
}

//Delete transaction user
function delete_link(id){
    let sendinData={
        "action":"DeleteLink",
        "id":id,
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/system_links.php",
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
            $('#linkModal').modal("hide");
            $('#linkForm')[0].reset();
            success.classList= "alert alert-success d-none"; 
        },2000)
    }else{
        // error.classList= "alert alert-danger d-none"; 
        Err.classList= "alert alert-danger"; 
        Err.innerHTML=message;
    }
}

$("#linkTable").on("click","a.update_info",function(){
    id=$(this).attr("update_id");
    fetch_link(id);
    console.log(id)
})

$("#linkTable").on("click","a.delete_info",function(){
    id=$(this).attr("delete_id");
    if(confirm("Are you sure to delete record?")){
        delete_link(id);
    }
})
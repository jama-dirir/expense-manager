//Calling Loading...
LoadData();

//Showing Model
$("#addCategory").on("click",function(){
    $("#categoryModal").modal("show");
})

let btnAction="Insert";
//Register API
$("#categoryForm").submit(function(event){
    event.preventDefault();
    let name=$("#name").val();
    let icon=$("#icon").val();
    let role=$("#role").val();
    let id=$("#update_id").val();

    let sendinData={}

    if(btnAction=="Insert"){
        sendinData={
            name,
            icon,
            role,
            "action":"registerCategory",
        }
    }else{
        sendinData={
            id,
            name,
            icon,
            role,
            "action":"updateCategory",
        }
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/category.php",
        data:sendinData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            if(status){
                btnAction="Insert";
                displayMessage("success",response);
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

//Fetch specific user
function fetch_Category(id){
    let sendinData={
        "action":"get_one_category",
        "id":id,
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/category.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;

            // console.log(response);
            if(status){
                    btnAction="Update";
                    $("#update_id").val(response['id']);
                    $("#name").val(response['name']);
                    $("#icon").val(response['icon']);
                    $("#role").val(response['role']);

                    $("#categoryModal").modal("show");
            }
        },
        error:function(data){  
            let error=data.responseText;
            displayMessage("error",error);    
        }
    })
    
}




//Delete transaction user
function delete_Category(id){
    let sendinData={
        "action":"Delete_category",
        "id":id,
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/category.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;
            
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

//LoadData API
function LoadData(){
    $("#categoryTable tbody").html("");
    let sendinData={
        "action":"read_all_category",
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/category.php",
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
                $("#categoryTable tbody").append(tr);

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
            $('#categoryModal').modal("hide");
            $('#categoryForm')[0].reset();
            success.classList= "alert alert-success d-none"; 
        },2000)
    }else{
        // error.classList= "alert alert-danger d-none"; 
        Err.classList= "alert alert-danger"; 
        Err.innerHTML=message;
    }
}

$("#categoryTable").on("click","a.update_info",function(){
    id=$(this).attr("update_id");
    fetch_Category(id);
})

$("#categoryTable").on("click","a.delete_info",function(){
    id=$(this).attr("delete_id");
    // console.log(id)
    if(confirm("Are you sure to delete record?")){
        delete_Category(id);
    }
})
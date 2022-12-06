//Calling Loading...
LoadData();

//Showing Model
$("#addTransaction").on("click",function(){
    $("#expenseModal").modal("show");
})

let btnAction="Insert";
//Register API
$("#expenseForm").submit(function(event){
    event.preventDefault();

    let amount=$("#amount").val();
    let type=$("#type").val();
    let description=$("#description").val();
    let id=$("#get_update_id").val();
    // console.log("amount:",amount)
    // console.log("amount:",type)
    // console.log("amount:",description)
    let sendinData={}

    if(btnAction=="Insert"){
        sendinData={
            amount,
            type,
            description,
            "action":"registerExpense",
        }

    }else{
        sendinData={
            id,
            amount,
            type,
            description,
            "action":"updateExpense",
        }
    }
    
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/expense.php",
        data:sendinData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            if(status){
                    displayMessage("success",response);
                    btnAction="Insert";

                }else{
                    displayMessage("Err",response);
                }
           
        },
        error:function(data){ 
            let error=data.responseText="Error occurs ?";
            displayMessage("error",error);  
             
        }
    })
 
})

//Fetch specific user
function fetch_User_Trans(id){
    let sendinData={
        "action":"get_user_transaction",
        "id":id,
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/expense.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;

            // console.log(response);
            if(status){
                    btnAction="Update";
                    $("#get_update_id").val(response['id']);
                    $("#amount").val(response['amount']);
                    $("#type").val(response['type']);
                    $("#description").val(response['description']);

                    $("#expenseModal").modal("show");
            }
        },
        error:function(data){  
            let error=data.responseText="Error occurs ?";
            displayMessage("error",error);    
        }
    })
    
}


//Delete transaction user
function delete_User_Trans(id){
    let sendinData={
        "action":"Delete_user_transaction",
        "id":id,
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/expense.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;

            // console.log(response);
            if(status){
                swal("Good job!", response, "success");
                LoadData()
            }else{
                swall(response);
            }
        },
        error:function(data){  
            let error=data.responseText="Error occurs ?";
            displayMessage("error",error);    
        }
    })
    
}

//LoadData API
function LoadData(){
    $("#expenseTable tbody").html("");
    let sendinData={
        "action":"get_All_transaction",
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/expense.php",
        data:sendinData,
        success:function(data){
            let response=data.data;
            let status=data.status;
            let tr='';
            if(status){
                response.forEach(res=>{
                    tr+="<tr>";
                    for(let r in res){
                       if(r=="type"){
                        if(res[r]=="Income"){
                            tr+=`<td><span class="badge badge-success">${res[r]}</span></td>`;
                        }else{
                            tr+=`<td><span class="badge badge-danger">${res[r]}</span></td>`;
                        }
                       }else{
                        tr+=`<td>${res[r]}</td>`;
                       }
                    }
                    tr+=`<td><a class="btn btn-info update_info"  update_id=${res['id']}><i class="fas fa-edit" style="color:#fff";></i></a>&nbsp;&nbsp;
                    <a class="btn btn-danger delete_info"  delete_id=${res['id']}><i class="fas fa-trash" style="color:#fff";></i></a></td>`;
                    tr+="</tr>";
                })
                $("#expenseTable tbody").append(tr);

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
            $('#expenseModal').modal("hide");
            $('#expenseForm')[0].reset();
            success.classList= "alert alert-success d-none"; 
        },2000)
    }else{
        // error.classList= "alert alert-danger d-none"; 
        Err.classList= "alert alert-danger"; 
        Err.innerHTML=message;
    }
}

$("#expenseTable").on("click","a.update_info",function(){
    id=$(this).attr("update_id");
    // console.log("Update_Id:",$updateId);
    fetch_User_Trans(id);
})

$("#expenseTable").on("click","a.delete_info",function(){
    id=$(this).attr("delete_id");
    // console.log(id)
    if(confirm("Are you sure to delete this record?")){
        delete_User_Trans(id);
    }
})
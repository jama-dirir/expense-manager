
$("#from").attr("disabled",true)
$("#to").attr("disabled",true)

$("#type").on("change",function(){
  if($("#type").val()==0){
    $("#from").attr("disabled",true)
    $("#to").attr("disabled",true)
  }else{
    $("#from").attr("disabled",false)
    $("#to").attr("disabled",false)
  }
})

//Showing Model
// $("#addTransaction").on("click",function(){
//     $("#expenseModal").modal("show");
// })


//Get user statement
$("#userForm").on("submit",function(event){
    event.preventDefault();
    let from=$("#from").val()
        let to=$("#to").val()
          
        let sendinData={
                "from":from,
                "to":to,
                "action":"Get_user_statement",
            }

            $.ajax({
                method:"POST",
                dataType:"JSON",
                url:"../api/expense.php",
                data:sendinData,
                success:function(data){
                    console.log("sending :",sendinData)
                    let response=data.data;
                    let status=data.status;
                    console.log(response)
                    let tr='';
                    if(status){
                        tr+="<tr>";
                       response.forEach(res=>{
                        console.log("res=",res)
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
                         
                            tr+="</tr>";
                        })
                        $("#userTable tbody").append(tr);
                    }
                },
                error: function(data){  
                }
            })
})

// LoadData API
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





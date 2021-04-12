<?php
session_start();
?>

<!doctype html>
<html>  
      <head>  
           <title>Box Detail</title>  
           
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
            
      </head>  
      <body>  
           <div class="container">  
                <br />  
                <br />  
                <h2 align="center">Add Another Box Details</h2>  
                <div class="form-group">  
                     <form name="add_name" action="name.php" id="add_name">  
                          <div class="table-responsive">  
                          <input type="number" class="form-control" name="Speedway_No" id="Speedway_No" style="width:400px;"
                    placeholder="Enter Speedway No." autocomplete="off" autofocus>
                    <br/>
                               <table class="table table-bordered" id="dynamic_field">  
                                    <tr>  
                                         <td><input type="text" name="Tracking_Number[]" placeholder="Enter Tracking Number" class="form-control name_list" /></td> 
                                         <td><input type="text" name="link[]" placeholder="Enter Link" class="form-control name_list" /></td>  
                                         <td><button type="button" name="add" id="add" class="btn btn-success">Add </button></td>  
                                    </tr>  
                               </table>  
                               <input type="button" name="done" id="done" class="btn btn-info" value="Save" />  
                          </div>  
                     </form>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="Tracking_Number[]" placeholder="Enter Tracking Number" class="form-control name_list" /></td><td><input type="text" name="link[]" placeholder="Enter Link" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#done').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>
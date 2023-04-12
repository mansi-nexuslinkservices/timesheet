<!DOCTYPE html>
<html>  
<head>  
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
<script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>  
<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  
<title>Bootstrap TimePicker Example</title>  




<script>  
$(function() {  
  $('#datetimepicker1').datetimepicker();  
});  
</script>  
<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  
<style>  
    body{
      background-color: beige;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {  
        margin-top : 80px;  
        width : 800px;  
    }  
</style>  
</head>  
<body>  
</br>  
<div class ="container">  
    <div class ="row">  
       <div class ='col-sm-12 my-auto'>  
          <div class ="form-group">  
            <p>Following is an example to demonstrate timepicker in Bootstrap.</p><br>
             <div class = 'input-group date' id='timepicker'>  
                <input type = 'text' class="form-control" />  
                <span class = "input-group-addon">  
                <span class = "glyphicon glyphicon-time"></span>  
                </span>  
             </div>  
          </div>  
       </div>  
       <script type = "text/javascript">  
          $(function () {  
              $('#timepicker').datetimepicker({  
                  format: 'LT'  
              });  
          });  
       </script>  
    </div>  
 </div>  
</body>  
</html>  
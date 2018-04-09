<?php
   include_once('includes/connection.php');
   include_once('includes/function.php');
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 8388608){
         $errors[]='File size must be less than 8 MB';
      }
      
       if(empty($errors)==true){
         
         $time_t = time();
         $img_name = time_t.'_'.$file_name;
        
        if(InsertImageName($time_t.'_'.$file_name,$con) == true) {
           move_uploaded_file($file_tmp,"images/".$time_t.'_'.$file_name);
           echo "Success";
        }else{
           echo "Error in file upload";
        }
      }else{
         print_r($errors);
      }
   }
?>
<html>
   <body>
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit"/>
      </form>
      
   </body>
</html>
<?php
     session_start();
     include_once "config.php";
     $fname = mysqli_real_escape_string($conn , $_POST['fname']);
     $lname = mysqli_real_escape_string($conn , $_POST['lname']);
     $email = mysqli_real_escape_string($conn , $_POST['email']);
     $password = mysqli_real_escape_string($conn , $_POST['password']);
    
    
     if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //let's check user email is valid or not
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            //IF email is valid 
            //let's check that email is already in the database or not
            $sql = mysqli_query($conn,"SELECT email FROM users WHERE email = '{$email}'");
             if(mysqli_num_rows($sql) > 0){
                 echo "$email -this email already exists !";
             }else{
               //let's check user upload file or not
               if(isset($_FILES['image'])){//if file is uploaded
                       $img_name =$_FILES['image']['name'];//getting user uploaded img name
                       $img_type = $_FILES['image']['type'];//getting user upload image type
                       $tmp_name = $_FILES['image']['tmp_name'];//this temporary name is used to save file in our folder

                       //let's explode the image and get the last extension like jpg and png
                      $img_explode = explode('.', $img_name) ;
                      $img_ext = end($img_explode);//here we get the extension of an user uploaded img
                       
                      $extensions = ['png', 'jpeg', 'jpg'];//these are some valid extensions for image and stored in array

                      if(in_array($img_ext,$extensions)===true){
                        $time = time();//this will return the current time 
                        //we will need this time because when you uploading imag to our folder we rename user file with current time 
                        //so all the image file will have a unique name  
                        //let's move the user uploaded img to our particular folder
                        
                        $new_img_name = $time.$img_name;

                        if(move_uploaded_file($tmp_name , "images/".$new_img_name)){
                            $status = "Active now";//once user signed up then his status will be active now
                            $random_id = rand(100, 20000);//creating random id for user
                            
                            

                            //let's insert all user data inside table
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, image, status)
                                     VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}' , '{$status}')");

                            if($sql2){
                                $sql3 = mysqli_query($conn , "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id'];//using this session we use user unique_id in other php file
                                
                                    echo "succeeded";   
                                }
                            }else{
                                echo "Something went wrong!";
                            }                     
                        }
                          

                      }else{
                        echo "please upload the image with jpg png or jpeg extensions";
                      }

               }else{
                echo "Please select an Image File!";
               }
             }

        }else{
            echo "$email is not a valid email";
        }
     }else{
        echo "All input field are required";
     }

?>  
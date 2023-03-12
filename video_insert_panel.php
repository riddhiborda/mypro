<?php

                
									 
									 $con=mysqli_connect('68.183.81.191','wmzueqzvje','magical_db','wmzueqzvje');
                
                
                
                
                if (!$con) {
                  die("Connection failed: " . mysqli_connect_error());
                }
                 else
                        {
                          // echo "Connection established!";
                        }
                
                if(isset($_POST['submit']))
                {
                
                
                $category=$_POST['catgoryidd'];
                
                
                $sqll=mysqli_query($con,"select * from category_tb where category_id='$category'");
                if($sqll)
                {
                    {
                        while($res=mysqli_fetch_array($sqll))
                        {
                        $category_name=$res['category_name'];
						$category_di=$res['category_id'];
                        }
                    }
                }
                
                echo "cat=".$category_name;
                $name1=$_FILES['video']['name'];
                
                $name = substr( $name1, 0, -4 );
                
                $date=date("d-m-Y");
                
                $view=mt_rand(11,20);
                $like=mt_rand(21,100);
                $download=mt_rand(11,100);
                $share=mt_rand(21,100);
                
                   
                $image_name = $_FILES['image1']['name'];
				$image_name = str_replace(' ', '%20', $image_name);
                $image_name1="http://phpstack-260384-882078.cloudwaysapps.com/lyrical_status/video/".$category_name."/thumbnail/".$image_name;
                
                // echo $image_name1;
                
                    $video = $_FILES['video']['tmp_name']; 
                $video_name = $_FILES['video']['name'];
				$video_name = str_replace(' ', '%20', $video_name);
                $video_name1="http://phpstack-260384-882078.cloudwaysapps.com/lyrical_status/video/".$category_name."/video_url/".$video_name;
                // echo $video_name1;
                
                
                $demo_video_name = $_FILES['demovideo']['name'];
				
				$demo_video_name = str_replace(' ', '%20', $demo_video_name);
                $demo_video_name1="http://phpstack-260384-882078.cloudwaysapps.com/lyrical_status/video/".$category_name."/demo_video_url/".$demo_video_name;
                
                
                $overlay_gg = $_FILES['overlay_gg']['name'];
				$overlay_gg = str_replace(' ', '%20', $overlay_gg);
                $overlay_gg_url="http://phpstack-260384-882078.cloudwaysapps.com/lyrical_status/video/".$category_name."/overlay_gg/".$overlay_gg;
                //echo $overlay_gg_url;
                
                echo "path".$_SERVER['DOCUMENT_ROOT']."lyrical_status/video".$category_name."/overlay_gg/".$_FILES["overlay_gg"]["name"];
                move_uploaded_file($_FILES["overlay_gg"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."lyrical_status/video/".$category_name."/overlay_gg/".$_FILES["overlay_gg"]["name"]);
                
                move_uploaded_file($_FILES["image1"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."lyrical_status/video/".$category_name."/thumbnail/".$_FILES["image1"]["name"]);
                
                move_uploaded_file($_FILES["video"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."lyrical_status/video/".$category_name."/video_url/".$_FILES["video"]["name"]);
				
                
                move_uploaded_file($_FILES["demovideo"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."lyrical_status/video/".$category_name."/demo_video_url/".$_FILES["demovideo"]["name"]);
                
                $sql=mysqli_query($con,"insert into video_tb (`video_name`,`demovideo_thumbnail`,`demo_video`,`video_url`,`upload_time`,`video_view`,`video_like`,`video_share`,`overlay_gg`,`category_id`) values
				
				('$name','$image_name1','$demo_video_name1','$video_name1','$date','$view','$like','$share','$overlay_gg_url','1')") or die(mysqli_error($con));
				
				
								
				
				
				
				
				
				
				
                
                if($sql)
                {
                    echo "insert successfully";
                }
                else
                {
                    echo "not succesfully";
                }
                
                
                
                }
                
                // echo phpinfo();
                
                ?>
                
                
                
                <!DOCTYPE html>
                <html>
                <head>
                    <title></title>
                </head>
                <body>
                <center>
                <form name="form" action="" method="POST" enctype="multipart/form-data">
                    <h3><b>Insert Video into DataBase</b></h1><br><br>
                    <!--<label><b>Name:</b></label>-->
                    <!--<input type="text" name="name"><br><br><br>-->
                
                 <label><b>select category</b></label>
                <select name="catgoryidd" class="form-control">
                
                <?php
                $sql = mysqli_query($con, "SELECT * From category_tb");
             
                while ($row = mysqli_fetch_array($sql)){
                echo "<option value='". $row['category_id'] ."'>" .$row['category_name'] ."</option>" ;
                }
                ?>
                </select>
                <br><br><br>
                
                
                 <label><b>Videourl</b></label>
                   <input type="file" name="video" id="video">
                    <br><br><br>
                    
                    
                    <label><b>demo_thumb_image</b></label>
                    <input type="file" name="image1" id="image">
                    <br><br><br>
                    
                  
                    
                    <label><b>demo_video</b></label>
                   <input type="file" name="demovideo" id="demo_video">
                    <br><br><br>
                    
                  
                <label><b>Overlay_gg_file</b></label>
                   <input type="file" name="overlay_gg" id="overlay_gg">
                    <br><br><br>
                
                    <b><input type="submit" name="submit"></b>
                
                    
                    
                </form>
                </center>
                </body>
                </html>
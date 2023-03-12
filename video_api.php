<?php

         
                     
                     $con=mysqli_connect('68.183.81.191','wmzueqzvje','magical_db','wmzueqzvje');
                     
                     
                    if (!$con) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                     else
                            {
                    
                            }
                    $info1 = array();
                    $category_id=$_REQUEST['category_id'];
                    $video_id=@$_REQUEST['video_id'];
                    $like=@$_REQUEST['video_like'];
                    $download=@$_REQUEST['video_download'];
                    $view=@$_REQUEST['video_view'];
                    $share=@$_REQUEST['video_share'];

        if(isset($category_id) and !isset($like) and !isset($view))
        {
            $info=array();
                                      
            
                                $f1 = "SELECT * FROM video_tb where category_id='$category_id' order by video_id desc";
                                   
                                    if ($res=mysqli_query($con,$f1))
                                  {
                                
                                 while ($row1=mysqli_fetch_array($res))
                                    {
                                        
                                        
                                        
                                        $info1[]=array(
                                             'video_id' => $row1['video_id'],
                                             'video_name' => $row1['video_name'],
                                             'thumbnail' => $row1['demovideo_thumbnail'],
                                             'demo_video_url' => $row1['demo_video'],
                                            'video_url'=>$row1['video_url'],
                                            'video_upload_time' => $row1['upload_time'],
                                            
                                            'video_view'=> $row1['video_view'],
                                            'video_like'=>$row1['video_like'],
                                            'video_share' => $row1['video_share'],
                                            'overlay_gg' => $row1['overlay_gg'],
                                            // 'watermark' => $watermark_image,
                                    
                                        ); 
                                      
                                      
                                       
                                     }
                                    
                                 }
                                
                                 $response['success']=1;
                                
                                 $response["result"] =$info1 ;
                               
        }
        // else
        // {
        //     $response['success']=0;
        // }
        
        
        
       if(isset($view) and isset($video_id))
        {
            $sql=mysqli_query($con,"select video_view from video_tb where video_id='$video_id'");
            
            if($sql)
            {
                while($res=mysqli_fetch_array($sql))
                {
                    $view=$res['video_view'];
                }
                
            }
            
            
            $new_view=$view+1;
            
            $update=mysqli_query($con,"update video_tb set video_view='$new_view' where video_id='$video_id'");
            if($update)
            {
                $response['message']="update_successfully";
                $response['success']=1;
            }
            else
            {
                $response['message']="not update";
                $response['success']=0;
            }
        }
        
        
        
        if(isset($download) and isset($video_id))
        {
            $sql=mysqli_query($con,"select * from video_tb where video_id='$video_id'");
            
            if($sql)
            {
                while($res=mysqli_fetch_row($sql))
                {
                    $view1=$res[8];
                }
                
            }
            // $response['view']=$view1;
            
            $new_view=$view1+1;
            $response['new']=$new_view;
            
            $update=mysqli_query($con,"update video_tb set download='$new_view' where video_id='$video_id'");
            if($update)
            {
                $response['message']="update_successfully";
                $response['success']=1;
            }
            else
            {
                $response['message']="not update";
                $response['success']=0;
            }
        }
        
        
         if(isset($share) and isset($video_id))
        {
            $sql=mysqli_query($con,"select video_share from video_tb where video_id='$video_id'");
            
            if($sql)
            {
                while($res=mysqli_fetch_array($sql))
                {
                    $view=$res['video_share'];
                }
                
            }
            
            
            $new_view=$view+1;
            
            $update=mysqli_query($con,"update video_tb set video_share='$new_view' where video_id='$video_id'");
            if($update)
            {
                $response['message']="update_successfully";
                $response['success']=1;
            }
            else
            {
                $response['message']="not update";
                $response['success']=0;
            }
        }
        
        
        
         if(isset($like) and isset($video_id))
        {
            $sql=mysqli_query($con,"select video_like from video_tb where video_id='$video_id'");
            
            if($sql)
            {
                while($res=mysqli_fetch_array($sql))
                {
                    $view=$res['video_like'];
                }
                
            }
            
            
            $new_view=$view+1;
            
            $update=mysqli_query($con,"update video_tb set video_like='$new_view' where video_id='$video_id'");
            if($update)
            {
                $response['message']="update_successfully";
                $response['success']=1;
            }
            else
            {
                $response['message']="not update";
                $response['success']=0;
            }
        }
               
                            
                            
             header('Content-Type: application/json;charset=utf-8');
             echo json_encode( $response,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
      





?>
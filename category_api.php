<?php
      
$con=mysqli_connect("68.183.81.191","wmzueqzvje","magical_db","wmzueqzvje") or die(mysqli_error($con));


                                
                     
                    if (!$con) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                     else
                            {
                     //echo "Connection established!";
                            }
                    $info1 = array();

        
                                $f1 = "SELECT * FROM category_tb";
                                   
                                    if ($res=mysqli_query($con,$f1))
                                  {
                                
                                 while ($row1=mysqli_fetch_array($res))
                                    {
                                        
                                         $info1[]=array(
                                             'category_id' => $row1['category_id'],
                                            'category_name'=>$row1['category_name'],
                                         
   'category_image' => $row1['category_image']
                                
            // 'quotes_cat_id' => $row1['quotes_cat_id']
                                            // 'quotes_cat_image'=>$row1[1],
                                            // 'quotes_cat_name' => $row[1]
                                
                                        ); 
                                      
                                       
                                     }
                                    
                                 }
                            
                            
 header('Content-Type: application/json;charset=utf-8');

           $response["result"] =$info1 ;
          
       
          echo json_encode( $response,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
      





?>
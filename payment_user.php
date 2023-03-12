<?php
$con=mysqli_connect('68.183.81.191','wmzueqzvje','magical_db','wmzueqzvje');
    $user_id=$_POST['user_id'];
	
	
	
	
	
	
	$query=mysqli_query($con,"select * from scheme_amount_tb");
if($query)
{
	while($res=mysqli_fetch_array($query))
{
	$default_installpay=$res['default_installpay'];

}
}
	
	
     $payment_type=$_POST['payment_type'];
     $payment_amount=$_POST['payment_amount'];
     $mobile_number=$_POST['mobile_number'];
     $email=$_POST['email'];
     
     $requested_date= date("Y-m-d");
     $payment_date=0;
     $is_pay=0;


     $sql=mysqli_query($con,"insert into payment_tb (`user_id`,`payment_type`,`payment_amount`,`mobile_number`,`requested_date`,`payment_date`,`is_pay`,`email`) values('$user_id','$payment_type','$payment_amount','$mobile_number','$requested_date','$payment_date','$is_pay','$email')") or die(mysqli_error($con));

     if($sql)
     {
     	
     	$select =mysqli_query($con,"select * from earning_magical_tb where user_id='$user_id'");

          if($select)
          {
               while($res=mysqli_fetch_array($select))
               {
                    $old_amount=$res['amount'];
               }
               $response['old_amount']=$old_amount;

               $new_amount=$old_amount-$payment_amount;

               $updatee=mysqli_query($con,"update earning_magical_tb set amount='$new_amount',is_first='1' where user_id='$user_id'");
               if($updatee)
               {
                    
               }
               else
               {
                   
               }
          }
 $sql=mysqli_query($con,"select * from earning_magical_tb where user_id='$user_id'") or die (mysqli_error($con));

               if($sql)
               {
                    while($res=mysqli_fetch_array($sql))
                    {
                         $info1[]=array(
                                    'user_id' => $res['user_id'],
                                    'time' => $res['time'],
                                   'device_id' => $res['device_id'],
                                   'amount' => $res['amount'],
                                   'is_first' => $res['is_first'],
								   'default_installpay' => $default_installpay
                                   

                              );
                         break;
                        
                    }
               $response['message']=1;
                    $response['data']=$info1;

               }


$info4=array();


                $sql1=mysqli_query($con,"select * from scheme_amount_tb") or mysqli_error($con);

     if($sql1)
     {
        while($res1=mysqli_fetch_array($sql1))
        {
          $info4[] =array(
            "first_pay_limit" => $res1['first_pay_limit'],
            "second_pay_limit" => $res1['second_pay_limit'],
            "video_earn" => $res1['video_earn'],
          );
        }

        $response['amount_data']=$info4;
     }

     }
     else
     {
     	$response['message']="not insert";
     }

header('Content-Type: application/json;charset=utf-8');
                            
      echo json_encode( $response,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

?>



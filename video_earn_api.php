<?php
$con=mysqli_connect('68.183.81.191','wmzueqzvje','magical_db','wmzueqzvje');



$query=mysqli_query($con,"select * from scheme_amount_tb");
if($query)
{
	while($res=mysqli_fetch_array($query))
{
	$default_installpay=$res['default_installpay'];

}
}







$device_id=$_POST['device_id'];
$amount=$_POST['amount'];

$sql=mysqli_query($con,"select amount from earning_magical_tb where device_id='$device_id'") or die(mysqli_error($con));
if($sql)
{
     while($res=mysqli_fetch_array($sql))
     {
          $old_amount=$res['amount'];
     }

     $new_amount=$old_amount+$amount;


     $update=mysqli_query($con,"update earning_magical_tb set amount='$new_amount' where device_id='$device_id'") or die(mysqli_error($con));


$info1=array();
     if($update)
     {
          $response['success']=1;
          $select=mysqli_query($con,"select * from earning_magical_tb where device_id='$device_id'");
          if($select)
          {
               while($res=mysqli_fetch_array($select))
               {
                       $info1[]=array(
                                    'user_id' => $res['user_id'],
                                    'time' => $res['time'],
                                   'device_id' => $res['device_id'],
                                   'amount' => $res['amount'],
                                   'is_first' => $res['is_first'],
                                   'default_installpay' => $default_installpay

                              );
                         
               }


               $response['data']=$info1;
          }

               
     
     }
     else
     {
          $response['success']=0;
     }
}

$info3=array();
 $sql1=mysqli_query($con,"select * from scheme_amount_tb") or mysqli_error($con);

     if($sql1)
     {
        while($res1=mysqli_fetch_array($sql1))
        {
          $info3[] =array(
            "first_pay_limit" => $res1['first_pay_limit'],
            "second_pay_limit" => $res1['second_pay_limit'],
            "video_earn" => $res1['video_earn'],
          );
        }

        $response['amount_data']=$info3;
     }


header('Content-Type: application/json;charset=utf-8');
                            
      echo json_encode( $response,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);


?>
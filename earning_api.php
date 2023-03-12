<?php

  header('Content-Type: application/json;charset=utf-8');

//clearstatcache();
$con=mysqli_connect('68.183.81.191','wmzueqzvje','magical_db','wmzueqzvje');

     $device_id=$_POST['device_id'];  

$query=mysqli_query($con,"select * from scheme_amount_tb");
if($query)
{
	while($res=mysqli_fetch_array($query))
{
	$default_installpay=$res['default_installpay'];

}
}
    
 $amount=$default_installpay;   






date_default_timezone_set("Asia/Kolkata");

$date = date("Y/m/d");
$time1 =  date("H:i a");


$time=$date ."-" .$time1;

//$response['date']=$date; 
//$response['sdate_time']= $date1;




     $info=array();
$info2=array();

     $sql=mysqli_query($con,"select * from earning_magical_tb where device_id='$device_id'") or die (mysqli_error($con));

     if(mysqli_num_rows($sql) > 0 )
     {
               while($res=mysqli_fetch_array($sql))
               {
                              $info[]=array(
'user_id' => $res['user_id'],
'time' => $res['time'],
                                   'device_id' => $res['device_id'],
                                   'amount' => $res['amount'],
 'is_first' => $res['is_first'],
 'default_installpay' => $default_installpay

                    );
               }

                    $response['message']=0;
                    $response['data']=$info;
          }

     else
     {

       $insert=mysqli_query($con,"insert into earning_magical_tb(`time`,`device_id`,`amount`) values('$time','$device_id','$amount')") or die(mysqli_error($con));
       if($insert)
       {

$info1=array();
               $id=mysqli_insert_id($con);
              
          
               $sql=mysqli_query($con,"select * from earning_magical_tb where device_id='$device_id'") or die (mysqli_error($con));

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


       }
       else
       {
       echo "no insert";
       }    
     }



      $sql1=mysqli_query($con,"select * from scheme_amount_tb") or mysqli_error($con);

     if($sql1)
     {
        while($res1=mysqli_fetch_array($sql1))
        {
          $info2[] =array(
            "first_pay_limit" => $res1['first_pay_limit'],
            "second_pay_limit" => $res1['second_pay_limit'],
            "video_earn" => $res1['video_earn'],
          );
        }

        $response['amount_data']=$info2;
     }

     echo json_encode( $response,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>
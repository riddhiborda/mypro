<?php

  header('Content-Type: application/json;charset=utf-8');

//clearstatcache();
$con=mysqli_connect('68.183.81.191','wmzueqzvje','magical_db','wmzueqzvje');


$device_id=$_POST['device_id'];
date_default_timezone_set("Asia/Kolkata");
$today_date= date("Y/m/d");


$query=mysqli_query($con,"select * from scheme_amount_tb");
if($query)
{
	while($res=mysqli_fetch_array($query))
{
	$default_installpay=$res['default_installpay'];

}
}


$select = mysqli_query($con,"select * from earning_magical_tb where device_id='$device_id'") or die(mysqli_error($con));

if(mysqli_num_rows($select)){

while($res=mysqli_fetch_array($select))
{
     $first_date=$res['time'];


}

          $what_you_want = substr($first_date, 0, strpos($first_date, '-'));
     $cut_date=$what_you_want;
    
     $increase_date=date('Y/m/d', strtotime($cut_date. ' + 5 days'));
     
     

if($today_date >= $increase_date)
{
     $response['status']=1;

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
     $response['status']= 0;
}

}

else
{
     $response['data']= "no mjatch";
}


header('Content-Type: application/json;charset=utf-8');
 echo json_encode( $response,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>
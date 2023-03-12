<?php 

$con=mysqli_connect('68.183.81.191','wmzueqzvje','magical_db','wmzueqzvje');


$is_pay=0;
     $sql=mysqli_query($con,"select * from payment_tb p,earning_magical_tb r where r.user_id=p.user_id and p.is_pay='$is_pay'") or die(mysqli_error($con));

$pay=1;
if(isset($_GET['pay_id']))
{

    $id=$_GET['pay_id'];
    $sqll=mysqli_query($con,"update payment_tb set is_pay='$pay' where pay_id='$id'");

    if($sqll)
    {
        echo "<script>
            alert('Approve data successfull');
            window.location.href='requested_user_panel.php';
            </script>";
    }



}
else
{
	
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>display user</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function() {
    $('#example').DataTable();
        } );
    


 
</script>
</head>
<body>
<h3><center
>Requested User Panel</center></h3>
<div class="container">
    <form id="form" name="form" method="post" action="requested_user_panel.php">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>

               
                <th>Mobile Number</th>
                <th>Requested Date</th>
                
                
              
                <th>Payment Amount</th>
                <th>Payment Type</th>
                <th>Approve</th>
               
               
                
                
            </tr>
        </thead>
       
           <tbody>
            
               <?php 

while($res=mysqli_fetch_array($sql))
{
    ?>
    <tr>
       
        <td><?php echo $res['mobile_number'];?></td>
        <td><?php echo $res['requested_date'];?></td>
        
        
        
        <td><?php echo $res['payment_amount'];?></td>
        <td><?php echo $res['payment_type'];?></td>

        <td><button type="button" class="btn btn-primary"><a href="requested_user_panel.php?pay_id=<?php echo $res['pay_id']; ?>" style="color:#ffffff">Approve</a></button></td>
        

        
        </tr>

<?php }
               ?>

            
           
          
        </tbody>
      

    </form>
    </table>

</div>
</body>


</html>
<?php 

$con=mysqli_connect('68.183.81.191','wmzueqzvje','magical_db','wmzueqzvje');

$is_pay=1;
     $sql=mysqli_query($con,"select * from payment_tb p,earning_magical_tb r where r.user_id=p.user_id and p.is_pay='$is_pay' group by r.user_id") or die(mysqli_error($con));

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
>Paid User Panel</center></h3>
<div class="container">
    <form id="form" name="form" method="post" action="requested_user_panel.php">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>

                <th>UserId</th>
                <th>Mobile Number</th>
               <th>View detail</th>
               
            </tr>
        </thead>
       
           <tbody>
            
               <?php 

while($res=mysqli_fetch_array($sql))
{
    ?>
    <tr>
        <td><?php echo $res['user_id'];?></td>
        <td><?php echo $res['mobile_number'];?></td>
        <td><button type="button" class="btn btn-primary"><a href="view_detail.php?user_id=<?php echo $res['user_id']; ?>" style="color:#ffffff">View Detail</a></button></td>
        
        </tr>

<?php }
               ?>         
          
        </tbody>
      

    </form>
    </table>

</div>
</body>


</html>
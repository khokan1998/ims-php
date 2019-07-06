<?php include 'connectserver.php';



$first_name = "";
$last_name = "";
//$email = "";
// $mobile = "";
if(isset($_REQUEST['submit'])){
    $first_name=$_GET['first_name'];
    //$last_name=$_GET['last_name'];
    // $email=$_GET['email'];
    // $mobile=$_GET['mobile'];
    $sql=" SELECT * FROM users";

/*
    $cond = [];

    if (!empty($first_name)) {
           $cond[] = "first_name like '%".$first_name."%'";
    }
    if (!empty($last_name)) {
        $cond[] = " last_name like '%".$last_name."%' ";
    }

    if (!empty($cond))  {
        $sql .= " WHERE " . implode(' AND ', $cond);
    }
*/
    if (!empty($first_name)) {
        $sql .= " WHERE first_name like '%".$first_name."%' OR last_name LIKE '%".$first_name."%' OR email LIKE '%".$first_name."%' OR mobile LIKE '%".$first_name."%'";
    }
    


    $sql .= " LIMIT 2 ";

    // print $sql;

     // WHERE  OR last_name ='%".$last_name."%' OR email ='%".$email."%' OR mobile ='%".$mobile."%'";
    $q=mysqli_query($conn,$sql);
}
else{
    $sql="SELECT * FROM users";
    $q=mysqli_query($conn,$sql);
}
?>
<form method="get">
    <table border="1">
  <tr>
    <td>first_name:</td>
    <td><input type="text" name="first_name" value="<?php echo $first_name;?>" /></td>
    <td>last_name:</td>
    <td><input type="text" name="last_name" value="<?php echo $last_name;?>" /></td>
    <td><input type="submit" name="submit" value=" Find " /></td>
  </tr>
</table>
</form>
<table border="1">
    <tr>
        <td>first_name:</td>
        <td>last_name:</td>
        <td>email:</td>
        <td>mobile:</td>
    </tr>
    <?php
    while($res=mysqli_fetch_array($q)){
    ?>
    <tr>
        <td><?php echo $res['first_name'].' '.$res['last_name'];?></td>
        <td><?php echo $res['last_name'];?></td>
        <td><?php echo $res['email'];?></td>
        <td><?php echo $res['mobile'];?></td>
    </tr>
    <?php }?>
</table>
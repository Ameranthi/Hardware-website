<?php include ('partials/menu.php');
  ?>
<div class = "main-content">
       <div class = "wrapper"> 
           <h1> Manage Specific Lines in the Order </h1>
<br><br>

<table class="tbl-full">
    <tr>
        <th>Line Number</th>
        <th>Qty.</th>
        <th>client ID</th>
        <th>price</th>
        <th>price on purchase</th>
        <th>part number</th>


  <?php 
    //Check whether purchase order number is set or not 
    if(isset($_GET['PurchaseOrder0639_poNo639']))
    {
        //Get all the details
        $PurchaseOrder0639_poNo639 = $_GET['PurchaseOrder0639_poNo639'];

        //SQL Query to Get the Selected part
        $sql = "SELECT * FROM Lines0639 WHERE PurchaseOrder0639_poNo639=$PurchaseOrder0639_poNo639 ORDER BY LineNO639";
        //execute the Query
        $res = mysqli_query($conn, $sql);

        //Get the value based on query executed
        $count = mysqli_num_rows($res);


        if($count>0)
        {
         //Order Available
         while($row=mysqli_fetch_assoc($res))
         {
          
     //Get the Individual Values of Selected parts
     $LineNO639 = $row['LineNO639'];
     $Qty639 = $row['Qty639'];
     $clientID639 = $row['clientID639'];
     $price639 = $row['price639'];
     $priceOnPurchase639 = $row['priceOnPurchase639']; 
     $Part639_PartNO639 = $row['Part639_PartNO639'];
     $PurchaseOrder0639_poNo639 = $row['PurchaseOrder0639_poNo639'];
     //echo $LineNO639; // for testing purposes
          
             ?>
  </tr>
                 <tr>
                     <td><?php echo $LineNO639; ?></td>
                     <td><?php echo $Qty639; ?></td>
                     <td><?php echo $clientID639; ?></td>
                     <td>$<?php echo $price639; ?></td>
                     <td>$<?php echo $priceOnPurchase639; ?></td>
                     <td><?php echo $Part639_PartNO639; ?></td>

                 </tr>
             <?php
         }
     }
    }
    else
    {
        //Redirect to Manage part
        echo "Orders not Available";
        header('location:'.SITEURL.'admin639/manage-parts.php');
    }
?>

</table>
</div>
</div>

<?php include ('partials/footer.php'); ?>

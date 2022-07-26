<?php include ('partials/menu.php');
  ?>
<div class = "main-content">
       <div class = "wrapper"> 
           <h1> Manage Purchase Orders of our customers </h1>
           <br /><br />

<?php
           if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    ?>
                    
<!-- buttons to make actionables -->
                <a href="<?php echo SITEURL; ?>admin639/add-PO639.php" class="btn-primary">Create Purchase Order</a>
                <a href="<?php echo SITEURL; ?>admin639/add-lines639.php" class="btn-primary">Add Parts to Purchase Order</a>
                <br /><br /><br />
<!-- make a mini form to sort by client id -->
                <form action ="" method= "POST" enctype = "multipart/form-data>" >
        <table class = "tbl-30"> 
<tr>
     <td> search by client ID:</td> 
     <td> 
         <input type="text" name="Clients639_idClients639" placeholder = "input client ID want to sort by">
</td>
</tr> 
                <tr> 
    <td colspan ="2"> 
        <input type = "submit" name ="submit" value = "Find" class = "btn-secondary"> 

</table> 

    </form> 
    

    <?php 
    if(isset($_POST['submit'])){
        $Clients639_idClients639 = $_POST['Clients639_idClients639'];
    header('location:'.SITEURL.'admin639/manage-pos639.php?Clients639_idClients639='.$Clients639_idClients639);
    }
     //echo $poNo639

    ?>
                <br /><br /><br />
<?php 
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
?>

<br><br>
<table class="tbl-full">
    <tr>
        <th>Purchase order Number</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Customer ID</th>

    <?php 
    //Check whether purchase order number is set or not 
    if(isset($_GET['Clients639_idClients639']))
    {
        //Get all the details
        $Clients639_idClients639 = $_GET['Clients639_idClients639'];
        //SQL Query to Get the Selected part
        $sql2 = "SELECT * FROM PurchaseOrder0639 WHERE Clients639_idClients639= '$Clients639_idClients639' ";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);
        //Get the value based on query executed
        $count = mysqli_num_rows($res2);
        if($count>0)
        {
         //Order Available
         while($row2=mysqli_fetch_assoc($res2))
         {
            $poNo639 = $row2['poNo639'];
            $datePO639= $row2['datePO639'];
            $statusPO639 = $row2['statusPO639'];
            $Clients639_idClients639 = $row2['Clients639_idClients639'];
            ?>
                    <tr>
                        <td><?php echo $poNo639; ?></td>
                        <td><?php echo $datePO639; ?></td>
                        <td><?php echo $statusPO639; ?></td>
                        <td><?php echo $Clients639_idClients639; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin639/manage-lines639.php?PurchaseOrder0639_poNo639=<?php echo $poNo639; ?>" class="btn-secondary">View Lines on Order</a>
                       
                        </td>
                    </tr>
                <?php
         }
    }
}else {

        //Get all the orders from database
        $sql = "SELECT * FROM PurchaseOrder0639 ORDER BY poNo639 DESC"; // DIsplay the Latest Order at First
        //Execute Query
        $res = mysqli_query($conn, $sql);
        //Count the Rows
        $count = mysqli_num_rows($res);

        if($count>0)
        {
            //Order Available
            while($row=mysqli_fetch_assoc($res))
            {
                //Get all the order details
                $poNo639 = $row['poNo639'];
                $datePO639= $row['datePO639'];
                $statusPO639 = $row['statusPO639'];
                $Clients639_idClients639 = $row['Clients639_idClients639'];
                ?>
                    <tr>
                        <td><?php echo $poNo639; ?></td>
                        <td><?php echo $datePO639; ?></td>
                        <td><?php echo $statusPO639; ?></td>
                        <td><?php echo $Clients639_idClients639; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin639/manage-lines639.php?PurchaseOrder0639_poNo639=<?php echo $poNo639; ?>" class="btn-secondary">View Lines on Order</a>
                        </td>
                    </tr>

                <?php

            }
        }
    }
    ?>
</table>
</div>
</div>
<?php include ('partials/footer.php'); ?>
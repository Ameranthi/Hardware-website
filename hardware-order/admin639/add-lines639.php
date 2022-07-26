<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class = "wrapper"> 
        <h1>Add Parts to Purchase Order</h1> 
        <br /> 

        <form action ="" method= "POST" enctype = "multipart/form-data>" >
        <table class = "tbl-30"> 

        <!-- Name of the part -->
<tr>
     <td> Purchase Order Number:</td> 
     <td> 
         <input type="text" name="PurchaseOrder0639_poNo639" placeholder = "input the pO # you want to add to">
</td>
</tr> 
<!-- Display parts in drop down that are in stock -->
<tr>
                    <td>Parts: </td>
                    <td>
                        <select name="Part639_PartNO639">

                            <?php 
                                //only display parts that we have in stock
                                $sql3 = "SELECT * FROM Part639 WHERE QoH639 > 0";
                                $currentPrice639 = 1;
                                //Executing query
                                $res3 = mysqli_query($conn, $sql3);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res3);
                                if($count>0)
                                {
                                 while($row3=mysqli_fetch_assoc($res3))
                                {
                                $PartNO639 = $row3['PartNO639'];
                                $PartName639 = $row3['PartName639'];
                                $PartDescription639 = $row3['PartDescription639'];
                             $currentPrice639 = $row3['currentPrice639'];
                                

                                        ?>
                                        <option value="<?php echo $PartNO639; ?>"><?php echo $PartName639; ?></option>

                                        <?php
                                    }
                                }

                                else
                                {
                                
                                    ?>
                                    <option value="0">No Parts Found</option>
                                    <?php
                                }

                                ?>
                                </select>
                    </td>
                </tr>
                <tr> 
                <td> Quantity </td> 
    <td> <input type = "number" name= "Qty639" placeholder = " How many do you want?">
</td>

<!-- submit form -->
<tr> 
    <td colspan ="2"> 
        <input type = "submit" name ="submit" value = "Add Part to order" class = "btn-secondary"> 

</table> 
    </form> 


<!-- create php to add data into database -->
<?php
//Is the button clicked?
if(isset($_POST['submit']))
{
    //yes,
    //get data from the form 
    // purchase order nomber to insert line into
$PurchaseOrder0639_poNo639 = $_POST['PurchaseOrder0639_poNo639'];
//partid to insert into line
$Part639_PartNO639 = $_POST['Part639_PartNO639'];
//qty entered
$Qty639 = $_POST['Qty639'];


//get the rest of the infomration to fill in the rest of the fields
    $sql = "SELECT currentPrice639 FROM Part639 WHERE PartNO639 = '$Part639_PartNO639'";             
    //Executing query'
    $price = 0;
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count>0){
     while($row=mysqli_fetch_assoc($res))
    {  
        $price = $row['currentPrice639'];
    } 
}
$sql = "SELECT Clients639_idClients639 FROM PurchaseOrder0639 WHERE poNo639 = '$PurchaseOrder0639_poNo639'";             
    //Executing query'
    $clientID639 = 0;
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count>0){
     while($row=mysqli_fetch_assoc($res))
    {  
        $clientID639 = $row['Clients639_idClients639'];
    } 
}
$sql = "SELECT LineNO639 FROM Lines0639 WHERE PurchaseOrder0639_poNo639 = '$PurchaseOrder0639_poNo639' ORDER BY LineNO639";             
    //Executing query'
    $LineNO639 =1;
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count>0){
     while($row=mysqli_fetch_assoc($res))
    {  
        $LineNO639 = $row['LineNO639'];
    } 
}
$price639 = $price;
$priceOnPurchase639 = $price;
$LineNO639 + 1;

Echo "$price639" .'/n';
Echo"$LineNO639".'/n' ;
Echo  "$Qty639" .'/n';
Echo "$Part639_PartNO639".'/n';


$sql = "INSERT INTO Lines0639 SET 
            Qty639 = '$Qty639',
            LineNO639 = $LineNO639,
            priceOnPurchase639 = '$priceOnPurchase639',
            price639 = '$price639',
            Part639_PartNO639 = $Part639_PartNO639,
            PurchaseOrder0639_poNo639 = $PurchaseOrder0639_poNo639,
            clientID639 = $clientID639
            
    ";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check if data inserted or not
    if($res == true)
    {
        //Data inserted Successfullly into DB
        $_SESSION['add'] = "<div class='success'> PO Added Successfully.</div>";
        header('location:'.SITEURL.'admin639/manage-pos639.php');
    }
    else
    {
        //fail to Insert Data into DB
        $_SESSION['add'] = "<div class='error'> Failed to Add Line.</div>";
        header('location:'.SITEURL.'admin639/add-lines639.php');
    }
} else {
    echo "not submitted";
}

?>
</div>
</div> 

<?php include('partials/footer.php'); ?>
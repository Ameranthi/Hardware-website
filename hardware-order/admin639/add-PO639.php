<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class = "wrapper"> 
        <h1>Create New Purchase Order</h1> 
        <br /> 

        <?php 
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>


        <form action ="" method= "POST" enctype = "multipart/form-data>" >
        <table class = "tbl-30"> 

        <!-- Name of the part -->
<tr>
     <td> Client ID:</td> 
     <td> 
         <input type="text" name="Clients639_idClients639" placeholder = "input your ID">
</td>
</tr> 
<!-- submit form -->
<tr> 
    <td colspan ="2"> 
        <input type = "submit" name ="submit" value = "Add Part" class = "btn-secondary"> 

</table> 

    </form> 
<!-- create php to add data into database -->
<?php


//CHeck whether the button is clicked or not
if(isset($_POST['submit']))
{
    //get data from the form 
    $Clients639_idClients639 = $_POST['Clients639_idClients639'];
    $statusPO639 = "pending";

    $sql3= "SELECT Clients639_idClients639 FROM PurchaseOrder0639 WHERE $Clients639_idClients639=Clients639_idClients639";
    if ($sql3=!""){

    $sql = "INSERT INTO PurchaseOrder0639 SET 
        Clients639_idClients639 = '$Clients639_idClients639',
        statusPO639 = '$statusPO639'
    ";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check if data inserted or not
    if($res == true)
    {
        //Data inserted Successfullly into  DB
        $_SESSION['add'] = "<div class='success'> PO Added Successfully.</div>";
        header('location:'.SITEURL.'admin639/manage-pos639.php');
    }
    else
    {
        //fail to Insert Data into DB
        $_SESSION['add'] = "<div class='error'> Failed to Add po.</div>";
        header('location:'.SITEURL.'admin639/manage-pos639.php');
    }
} else {
    echo "error no client that number";
}
}

?>


</div>
</div> 

<?php include('partials/footer.php'); ?>


<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class = "wrapper"> 
        <h1>Add Part</h1> 
        <br /> 


        <form action ="" method= "POST" enctype = "multipart/form-data>" >
        <table class = "tbl-30"> 

        <!-- Name of the part -->
<tr>
     <td> Part Name:</td> 
     <td> 
         <input type="text" name="partname" placeholder = "Name of the Part">
</td>
</tr> 
<!-- Description of the part -->
<tr>
<td> Description: </td> 
<td> <textarea name="description" cols="20" rows="3" placeholder = "description of the part"></textarea>
</tr>
<!-- price of part -->
<tr> 
    <td> Price: </td> 
    <td> <input type = "number" name= "price" placeholder = " please enter a numerical price of the part">

</td>
</tr>

<!-- QOH -->
<tr> 
    <td> Quantity on Hand </td> 
    <td> <input type = "number" name= "qoh" placeholder = " How many is in stock?">
</td>
</tr>
<!-- Select Image of the part -->
<tr> 
    <td> Select Image: </td>
    <td> <input type = "file" name = "image"> </td>
</tr>

<!-- submit form -->
<tr> 
    <td colspan ="2"> 
        <input type = "submit" name ="submit" value = "Add Part" class = "btn-secondary"> 

</table> 

    </form> 
<!-- create php to add data into database -->
<?php


//Is button clicked
if(isset($_POST['submit']))
{
    //get data from the form 
    $partname = $_POST['partname'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $qoh = $_POST['qoh'];
   // echo "clicked! "; // for testing

// ---------------- Broken code block. Needs debugging  --- cannot add image correctly 
    //Upload the Image if selected
   //check image and uplaod if statement
    if(isset($_FILES['image']['name']))
    {
       // if yes, get the deets of img 
               $image_name = $_FILES['image']['name'];
        //Check Whether the Image is Selected or not and upload image only if selected
        if($image_name!="")
        {
            // Image is selected....  REname the Image
            //Get the extension of selected image (jpg, png, gif, etc.)
            $ext = end(explode('.', $image_name));
            $image_name = $partname.rand(0000,9999).".".$ext;//ensure uniqueness of file name and make new image name: "hammer-827.jpg"
            // echo $image_name;
            // echo "renamed!";

            // Source path is the current location of the image
            $src = $_FILES['image']['tmp_name'];
            //Destination Path for the image to be uploaded
            $dst = "../images/parts/".$image_name;
            // Upload the parts image
            $upload = move_uploaded_file($src, $dst);
            //check if image uploaded // This doesn't workkk hahah 
            if($upload==false)
            {
                //Failed to Upload the image
                //REdirect to Add parts Page with Error Message
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                header('location:'.SITEURL.'admin639/manage-parts639.php'); //redirect anyways and upload anyways cause its broken fml 
                //STop the process
                die();
            }
        }
    }
    //// ----------- end of broken code block in need of debugging 
    
    else
    {
        $image_name = ""; //set Default val as blank
    }

    $sql2 = "INSERT INTO Part639 SET 
        PartName639 = '$partname',
        PartDescription639 = '$description',
        currentPrice639 = $price,
        Image_Name639 = '$image_name',
        QoH639 = $qoh;
    ";

    //Execute the Query
    $res2 = mysqli_query($conn, $sql2);

    //Check if data inserted or not
    if($res2 == true)
    {
        //Data inserted Successfullly into  DB
        $_SESSION['add'] = "<div class='success'> parts Added Successfully.</div>";
        header('location:'.SITEURL.'admin639/manage-parts639.php');
    }
    else
    {
        //fail to Insert Data into DB
        $_SESSION['add'] = "<div class='error'> Failed to Add parts.</div>";
        header('location:'.SITEURL.'admin639/manage-parts639.php');
    }
}
?>


</div>
</div> 

<?php include('partials/footer.php'); ?>


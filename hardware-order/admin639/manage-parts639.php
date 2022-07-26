<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage parts</h1>

        <br /><br />
                <a href="<?php echo SITEURL; ?>admin639/add-parts.php" class="btn-primary">Add parts</a>
                <br /><br /><br />
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }


                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>PartNO639</th>
                        <th>PartName639</th>
                        <th>PartDescription639</th>
                        <th>currentPrice639</th>
                        <!-- <th>QoH639</th>  -->
                        <th>Image_Name639</th>
        
                     
                    </tr>

                    <?php 
                        //Create a SQL Query to Get all the parts
                        $sql = "SELECT * FROM Part639";
                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);
                        //Count Rows to check whether we have partss or not
                        $count = mysqli_num_rows($res);
                       

                        if($count>0)
                        {
                            //We have parts in Database
                            //Get the partss from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $PartNO639 = $row['PartNO639'];
                                $PartName639 = $row['PartName639'];
                                $PartDescription639 = $row['PartDescription639'];
                                $currentPrice639 = $row['currentPrice639'];
                                // $QoH639 = $row['QoH639'];
                                $Image_Name639 = $row['Image_Name639'];
                                ?>

                                <tr>
                                    <td><?php echo $PartNO639; ?></td>
                                    <td><?php echo $PartName639; ?></td>
                                    <td><?php echo $PartDescription639; ?></td>
                                    <td>$<?php echo $currentPrice639; ?></td>
                                    <!-- no quatity for this A2 -->
                                    
                                    <td>
                                        <?php  
                                            //Is there a proper image file?
                                            if($Image_Name639=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "No image";
                                            }
                                            else
                                            {
                                                //We Have a proper Image file that we can display
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/parts/<?php echo $Image_Name639; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //parts not Added in Database
                            echo "<tr> <td colspan='7' class='error'> parts not Added Yet. </td> </tr>";
                        }

                    ?>

                    
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>
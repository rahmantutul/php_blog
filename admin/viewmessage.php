<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Message Details</h2>
                <?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                       echo "<script>window.location='seenmessage.php';</script>"; 
                    }
                ?>
                <div class="block">               
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                    <?php 
                          if(isset($_GET['msg_id']) && $_GET['msg_id']!=NULL){
                            $msgId=$_GET['msg_id'];
                            $query = "SELECT * FROM tbl_contact WHERE id=$msgId";
                            $data= $db->select($query);
                            if($data){ while($result= $data->fetch_assoc()){
                           
                        ?>
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" class="medium" value="<?php echo $result['firstname']. ''. $result['lastname']?>" readonly/>
                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" class="medium" value="<?php echo $result['email']?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="email" class="medium" value="<?php echo $helper->dateFormate($result['date'])?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea style="width:55%;height:500px;" readonly> <?php echo $result['body']?></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Okay" />
                            </td>
                        </tr>
                        <?php }}}?>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
    <!-- /TinyMCE -->
    <style type="text/css">
		#tinymce{font-size:15px !important;}
    </style>
    <?php include 'inc/footer.php';?>


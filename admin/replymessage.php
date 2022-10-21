<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Message Details</h2>
                <?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $to = mysqli_real_escape_string($db->link,$_POST['to']);
                        $from = mysqli_real_escape_string($db->link,$_POST['from']);
                        $subject = mysqli_real_escape_string($db->link,$_POST['subject']);
                        $message = mysqli_real_escape_string($db->link,$_POST['message']);
                        $email = mail($to, $subject,$message, $from);
                        if($email){
                            echo "<span style='color:green;'>Message sent successfully!</span>";
                        }else{
                            echo "<span style='color:red;'>Something went wrong!</span>";
                        }
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
                                <label>To</label>
                            </td>
                            <td>
                                <input type="email" class="medium" name="to" value="<?php echo $result['email']?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="email" class="medium" name="from"/>
                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="subject"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Mesage</label>
                            </td>
                            <td>
                            <textarea class="tinymce" name="message"></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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
        });
    </script>
    <!-- /TinyMCE -->
    <style type="text/css">
		#tinymce{font-size:15px !important;}
    </style>
    <?php include 'inc/footer.php';?>


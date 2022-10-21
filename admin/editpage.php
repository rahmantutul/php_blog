<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Post</h2>
                <?php 
                    if(isset($_GET['page_id']) && $_GET['page_id'] != NULL){
                        $pageId= $_GET['page_id'];
                        
                    }
                ?>
                <?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $name = mysqli_real_escape_string($db->link,$_POST['name']);
                        $title = mysqli_real_escape_string($db->link,$_POST['title']);
                        $body = mysqli_real_escape_string($db->link,$_POST['body']);
                        if($name=="" || $title==""|| $body=="" ){
                            echo "<span class='error'>Fields must not be empty!!
                            </span>";
                        }else{
                            $query= "UPDATE tbl_page SET
                                name ='$name',
                                title ='$title',
                                body ='$body'
                                WHERE id= '$pageId';
                            ";

                            $updated_rows = $db->insert($query);

                            if ($updated_rows) {
                            echo "<span class='success'>Page updated Successfully.
                            </span>";
                            }
                          }
                        }
                ?>
                <div class="block">               
                 <form action="" method="POST">
                    <table class="form">
                       <?php 
                            $query = "SELECT * FROM tbl_page WHERE id=$pageId";
                            $data= $db->select($query);
                            if($data){ while($pResult= $data->fetch_assoc()){
                        ?>
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" class="medium"  name="name"  value="<?php echo $pResult['name']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" class="medium"  name="title"  value="<?php echo $pResult['title']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $pResult['body']?></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    <?php }}?>
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


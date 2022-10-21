<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Post</h2>
                <?php 
                    if(isset($_GET['post_id']) && $_GET['post_id'] != NULL){
                        $postId= $_GET['post_id'];
                        
                    }
                ?>
                <?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $cat = mysqli_real_escape_string($db->link,$_POST['cat']);
                        $title = mysqli_real_escape_string($db->link,$_POST['title']);
                        $body = mysqli_real_escape_string($db->link,$_POST['body']);
                        $aurthor = mysqli_real_escape_string($db->link,$_POST['aurthor']);
                        $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_temp = $_FILES['image']['tmp_name'];
                    
                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "upload/".$unique_image;
                        if($cat=="" || $title==""|| $body==""|| $aurthor==""|| $tags=="" ){
                            echo "<span class='error'>Fields must not be empty!!
                            </span>";
                        }else{
                          if (!empty($file_name)) {
                            if ($file_size >1048567) {
                                echo "<span class='error'>Image Size should be less then 1MB!
                                </span>";
                                } elseif (in_array($file_ext, $permited) === false) {
                                echo "<span class='error'>You can upload only:-"
                                .implode(', ', $permited)."</span>";
                                } else{
                                    move_uploaded_file($file_temp, $uploaded_image);

                                    $query= "UPDATE tbl_post SET
                                       cat='$cat',
                                       title='$title',
                                       body='$body',
                                       aurthor='$aurthor',
                                       tags='$tags',
                                       image='$uploaded_image'
                                       WHERE id= '$postId';
                                    ";

                                    $updated_rows = $db->insert($query);

                                    if ($updated_rows) {
                                    echo "<span class='success'>Post updated Successfully.
                                    </span>";
                                    }
                                }
                        }else{
                                $query= "UPDATE tbl_post SET
                                cat='$cat',
                                title='$title',
                                body='$body',
                                aurthor='$aurthor',
                                tags='$tags'
                                WHERE id= '$postId';
                            ";

                            $updated_rows = $db->insert($query);

                            if ($updated_rows) {
                            echo "<span class='success'>Post updated Successfully.
                            </span>";
                            }
                        }
                        }}
                ?>
                <div class="block">               
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       <?php 
                            $query = "SELECT * FROM tbl_post WHERE id=$postId";
                            $data= $db->select($query);
                            if($data){ while($pResult= $data->fetch_assoc()){
                        ?>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" class="medium"  name="title"  value="<?php echo $pResult['title']?>"/>
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <?php 
                                      $query = "SELECT * FROM tbl_cat ";
                                      $data = $db->select($query);
                                     
                                      
                                      if($data){ while( $result = $data->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $result['id']?>" <?php if($result['id'] == $postId){ echo 'selected';}?>><?php echo $result['name']?></option>
                                    <?php }}?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img  class="medium" style="height: 70px; width:50px; border-radius:3px; margin-top:10px;" src="<?php echo $pResult['image']?>" alt="post image"/> <br>
                                <input type="file" class="medium" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Post Tags</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="tags" value="<?php echo $pResult['tags']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Post Author</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="aurthor" value="<?php echo $pResult['aurthor']?>"/>
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


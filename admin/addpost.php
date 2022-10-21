<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $cat = mysqli_real_escape_string($db->link,$_POST['cat']);
                        $title = mysqli_real_escape_string($db->link,$_POST['title']);
                        $date = mysqli_real_escape_string($db->link,$_POST['date']);
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
                        if($cat=="" || $title==""|| $date==""|| $body==""|| $aurthor==""|| $tags=="" ){
                            echo "<span class='error'>Fields must not be empty!!
                            </span>";
                        }
                        elseif (empty($file_name)) {
                        echo "<span class='error'>Please Select any Image !</span>";
                        }elseif ($file_size >1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!
                        </span>";
                        } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-"
                        .implode(', ', $permited)."</span>";
                        } else{
                        move_uploaded_file($file_temp, $uploaded_image);

                        $query = "INSERT INTO tbl_post(cat, title, body, aurthor, tags, date, image) 
                        VALUES('$cat','$title','$body','$aurthor','$tags','$date','$uploaded_image')";
                        $inserted_rows = $db->insert($query);

                        if ($inserted_rows) {
                        echo "<span class='success'>Post added Successfully.
                        </span>";
                        }else {
                        echo "<span class='error'>Page Not Inserted !</span>";
                        }
                        }
                    }
                ?>
                <div class="block">               
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Post Title..." class="medium"  name="title"/>
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Category</option>
                                    <?php 
                                      $query = "SELECT * FROM tbl_cat ";
                                      $data = $db->select($query);
                                     
                                      
                                      if($data){ while( $result = $data->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $result['id']?>"><?php echo $result['name']?></option>
                                    <?php }}else{?> <?php echo "<option>No Category</option>"?> <?php }?>
                                </select>
                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input type="date" id="date-picker" class="medium" name="date"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" class="medium" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Post Tags</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="tags" placeholder="Enter tags"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Post Author</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="aurthor" placeholder="Enter author name"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
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


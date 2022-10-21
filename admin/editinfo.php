<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Site Info</h2>
                <?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $title = mysqli_real_escape_string($db->link,$_POST['title']);
                        $slogan = mysqli_real_escape_string($db->link,$_POST['slogan']);
                        $facebook = mysqli_real_escape_string($db->link,$_POST['facebook']);
                        $tweeter = mysqli_real_escape_string($db->link,$_POST['tweeter']);
                        $youtube = mysqli_real_escape_string($db->link,$_POST['youtube']);
                        $linkedin = mysqli_real_escape_string($db->link,$_POST['linkedin']);
                        $copyright = mysqli_real_escape_string($db->link,$_POST['copyright']);
                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['logo']['name'];
                        $file_size = $_FILES['logo']['size'];
                        $file_temp = $_FILES['logo']['tmp_name'];
                    
                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "upload/logo/".$unique_image;
                        if($title=="" || $slogan==""|| $facebook==""|| $tweeter==""|| $linkedin==""|| $youtube=="" || $copyright==""){
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
  
                                      $query= "UPDATE tbl_info SET
                                         title='$title',
                                         slogan='$slogan',
                                         facebook='$facebook',
                                         tweeter='$tweeter',
                                         linkedin='$linkedin',
                                         youtube='$youtube',
                                         logo='$uploaded_image',
                                         copyright='$copyright'
                                         WHERE id= '1';
                                      ";
  
                                      $updated_rows = $db->insert($query);
  
                                      if ($updated_rows) {
                                      echo "<span class='success'>Post updated Successfully.
                                      </span>";
                                      }
                                  }
                          }else{
                                $query= "UPDATE tbl_info SET
                                title='$title',
                                slogan='$slogan',
                                facebook='$facebook',
                                tweeter='$tweeter',
                                linkedin='$linkedin',
                                youtube='$youtube',
                                copyright='$copyright'
                                WHERE id= '1';
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
                    <?php 
                      $query = "SELECT * FROM tbl_info WHERE id= '1'";
                      $data= $db->select($query);
                      if($data){ while($result = $data->fetch_assoc()){
                    ?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" class="medium"  name="title" value="<?php echo $result['title']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Slogan</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="slogan" value="<?php echo $result['slogan']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>
                            <img  class="medium" style="height: 50px; width:150px; border-radius:3px; margin-top:10px;" src="<?php echo $result['logo']?>" alt="post image"/> <br>
                                <input type="file" class="medium" name="logo"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Facebook Link</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="facebook" value="<?php echo $result['facebook']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tweeter Link</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="tweeter" value="<?php echo $result['tweeter']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="linkedin" value="<?php echo $result['linkedin']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Youtube</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="youtube" value="<?php echo $result['youtube']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Copyright Text</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="copyright"><?php echo $result['copyright']?></textarea>
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


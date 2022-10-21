<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Post</h2>
                <?php 
                    if(isset($_GET['user_id']) && $_GET['user_id'] != NULL){
                        $userId= $_GET['user_id'];
                        
                    }
                ?>
                <?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $name=$helper->validate($_POST['name']);
                        $email=$helper->validate($_POST['email']);
                        $role=$helper->validate($_POST['role']);
                        if(isset($_POST['password'])){
                            $pass=$helper->validate(md5($_POST['password']));
                            $pass = mysqli_real_escape_string($db->link,$pass);
                        }

                        $name = mysqli_real_escape_string($db->link,$name);
                        $email = mysqli_real_escape_string($db->link,$email);
                        $role = mysqli_real_escape_string($db->link,$role);

                        if(empty($name) || empty($email)|| empty($role) ){
                            echo "<span class='error'>Fields must not be empty!!
                            </span>";
                        }else{
                            $query= "UPDATE tbl_users SET
                                username ='$name',
                                email ='$email',
                                password ='$pass'
                                WHERE id= '$userId';
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
                            $query = "SELECT * FROM tbl_users WHERE id=$userId";
                            $data= $db->select($query);
                            if($data){ while($result= $data->fetch_assoc()){
                        ?>
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" class="medium"  name="name"  value="<?php echo $result['username']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" class="medium"  name="email"  value="<?php echo $result['email']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Role</label>
                            </td>
                            <td>
                                <select style="width: 50%;" id="select" name="role">
                                   <option <?php if($result['role']==1) echo "selected";?> value='1'>Admin</option>
                                   <option <?php if($result['role']==2) echo "selected";?> value='2'>Author</option>
                                   <option <?php if($result['role']==3) echo "selected";?> value='3'>Editor</option>";
                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="password" class="medium"  name="password"/>
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


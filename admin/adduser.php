<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
 if(!Session::getSession('user_role')==1){
    echo "<script>window.location='index.php';</script>";
 }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New User</h2>
                <?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $name=$helper->validate($_POST['name']);
                        $email=$helper->validate($_POST['email']);
                        $pass=$helper->validate(md5($_POST['password']));
                        $role=$helper->validate($_POST['role']);

                        $name = mysqli_real_escape_string($db->link,$name);
                        $email = mysqli_real_escape_string($db->link,$email);
                        $pass = mysqli_real_escape_string($db->link,$pass);
                        $role = mysqli_real_escape_string($db->link,$role);

                        $getEmail= "SELECT * FROM tbl_users WHERE email= '$email' limit 1";
                         $getData = $db->select($getEmail);
                        if(empty($name) || empty($email)|| empty($pass)|| empty($role) ){
                            echo "<span class='error'>Fields must not be empty!!
                            </span>";
                        }elseif($getData != false){
                            echo "<span class='error'>Email already exist!!
                            </span>";
                        }
                        else{
                            $query = "INSERT INTO tbl_users(username, email, role, password) 
                            VALUES('$name','$email','$role','$pass')";
                            $inserted_rows = $db->insert($query);

                            if ($inserted_rows) {
                            echo "<span class='success'>User added Successfully.
                            </span>";
                            }
                        }
                    }
                ?>
                <div class="block">               
                 <form action="" method="POST">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter User Name..." class="medium"  name="name"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" placeholder="Enter email" class="medium"  name="email"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Role</label>
                            </td>
                            <td>
                                <select style="width: 50%;" id="select" name="role">
                                    <option>Select user role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Author</option>
                                    <option value="3">Editor</option> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="password" class="medium" placeholder="Enter password" name="password"/>
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
        });
    </script>
    <?php include 'inc/footer.php';?>


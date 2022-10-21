<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Page</h2>
                <?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $name = mysqli_real_escape_string($db->link,$_POST['name']);
                        $title = mysqli_real_escape_string($db->link,$_POST['title']);
                        $body = mysqli_real_escape_string($db->link,$_POST['body']);
                        if($name=="" || $title==""|| $body=="" ){
                            echo "<span class='error'>Fields must not be empty!!
                            </span>";
                        }else{
                            $query = "INSERT INTO tbl_page(name, title, body) 
                            VALUES('$name','$title','$body')";
                            $inserted_rows = $db->insert($query);

                            if ($inserted_rows) {
                            echo "<span class='success'>Page added Successfully.
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
                                <input type="text" placeholder="Enter Page Name..." class="medium"  name="name"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Page Title..." class="medium"  name="title"/>
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
        });
    </script>
    <!-- /TinyMCE -->
    <style type="text/css">
		#tinymce{font-size:15px !important;}
    </style>
    <?php include 'inc/footer.php';?>


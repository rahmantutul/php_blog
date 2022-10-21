<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
  if(!isset($_GET['cat_id']) || $_GET['cat_id']==NULL){
    header("Location:catlist.php");
  }else{
    $id= $_GET['cat_id'];
  }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
        <div class="block copyblock">
        <?php 
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $name= $_POST['cat_name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if(empty($name)){
                echo "<span style='color:red'>Field should not be empty!</span>";
                }else{
                $query = "UPDATE tbl_cat SET name='$name' WHERE id='$id'";
                $success=$db->update($query);
                if($success){
                    echo "<span style='color:green'>Category Updated!</span>";
                }
                }
            }
        ?>
            <form action="" method="post">
                <table class="form">
                    <?php 
                        $query= "SELECT * FROM tbl_cat WHERE id='$id' ";
                        $data =$db->select($query);
                        $x=1;
                        if($data){ while($result= $data->fetch_assoc()){
                    ?>					
                    <tr>
                        <td>
                            <input type="text" name="cat_name" placeholder="Enter Category Name..." value="<?php echo $result['name'];?>" class="medium" />
                        </td>
                    </tr>
                    <?php }} ?>
                    <tr> 
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
<?php include 'inc/footer.php';?>


<?php include('inc/header.php')?>
<?php include('inc/sidebar.php')?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						  
						?>
					   <?php 
					     if(isset($_GET['del_cat']) && $_GET['del_cat'] !=NULL){
							$catID = $_GET['del_cat'];
							$query= "DELETE FROM tbl_cat WHERE id= '$catID'";
							$result =$db->delete($query);
							if($result){
								echo "<span style='color:green'>Category Deleted!</span>";
							}else{
								echo "<span style='color:green'>Category Not Deleted!</span>";
							}
						 }
						  $query= "select * from tbl_cat limit 6";
						  $data =$db->select($query);
						  $x=1;
						  if($data){ while($result= $data->fetch_assoc()){
						?>
						<tr class="odd gradeX">
							<td><?php echo $x++?></td>
							<td><?php echo $result['name'];?></td>
							<td><a href="editcat.php?cat_id=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure deleting this?')" href="?del_cat=<?php echo $result['id'];?>">Delete</a></td>
						</tr>
						<?php }} else{?>  <?php echo "<li>No category!</li>" ?>	<?php }?>				
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
            setSidebarHeight();
        });
    </script>
    <?php include('inc/footer.php')?>



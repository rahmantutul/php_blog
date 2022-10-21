<?php include('inc/header.php')?>
<?php include('inc/sidebar.php')?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
				<?php 
					if(isset($_GET['del_id']) && $_GET['del_id'] !=NULL){
					$ID = $_GET['del_id'];

					$query= "DELETE FROM tbl_post WHERE id= '$ID'";
					$result =$db->delete($query);
					if($result){
						echo "<span style='color:green'>User Deleted!</span>";
					}else{
						echo "<span style='color:green'>User Not Deleted!</span>";
					}
				}?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL NO:</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 

						 $query = "SELECT * FROM tbl_users";
						 $data= $db->select($query);
						 if($data){ $x=1; while($result= $data->fetch_assoc()){?>
						<tr class="odd gradeX">
							<td><?php echo $x++?></td>
							<td><?php echo $result['username']?></td>
							<td><?php echo $result['email'];?></td>
							<td> 
								<?php 
								  if($result['role']==1){
									echo "Admin";
								  }elseif($result['role']==2){
									echo "Author";
								  }else{
									echo "Editor";
								  }
								?>
							</td>
							<td><a href="edituser.php?user_id=<?php echo $result['id']?>">Edit</a> || 
							<a onclick="return confirm('Are you sure deleting this?')" href="?del_id=<?php echo $result['id']?>">Delete</a></td>
						</tr>
						<?php }}else{?> <?php echo "NO DATA FOUND"?> <?php }?>
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

<?php include('inc/header.php')?>
<?php include('inc/sidebar.php')?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
				<?php 
					if(isset($_GET['del_id']) && $_GET['del_id'] !=NULL){
					$ID = $_GET['del_id'];
					$Image= "SELECT * FROM tbl_post WHERE id= '$ID'";
					$rImage= $db->select($Image);
					if($rImage){while($delImage =$rImage->fetch_assoc()){
                        $getImage = $delImage['image'];
						unlink($getImage);
					}

					}
					$query= "DELETE FROM tbl_post WHERE id= '$ID'";
					$result =$db->delete($query);
					if($result){
						echo "<span style='color:green'>Post Deleted!</span>";
					}else{
						echo "<span style='color:green'>Post Not Deleted!</span>";
					}
				}?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL NO:</th>
							<th>Post Title</th>
							<th>Description</th>
							<th>Category</th>
							<th>Published</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 

						 $query = "SELECT * FROM tbl_post";
						 $data= $db->select($query);
						 if($data){ $x=1; while($result= $data->fetch_assoc()){?>
						<tr class="odd gradeX">
							<td><?php echo $x++?></td>
							<td><?php echo $result['title']?></td>
							<td><?php echo $helper->textFormate($result['body'],60);?></td>
							<td> 
								<?php
								  $catID =$result['cat'];
								  $catQuery = "SELECT * FROM tbl_cat WHERE id='$catID'";
								  $catData= $db->select($catQuery);
								  if($catData){ while($catResult =$catData->fetch_assoc()){
									 echo $catResult['name'];
								  }}
								?>
							</td>
							<td><?php echo $helper->dateFormate($result['date'])?></td>
							<td><img style="height: 40px; width:50px; border-radius:3px; margin-top:10px;" src="<?php echo $result['image']?>" alt="post image"/></td>
							
							<td><a href="editpost.php?post_id=<?php echo $result['id']?>">Edit</a> || 
							<a onclick="return confirm('Are you sure deleting this?')" href="postlist.php?del_id=<?php echo $result['id']?>">Delete</a></td>
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

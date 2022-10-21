<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php
				  if(isset($_GET['del_id']) && $_GET['del_id']!=NULL){
					$delId =$_GET['del_id'];
					$query= "DELETE FROM tbl_contact WHERE id='$delId'";
					$data= $db->delete($query);
					echo "<span style='color:green;'> Mesasge Deleted!</span>";
				  }
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$query = "SELECT * FROM tbl_contact WHERE status='1'";
						$data= $db->select($query);
						if($data){ $x=1; while($result= $data->fetch_assoc()){?>
						<tr class="odd gradeX">
							<td><?php echo $x++;?></td>
							<td><?php echo $result['firstname']. ' '.  $result['lastname'];?></td>
							<td><?php echo $result['email']?></td>
							<td><?php echo $helper->textFormate($result['body'],40)?></td>
							<td><a onclick="return confirm('Are you sure deleting this?')" href="?del_id=<?php echo $result['id'];?>">Delete</a></td>
						</tr>
					<?php }}?>
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

    <?php include 'inc/footer.php';?>

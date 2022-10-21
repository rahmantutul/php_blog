<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php 
				  if(isset($_GET['msg_id'])){
					 $mgsId =$_GET['msg_id'];
					 $query= "UPDATE tbl_contact SET
						status='1'
						WHERE id= '$mgsId';
					";

					$updated_rows = $db->update($query);

					if ($updated_rows) {
						echo "<span class='success'>Message sent to trash!.
						</span>";
					}
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
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$query = "SELECT * FROM tbl_contact WHERE status='0'";
						$data= $db->select($query);
						if($data){ $x=1; while($result= $data->fetch_assoc()){?>
						<tr class="odd gradeX">
							<td><?php echo $x++;?></td>
							<td><?php echo $result['firstname']. ' '.  $result['lastname'];?></td>
							<td><?php echo $result['email']?></td>
							<td><?php echo $helper->textFormate($result['body'],40)?></td>
							<td><?php  echo $helper->dateFormate($result['date'])?></td>
							<td><a href="viewmessage.php?msg_id=<?php echo $result['id'];?>">View</a> ||<a href="replymessage.php?msg_id=<?php echo $result['id'];?>">Reply</a>||<a href="?msg_id=<?php echo $result['id'];?>">Seen</a></td>
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

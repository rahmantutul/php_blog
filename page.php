<?php include 'inc/header.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		    <?php 
				if(isset($_GET['page_id']) && $_GET['page_id'] != NULL){
					$pageId= $_GET['page_id'];
				}
				$query = "SELECT * FROM tbl_page WHERE id=$pageId";
				$data= $db->select($query);
				if($data){ while($result= $data->fetch_assoc()){
			?>
			<div class="about">
				<h2><?php echo $result['name']?></h2>
				<h3 style="margin: 20px auto; "><?php echo $result['title']?></h3>
				<?php echo $result['body']?>
	        </div>
			<?php }}?>

		</div>
		
	<?php include 'inc/sidebar.php'; ?>
	</div>
	<?php include 'inc/footer.php'; ?>
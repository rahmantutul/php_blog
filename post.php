<?php include 'inc/header.php'; 

	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$query= "select * from tbl_post where id=$id";
		$data = $db->select($query);
	}else{
		header("Location:404.php");
	}
	
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php if($data){  while($result= $data->fetch_assoc()){?>
				<h2><?php echo $result['title']?></h2>
				<h4><?php echo $helper->dateFormate($result['date']) ?>, By <?php echo $result['title']?></h4>
				<img src="admin/<?php echo $result['image']?>" alt="MyImage"/>
				<?php echo $result['body'] ?>
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php 
					$catId= $result['cat'];
					 $rQuery ="select * from tbl_post where cat=$catId order by rand() limit 6";
					 $rData= $db->select($rQuery);
					 if($rData){ while($rResult= $rData->fetch_assoc()){
					?>
					 <a href="post.php?id=<?php echo $rResult['id']?>"><img src="admin/<?php echo $rResult['image']?>" alt="MyImage"/></a>
					<?php }}else{?> <?php echo "No Related posts found!";?> <?php }?>
				</div>
				<?php }?>
				<?php }else{?>  <?php header("Location:404.php"); }?>
	</div>

		</div>
	 <?php include 'inc/sidebar.php'; ?>
	</div>

	<?php include 'inc/footer.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<?php
  if(isset($_GET['cat_id'])){
	$id = $_GET['cat_id'];
	$query = "select * FROM tbl_post where cat=$id";
	$getData = $db->select($query);
  }else{
	header("Location:404.php");
  }
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">

	  <?php
	    if($getData){
		 while($result= $getData->fetch_assoc()){
	  ?>
		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result['id']?>"><?php echo $result['title']?></a></h2>
			<h4><?php echo $helper->dateFormate($result['date']) ?> <a href="#"><?php echo $result['aurthor']?></a></h4>
				<a href="#"><img src="admin/<?php echo $result['image']?>" alt="post image"/></a>
			<p>
			<?php echo $helper->textFormate($result['body']) ?>
			</p>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $result['id']?>">Read More</a>
			</div>
		</div>
		<?php } ?>
		<!-- End while loop  -->
		<?php }else{ header("Location:404.php"); }?>
		<!-- End If Else  -->
	</div>
	<?php include 'inc/sidebar.php'; ?>
</div>
<?php include 'inc/footer.php'; ?>

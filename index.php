<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<?php
  //Start  Pagination 
   $per_page =3;
   if(isset($_GET["page"])){
	  $page = $_GET["page"];
   }else{
	  $page = 1;
   }
   $start_from = ($page-1) * $per_page;
  // End Pagination 
  $query = "select * FROM tbl_post limit $start_from, $per_page";
  $getData = $db->select($query);
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
		<!-- Pgination  -->
        <?php 
		$query= "select * from tbl_post";
		$getData = $db->select($query);
		$count =mysqli_num_rows($getData);
		$total_page = ceil($count/$per_page);
		echo "<span class='pagination'> <a href='index.php?page=$total_page'>First Page</a>";
		for($i=1; $i<=$total_page; $i++){
			echo "<a href='index.php?page=$i'>$i</a>";
		}
		echo "<a href='index.php?page=$total_page'>Last Page</a></span>" ?>

		<!-- End pagination  -->
		<!-- End while loop  -->
		<?php }else{ header("Location:404.php"); }?>
		<!-- End If Else  -->
	</div>
	<?php include 'inc/sidebar.php'; ?>
</div>
<?php include 'inc/footer.php'; ?>

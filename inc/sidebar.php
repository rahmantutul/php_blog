<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Categories</h2>
			<ul>
				<?php 
					$query= "select * from tbl_cat limit 6";
					$data =$db->select($query);
					if($data){ while($result= $data->fetch_assoc()){
				?>
				<li><a href="posts.php?cat_id=<?php echo $result['id']?>"><?php echo $result['name'];?></a></li>
				<?php }} else{?>  <?php echo "<li>No category!</li>" ?>	<?php }?>				
			</ul>
	</div>
	<div class="samesidebar clear">
		<h2>Latest articles</h2>
		<?php 
			$query= "select * from tbl_post limit 5";
			$data =$db->select($query);
			if($data){ while($result= $data->fetch_assoc()){ ?>
			<div class="popular clear">
				<h3><a href="post.php?id=<?php echo $result['id']?>"><?php echo $result['title']?></a></h3>
				<a href="#"><img src="admin/<?php echo $result['image']?>" alt="post image"/></a>
				<?php echo $helper->textFormate($result['body'],130) ?>
			</div>
		<?php }} else{?>  <?php echo "<li>No Posts!</li>" ?>	<?php }?>
	</div>
</div>
<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <?php 
			$query = "SELECT * FROM tbl_info WHERE id= '1'";
			$data= $db->select($query);
			if($data){ while($result = $data->fetch_assoc()){
		?>
	   <?php echo $result['copyright']?>.
	</div>
	<div class="fixedicon clear">
		<a href="<?php echo $result['facebook']?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $result['tweeter']?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $result['linkedin']?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $result['youtube']?>"><img src="images/gl.png" alt="youtube"/></a>
	</div>
	<?php }}?>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>
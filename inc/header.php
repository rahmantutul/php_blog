<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helpers/Formate.php'; ?>
<?php 
  $db = New Database;
  $helper = New Formate;
?>
<!DOCTYPE html>
<html>
<head>
	<?php 
		if(isset($_GET['page_id'])){
			$pageId= $_GET['page_id'];
		
		$query = "SELECT * FROM tbl_page WHERE id='$pageId'";
		$data= $db->select($query);
		if($data){  while($result= $data->fetch_assoc()){?>
	    <title><?php echo $result['name']."-". TITLE;?></title>
	    <?php }}}else{?> <title><?php echo $helper->title().'-'. TITLE;?></title> <?php }?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Tutul">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
	    <?php 
			$query = "SELECT * FROM tbl_info WHERE id= '1'";
			$data= $db->select($query);
			if($data){ while($result = $data->fetch_assoc()){
		?>
		<a href="#">
			<div class="logo">
				<img src="admin/<?php echo $result['logo']?>" alt="Logo"/>
				<h2><?php echo $result['title']?></h2>
				<p><?php echo $result['slogan']?></p>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<a href="<?php echo $result['facebook']?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tweeter']?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['linkedin']?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['youtube']?>" target="_blank"><i class="fa fa-youtube"></i></a>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
		<?php }}?>
	</div>
<div class="navsection templete">
	<ul>
		<?php
		  $path = $_SERVER['SCRIPT_FILENAME'];
		  $title =basename($path, '.php');
		?>
		<li><a
		<?php 
		 if($title=='index'){
			echo "id='active'";
		  }
		?>
		 href="index.php">Home</a></li>
	    <?php 
			$query = "SELECT * FROM tbl_page";
			$data= $db->select($query);
			if($data){  while($result= $data->fetch_assoc()){?>
			<li><a 
			<?php
			if(isset($_GET['page_id'])){
			$pageId= $_GET['page_id'];
		
			 if($pageId==$result['id']){
				echo "id='active'";
			}}?>
			 
			href="page.php?page_id=<?php echo $result['id']?>"><?php echo $result['name']?></a></li>
		<?php }}?>
		<li><a
		<?php 
		 if($title=='contact'){
			echo "id='active'";
		  }
		?>
		 href="contact.php">Contact</a></li>
	</ul>
</div>
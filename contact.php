<?php include 'inc/header.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php 
                    if($_SERVER['REQUEST_METHOD']=="POST"){
                        $firstname=$helper->validate($_POST['firstname']);
                        $lastname=$helper->validate($_POST['lastname']);
                        $email=$helper->validate($_POST['email']);
                        $body=$helper->validate($_POST['body']);

                        $firstname = mysqli_real_escape_string($db->link,$_POST['firstname']);
                        $lastname = mysqli_real_escape_string($db->link,$_POST['lastname']);
                        $email = mysqli_real_escape_string($db->link,$_POST['email']);
                        $body = mysqli_real_escape_string($db->link,$_POST['body']);
                        if($firstname=="" || $lastname==""|| $body==""|| $email=="" ){
                            echo "<span class='error'>Fields must not be empty!!
                            </span>";
                        }else{
                            $query = "INSERT INTO tbl_contact(firstname, lastname,email, body) 
                            VALUES('$firstname','$lastname','$email','$body')";
                            $inserted_rows = $db->insert($query);

                            if ($inserted_rows) {
                            echo "<span style='color:green; text-align:center;'>Message Sent!.
                            </span>";
                            }
                        }
                    }
                ?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" required/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" required/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address" required/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
		
	<?php include 'inc/sidebar.php'; ?>
	</div>

	<?php include 'inc/footer.php'; ?>
<?php  
	include "includes/db.php";
	include "includes/header.php";
	include "includes/navigation.php"; 
	
	if (isset($_POST['submit'])) {
		$to = "axtell.stephen@gmail.com";

		// use wordwrap() if lines are longer than 70 characters
		$subject = escape(wordwrap($_POST['subject'], 70));
		$body = escape($_POST['body']);
		$header = "From: " . escape($_POST['email']);

		// send email
		mail($to, $subject, $body, $header);
	

	} else {
		$message = "";
	}
?>



<!-- Page Content -->
<div class="container">
    
	<section id="login">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3">
					<div class="form-wrap">
					<h1>Contact</h1>
						<form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
							<h6 class="text-center"><?php echo $message; ?></h6>
					
								<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
							</div>
       				<div class="form-group">
								<label for="subject" class="sr-only">Subject</label>
								<input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
							</div>
							<div class="form-group">
								<label for="body" class="sr-only">Body</label>
								<textarea name="body" id="body" cols="30" rows="15" class="form-control"></textarea>
							</div>
			
							<input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
						</form>
						
					</div>
				</div> <!-- /.col-xs-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section>
 	<hr>



	<?php include "includes/footer.php";?>

</div>

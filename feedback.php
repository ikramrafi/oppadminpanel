<?php require_once 'assets/php/header.php'; ?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-8 mt-3">
			<div class="card border-primary">
				<div class="card-header lead text-center bg-primary text-white">Send Feedback to Admin!
				</div>
			
			    <div class="card-body">
				    <form action="#" method="post" class="px-4" id="feedback-form">
					    <div class="form-group">
						    <input type="text" name="subject" placeholder="Write Your Subject" class="form-control form-control-lg rounded-0" required>
					    </div>
					    <div class="form-group">
						    <textarea name="feedback" class="form-control-lg form-control rounded-0" placeholder="Write Your Feedback Here..." rows="8" required></textarea>
					    </div>
					    <div class="form-group">
						    <input type="submit" name="feedbackBtn" id="feedbackBtn" value="Send Feedback" class="btn btn-primary btn-block btn-lg rounded-0">
					    </div>
				    </form>
			    </div>
		    </div>
	    </div>
	</div>
</div>


<?php require_once 'assets/php/footer.php'; ?>

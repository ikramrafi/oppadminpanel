<?php require_once 'assets/php/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-lg-12 mt-5">
			<!-- <?php //if($verified == 'Not Verified!'): ?>
				<div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Your email is not verified! We've sent you an email verification link on your E-mail, check & verify now!</strong>
				</div>
			<?php// endif; ?> -->
			<h4 class="text-center text-primary mt-2">Write Your Notes Here & Access Anytime Anywhere!</h4>
		</div>
	</div>
	<div class="card border-primary">
		<h5 class="card-header bg-primary d-flex justify-content-between">
			<span class="text-light lead align-self-center">All Notes</span>
			<a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add New Note</a>
		</h5>
		<div class="card-body">
			<div class="table responsive" id="showNote">
				<p class="text-center lead mt-5">Please Wait...s</p>
			</div>
        </div>
    </div>
</div>


<!-- Start Add New Note Modal -->
<div class="modal fade" id="addNoteModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h4 class="modal-title text-light">Add New Note</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
			</div>  
			<div class="modal-body">
				<form action="#" method="post" id="add-note-form" class="px-3">
					<div class="form-group">
						<input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
					</div>
					<div class="form-group">
						<textarea name="note" class="form-control form-control-lg" placeholder="Write Your Note Here..." rows="6" required></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="addNote" id="addNoteBtn" class="btn btn-success btn-block btn-lg" value="Add Note">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Add New Note Modal -->

<!-- Start Edit  Note Modal -->
<div class="modal fade" id="editNoteModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title text-light">Edit Note</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
			</div>  
			<div class="modal-body">
				<form action="#" method="post" id="edit-note-form" class="px-3">
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" required>
					</div>
					<div class="form-group">
						<textarea name="note" id="note" class="form-control form-control-lg" placeholder="Write Your Note Here..." rows="6" required></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="editNote" id="editNoteBtn" class="btn btn-info btn-block btn-lg" value="Update Note">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Edit New Note Modal -->


<?php require_once 'assets/php/footer.php'; ?>
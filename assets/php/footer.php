<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js" integrity="sha512-UwcC/iaz5ziHX7V6LjSKaXgCuRRqbTp1QHpbOJ4l1nw2/boCfZ2KlFIqBUA/uRVF0onbREnY9do8rM/uT/ilqw==" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$(document).ready(function(){
		$("#register-link").click(function(){
			$("#login-box").hide();
			$("#register-box").show();
		});

		$("#login-link").click(function(){
			$("#register-box").hide();
			$("#login-box").show();		
		});

		$("#forgot-link").click(function(){
			$("#login-box").hide();
			$("#forgot-box").show();		
		});

		$("#back-link").click(function(){
			$("#login-box").show();
			$("#forgot-box").hide();		
		});

		//Register Ajax Request
		$("#register-btn").click(function(e){
			if ($("#register-form")[0].checkValidity()){
				e.preventDefault();
				
				$("#register-btn").val('Please Wait...');
				window.location = 'home.php';

				//Check Password and Confirm Password match or not
				if($("#rpassword").val() != $("#cpassword").val()) {
					$("#passError").text('* Password did not matched!');
					$("#register-btn").val('Sign Up');
				}
				else{
					$("#passError").text('');
					
					$.ajax({

						url: 'assets/php/action.php',
						method: 'post',
						data: $("#register-form").serialize()+'&action=register',
						succes: function(response){
							$("#register-btn").val('Sign Up');
							
							if (response === 'register') {
								
								window.location = 'home.php';
							}
							else{
								$("#regAlert").html(response);
							}
						}
					});
				}
			}
		});

		//Login Ajax Request
		$("#login-btn").click(function(e){
			//Validate login form
			if ($("#login-form")[0].checkValidity()){
				e.preventDefault();

				$("#login-btn").val('Please Wait...');
				window.location = 'home.php';
				$.ajax({
					url: 'assets/php/action.php',
					method: 'post',
					data: $("#login-form").serialize()+'&action=login',
					succes: function(response){
						
						$("#login-btn").val('Sign In');
						window.location = 'home.php';
							
						if (response === 'login') {
								
							window.location = 'home.php';
						}
						else{
							$("#loginAlert").html(response);
						}
					}
				});
			}
		});

		//Forgot Passord Ajax Request
		$("#forgot-btn").click(function(e){
			//Validate login form
			if ($("#forgot-form")[0].checkValidity()){
				e.preventDefault();

				$("#forgot-btn").val('Please Wait...');
				$.ajax({
					url: 'assets/php/action.php',
					method: 'post',
					data: $("#forgot-form").serialize()+'&action=forgot',
					succes: function(response){
						
						$("#forgot-btn").val('Reset Password');
						$("#forgot-form")[0].reset();
						$("#forgotAlert").html(response);
					}
				});
			}
		});

	});
		
		//Add New Note Ajax Request
		$("#addNoteBtn").click(function(e){
			if ($("#add-note-form")[0].checkValidity()) {
				e.preventDefault(); 
				$("#addNoteBtn").val("Please Wait...");
				$.ajax({
					url: 'assets/php/process.php', 
					method: 'post',
					data: $("#add-note-form").serialize()+'&action=add_note',
					success: function(response){
						$("#addNoteBtn").val("Add Note");
						$("#add-note-form")[0].reset();
						$("#addNoteModal").modal('hide');
						swal.fire({
							title: 'Note Added Successfully!',
							type: 'success'
						});
						displayAllNotes();
					}
				});
			}
		});

		//Edit note of an User Ajax Request
		$("body").on("click", ".editBtn", function(e){
			e.preventDefault();
			edit_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				// dataType: 'json',
				data: { edit_id: edit_id },
				success:function(response){
					data = JSON.parse(response);
					$("#id").val(data.id);
					$("#title").val(data.title);
					$("#note").val(data.note);
				}
			});
		});

		//Update Note of an User Ajax Request
		$("#editNoteBtn").click(function(e){
			if ($("#edit-note-form")[0].checkValidity()){
				e.preventDefault();
				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: $("#edit-note-form").serialize()+"&action=update_note",
					success:function(response){
						$("#edit-note-form")[0].reset();
						$("#editNoteModal").modal('hide');
						swal.fire({
							title: 'Note Updated Successfully!',
							type: 'success'
						});
						
						displayAllNotes();
					}
				})
			}
		});

		//Delete a Note of an User Ajax Request
		$("body").on("click", ".deleteBtn", function(e){
			e.preventDefault();
			del_id = $(this).attr('id');
			Swal.fire({
				title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            	if (result.value) {
            		$.ajax({
				        url: 'assets/php/process.php',
				        method: 'post',
				        data: { del_id: del_id },
				        success:function(response){
					        Swal.fire(
            			        'Deleted!',
                                'Note deleted Successfully!',
                                'success'
                            )
                            displayAllNotes();
				        }
			        });		
            	}
            })	
		});

		//Display Note of an User Ajax Request
		$("body").on("click", ".infoBtn", function(e){
			e.preventDefault();
			info_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { info_id: info_id },
				success:function(response){
					data = JSON.parse(response);
					swal.fire({
						title: '<strong>Note : ID('+data.id+')</strong>',
						type: 'info',
						html: '<b>Title : </b>'+data.title+'<br><br><b>Note : </b>'+data.note+'<br><br><b>Written on : </b>'+data.created_at+'<br><br><b>Updated on : </b>'+data.updated_at,
						showCloseButton: true,
					});
					$("#id").val(data.id);
					$("#title").val(data.title);
					$("#note").val(data.note);
				}
			});
		});

        displayAllNotes();

		//Display all notes of an user
		function displayAllNotes(){
			$.ajax({
				url: 'assets/php/process.php', 
				method: 'post',
				data: { action: 'display_notes' },
				success: function(response){
					$("#showNote").html(response);
					$("table").DataTable({
						order: [0, 'desc']
					});
				}
			}); 
		}

	    //Profile Update Ajax Request
	    $("#profile-update-form").submit(function(e){
		    e.preventDefault();

		    $.ajax({
			    url: 'assets/php/process.php',
			    method: 'post',
			    processData: false,
			    contentType: false,
			    cache: false,
			    data: new FormData(this),
			    success: function(response){
				    location.reload();
			    }
		    });
	    });

	    //Change Password Ajax Request
	    $("#changePassBtn").click(function(e){
		    if($("#change-pass-form")[0].checkValidity()){
			    e.preventDefault();
			    $("#changePassBtn").val('Please Wait...');

			    if ( $("#newpass").val() != $("#cnewpass").val() ) {
				    $("#changepassError").text('* Password did not matched!');
				    $("#changePassBtn").val('Change Password');
			    }
			    else{
				    $.ajax({
					    url: 'assets/php/process.php',
					    method: 'post',
					    data: $("#change-pass-form").serialize()+'&action=change_pass',
					    success: function(response){
						    $("#changepassAlert").html(response);
						    $("#changePassBtn").val('Change Password');
						    $("#changepassError").text('');
						    $("#change-pass-form")[0].reset();
					    }
				    });
			    }
		    }
	    });

	    //Verify Email Ajax Request
	    $("#verify-email").click(function(e){
	    	e.preventDefault();
	    	$(this).text('Please Wait...');
	    	$.ajax({
	    		url: 'assets/php/process.php',
	    		method: 'post',
	    		data: { action: 'verify-email' },
	    		success: function(response){
	    			$("#verifyEmailAlert").html(response);
	    			$("#verify-email").text('Verify Now');
	    		}
	    	});
	    });

	    //Send Feedback to Admin Ajax Request
	    $("#feedbackBtn").click(function(e){
	    	if ($("#feedback-form")[0].checkValidity()) {
	    		e.preventDefault();
	    		$(this).val('Please Wait...');

	    		$.ajax({
	    			url: 'assets/php/process.php',
	    			method: 'post',
	    			data: $("#feedback-form").serialize()+'&action=feedback',
	    			success: function(response){
	    				$("#feedback-form")[0].reset();
	    				$("#feedbackBtn").val('Send Feedback');
	    				swal.fire({
	    					title: 'Feedback Successfully Send to Admin!',
	    					type: 'success'
	    				});
	    			}

	    		});
	    	}
	    });

	    // Fetch Notification of user
	    fetchNotification();
	    function fetchNotification(){
	    	$.ajax({
				url: 'assets/php/process.php', 
				method: 'post',
				data: { action: 'fetchNotification' },
				success: function(response){
					$("#showAllNotification").html(response);
				}
			}); 
	    }

	    // Check Nptification
	    checkNotification(); 
	    function checkNotification(){
	    	$.ajax({
				url: 'assets/php/process.php', 
				method: 'post',
				data: { action: 'checkNotification' },
				success: function(response){
					$("#checkNotification").html(response);
				}
			}); 
	    }

	    // Remove Notificatio
	    $("body").on("click", ".close", function(e){
	    	e.preventDefault();

	    	notification_id = $(this).attr('id');
	    	$.ajax({
				url: 'assets/php/process.php', 
				method: 'post',
				data: { notification_id: notification_id },
				success: function(response){
					checkNotification();
					fetchNotification();
				}
			}); 

	    });

	    // Checking user Logged in or not
	    $.ajax({
			url: 'assets/php/process.php', 
			method: 'post',
			data: { action: 'checkUser' },
			success: function(response){
				if (response === 'bye') {
					window.location = 'index.php';
				}
			}
		});

	});
</script>
</body>
</html>

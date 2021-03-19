<?php require_once 'assets/php/admin-header.php'; ?>

<div class="row">
	<div class="col-lg-12">
		<div class="card my-2 border-danger">
			<div class="card-header bg-danger text-white">
				<h4 class="m-0">Total Deleted Users</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive" id="showAllDeletedUsers">
					<p class="text-center align-self-center Lead">Please Wait...</p>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Footer Area -->
</div>
</div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        
        //Fetch all Deleted Users Ajax Request
        fetchAllDeletedUsers();
        function fetchAllDeletedUsers(){ 
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: { action: 'fetchAllDeletedUsers'},
                success: function(response){
                    $("#showAllDeletedUsers").html(response);
                    $("table").DataTable({
                    	order: [0, 'desc']
                    });
                }
            });
        }

        // Restore Delete User Details Ajax Request
        $("body").on("click", ".restoreUserIcon", function(e){
			e.preventDefault();
			res_id = $(this).attr('id');
			Swal.fire({
				title: 'Are you sure want to restore this user?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
            	if (result.value) {
            		$.ajax({
				        url: 'assets/php/admin-action.php',
				        method: 'post',
				        data: { res_id: res_id },
				        success:function(response){
					        Swal.fire(
            			        'Restored!',
                                'User Restored Successfully!',
                                'success'
                            )
                            fetchAllDeletedUsers();
				        }
			        });		
            	}
            })	
		});

        // Check Notification
        checkNotification();
        function checkNotification(){
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: { action: 'checkNotification' },
                success: function(response){
                    
                    $("#checkNotification").html(response);
                }
            });

        }
    });
    
</script>
</body>
</html>
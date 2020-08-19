$(document).ready(function(){
	/* When click add user */
	$("body").on("click", "#user_add", function () {
		$("#addNewUser").text("Add User");
		$("#user_name").focus();
		$("#btn_save").text("Add User");
		$("#validationform").trigger('reset');
	});

	/* When click edit user */
	$("body").on("click", ".edit_user", function () {
		var user_id = $(this).data("id");
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			method:'get',
			url: $("meta[name='url']").attr("content") + "/dashboard/users/"+user_id,
			data: {
				id: user_id,
			},
			dataType: "json",
			success: function (res) {
                // console.log(res);
				if (res !== '') {
					
					$("#addNewUser").text("Edit User");
					$("#btn_save").text("Update User");
					// $("#btn-save").html("Update Blog");
					$("#user_name").val(res.name);
					$("#user_email").val(res.email);
					$("#user_password").val(res.password);
					$("#user_password_confirm").val(res.password);
                    $("#roll_id").val(res.roll_id);
                    $("#user_id").val(res.id);

					
					var picture =
						$("meta[name='url']").attr("content") +
						"/storage/users/" +
						res.picture;
					$("#user_preview").html(
						'<img src="' + picture + '" width="100" height="100"/>'
                    );
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_user", function () {
		
		var user_id = $(this).data("id");
		var this_button = $(this);
		
		if (confirm("Are You sure want to delete !")) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
			
				method: 'DELETE',
				url: $("meta[name='url']").attr("content") + "/dashboard/users/"+user_id,
				data: {
					id: user_id,
				},
				dataType: "json",
				success: function (res) {
					if(res.status==1){
						this_button.parent().parent().remove()
						$('.alert-success').css('display', 'block');
						$('.alert-success').text(res.message)
						setInterval(() => {
							
							document.querySelector('.alert-success').style.display= 'none';
						}, 7000);
					}else{
						alert(res.message)
					}
					
				},
				error: function (data) {
					console.log("Error:", data);
				},
			});
		}
    });
    

    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#user_preview").html(
                    '<img src="' + e.target.result + '" width="100" height="100"/>'
                );
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#user_picture").change(function () {
        filePreview(this);
	});


	

})
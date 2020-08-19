$(document).ready(function(){
    
    

    $("body").on("change", "#category_id", function () {
		
        var category_id = $(this).val();
        var html = '';
        $("#sub_category_id").html('');
		
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				method: 'GET',
				url: $("meta[name='url']").attr("content") + "/dashboard/products/"+category_id+"/subcategory",
				data: {
					id: category_id,
				},
				dataType: "json",
				success: function (res) {
                    

                    for(var i =0 ; i<res.length; i++){
                        html += `<option value="${res[i].id}">${res[i].sub_category_name}</option>`
                    }
					$("#sub_category_id").append(html);
					
				},
				error: function (data) {
					console.log("Error:", data);
				},
			});
		
    });



   

    // Edit category id
    $("body").on("change", "#edit_category_id", function () {
		
        var category_id = $(this).val();
        var html = '';
        $("#edit_sub_category_id").html('');

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				method: 'GET',
				url: $("meta[name='url']").attr("content") + "/dashboard/products/"+category_id+"/subcategory",
				data: {
					id: category_id,
				},
				dataType: "json",
				success: function (res) {
                    

                    for(var i =0 ; i<res.length; i++){
                        html += `<option value="${res[i].id}">${res[i].sub_category_name}</option>`
                    }
					$("#edit_sub_category_id").append(html);
					
				},
				error: function (data) {
					console.log("Error:", data);
				},
			});
		
    });

    $("body").on("click", ".edit_product", function () {
       
        $("#editProductForm").trigger('reset')
		var product_id = $(this).data("id");
		
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/products/"+product_id,
			data: {
				id: product_id,
			},
			dataType: "json",
			success: function (res) {
				$("#edit_name").val(res.name);
				$("#edit_detail").val(res.detail);
				$("#edit_category_id").val(res.category_id);
				$("#edit_sub_category_id").val(res.sub_category_id);
				$("#edit_size_id").val(res.size_id);
				$("#edit_color_id").val(res.color_id);
				$("#edit_unit_id").val(res.unit_id);
				$("#edit_brand_id").val(res.brand_id);
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});

    });

    $( '#editProductForm' ).on( 'submit', function(e) {
    e.preventDefault();
      var product_id =   $("#edit_product_id").val()
      console.log(product_id)
      var value =   $("#editProductForm").serializeArray();
        
        
        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			method:'PUT',
			url: $("meta[name='url']").attr("content") + "/dashboard/products/"+product_id,
			// data: {
			// 	data: value,
			// },
			dataType: "json",
			success: function (res) {
                console.log(res);
				// if (res !== '') {
				// 	$("#addproduct").text("Edit Store");
				// 	$("#btn_save").text("Update Store");
				// 	$("#date").val(res.purchase.date);
				// 	$("#reference_no").val(res.purchase.reference_no);
				// 	$("#parchase_rate").val(res.purchaseDetail.parchase_rate);
				// 	$("#quantity").val(res.purchaseDetail.quantity);
                //     $("#product_id").val(res.purchaseDetail.product_id);
				// 	$("#product_id").val(res.purchaseDetail.id);
				// 	$("#purchase_id").val(res.purchaseDetail.purchase_id);

				// }
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
	});
	/////////////////////////////////////////////////////////
    // Delete Product
	/////////////////////////////////////////////////////////
	$("body").on("click", ".delete_product", function () {
		
		var product_id = $(this).data("id");
        var this_button = $(this);
        var alertBtn = $('.alert-success');
        sessionStorage.clear();
        localStorage.clear()
		
		if (confirm("Are You sure want to delete !")) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
			
				method: 'DELETE',
				url: $("meta[name='url']").attr("content") + "/dashboard/products/"+product_id,
				data: {
					id: product_id,
				},
				dataType: "json",
				success: function (res) {
					console.log(res);
					if(res.status==1){
						this_button.parent().parent().remove()
						alertBtn.css('display', 'block');
						alertBtn.text(res.message)
						setInterval(() => {
							alertBtn.css('display', 'none');
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
    
   
    /////////////////////////////////////////////////////////
    // image preview and drag
    /////////////////////////////////////////////////////////

    $('body').on('click', '#remove_image', function(){
		$('#image_preview li').remove();
		document.getElementById("upload_file").value="";
    })

    $('body').on('click', '#edit_remove_image', function(){
		$('#edit_image_preview li').remove();
		document.getElementById("edit_upload_file").value="";
    })

        var dropIndex;
        $("#image_preview").sortable({
            	update: function(event, ui) { 
            		dropIndex = ui.item.index();
            }
        });
        var dropImage;
        $("#edit_image_preview").sortable({
            update: function(event, ui) { 
                dropImage = ui.item.index();
        }
    });

    
    
})
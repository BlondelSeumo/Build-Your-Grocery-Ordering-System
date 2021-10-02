var base_url = $('#base-url').val();
var auth_role = $('#auth_role').val();

$(document).ready(function () {

   

    jQuery(document).on("click",".demo-button", function () {
            // alert('hello');
            Swal.fire({
                type: 'info',
                title: 'Sorry!',
                text: 'For security reason you can not use this functionality in demo version.',
                timer: 2000,
                showConfirmButton: false,
            })
    });

    $('#input-detail_desc').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link','picture']],
            ['view', [ 'codeview', 'help']]
        ],
        height: 200,
    });

    $('#add-template-form .textarea_editor').wysihtml5({ "color": true });
    $('#edit-template-form .textarea_editor').wysihtml5({ "color": true });
    var url = window.location.origin+window.location.pathname;

    if(url == base_url+'/NotificationTemplate'){

         $('#edit-template-form .textarea_editor').data("wysihtml5").editor.setValue($('#content-data').val());
    }

    jQuery(document).on("click",".dropdown .open-assign-driver", function () {
        $(".modal-body #driver_id").val( $(this).data('id') );

    });

    // $('#edit-template-form .textarea_editor').data("wysihtml5").editor.setValue($('#content-data').val());

    $(".select2").select2();
    var shop_category =$('#shop_category').val();
    if(shop_category){
        shop_category = shop_category.split(',');
        $('#edit-groceyshop select[name="category_id[]"] option').attr("selected",false);
        for (let i = 0; i < shop_category.length; i++) {
          $('#edit-groceyshop select[name="category_id[]"] option[value='+shop_category[i]+']').attr("selected",true);
          $('#edit-groceyshop select[name="category_id[]"] option[value='+shop_category[i]+']').trigger('change')
        }
    }
    
    $('#reports').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fas fa-download"></i>Export to PDF',
                extend: 'pdf',
                orientation: 'landscape',
                // pageSize: 'LEGAL'
            }
        ]
      });

    $('#coupon_start_date').flatpickr({
        // minDate: "today",
        mode:"range",
    });

    $('#dateOfBirth').flatpickr({
        maxDate: "today",       
    });

    $(".changeGroceryOrderStatus select[name='order_status']").on('change', function (e) {
        
        var app_id = jQuery(this).attr('id').split('-')[1];        
        var value = this.value;
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'changeGroceryOrderStatus',
            data:{
            id:app_id,
            status:value,
            },
            success: function(result){
            var con = "#order-"+result.data.id;
            if(result.success==true) {
                if (result.data.order_status == "Cancel" || result.data.order_status == "Completed") {
                    $(con).prop("disabled", true);
                } else {
                window.location.reload();
                }
                Swal.fire({
                    type: 'success',
                    title: 'Order Status changed successfully.',
                    timer: 1500,
                    showConfirmButton: false,
                })
            }
            else{
                Swal.fire({
                    type: 'info',
                    text: 'Payment is not completed!',
                })
            }
            },
            error: function(err){
            console.log('err ',err)
            }
        });
    });

    
    $(".changeGroceryOrderPaymentStatus select[name='order_payment_status']").on('change', function (e) {
        var app_id = jQuery(this).attr('id').split('-')[1];        
        var value = this.value;
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'changeGroceryOrderPaymentStatus',
            data:{
            id:app_id,
            status:value,
            },
            success: function(result){
            var con = "#order1-"+result.data;
            $(con).prop("disabled", true);
            Swal.fire({
                type: 'success',
                title: 'Order Payment Status changed successfully.',
                timer: 1500,
                showConfirmButton: false,
            })
            },
            error: function(err){
            console.log('err ',err)
            }
        });
    });

    // 1234

    $('#period_day').flatpickr({
        dateFormat: "Y-m-d",
    });

    $('#period_week').flatpickr({
    dateFormat: "Y-m-d",
    weekNumbers: true,
    });

    $('#reportPeriod').change(function() {

        $('.filterPeriod input,.filterPeriod select').hide();
        if($(this).val()=="day"){
          $('#period_day').show();
          $('.filterPeriod .select2').css('display','none');
        }
        else if($(this).val()=="month"){
          $('#period_month').show();
          $('.filterPeriod .select2').css('display','block');
        }
        else if($(this).val()=="year"){
          $('#period_year').val(new Date().getFullYear());
          $('#period_year').show();
          $('.filterPeriod .select2').css('display','none');
        }
        else if($(this).val()=="week"){
          $('#period_week').show();
          $('.filterPeriod .select2').css('display','none');
        }

      });

    // $(".assignOrder select[name='employee_id']").on('change', function (e) {
    //     var app_id = jQuery(this).attr('id').split('-')[1];
    //     var value = this.value;
    //     $.ajax({
    //         headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type:"POST",
    //         url:'assignOrder',
    //         data:{
    //         id:app_id,
    //         deliveryBoy:value,
    //         },
    //         success: function(result){
    //             console.log('result ',result)
    //             if(result.success==true){
    //                 $.notify({
    //                     title: '<strong>Success</strong>',
    //                     icon: 'fas fa-thumbs-up',
    //                     message:  '<br>DeliveryBoy assign to order successfully!'
    //                     },{
    //                     element: 'body',
    //                     type: 'default',
    //                     allow_dismiss: true,
    //                     animate: {
    //                         enter: 'animated fadeInUp',
    //                         exit: 'animated fadeOutRight'
    //                     },
    //                     placement: {
    //                         from: "bottom",
    //                         align: "center"
    //                     },
    //                     offset: 20,
    //                     spacing: 10,
    //                     z_index: 1031,

    //                 });
    //                 setTimeout(() => {
    //                     window.location.reload();
    //                 }, 800);
    //             }
    //         },
    //         error: function(err){
    //             console.log('err ',err)
    //         }
    //     });
    // });

    $('#add-coupon-form input[type=radio][name=type]').change(function() {

        if(this.value=='percentage'){
            $('#coupon_type_label').html(' (In Percentage)');
        }
        else if(this.value=='amount'){
            $('#coupon_type_label').html(' (In Amount)');
        }
    });

    $("#company-setting-form input[name='favicon']").on('change', function (e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#setting-favicon').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    $("#company-setting-form input[name='logo']").on('change', function (e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#setting-logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    $("#company-setting-form input[name='logo_dark']").on('change', function (e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#setting-logo_dark').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    $("#company-setting-form input[name='responsive_logo']").on('change', function (e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#setting-responsive_logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $(".languages .language-status").on('change', function (e) {
        if ($(this).is(':checked')) { var value = 1; }
        else{ var value = 0; }
        var lang_id = jQuery(this).attr('id').split('-')[1];

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'changelangStatus',
            data:{
            id:lang_id,
            status:value,
            },
            success: function(result){
            console.log('result ',result)
            $.notify({
                title: '<strong>Success</strong>',
                icon: 'fas fa-thumbs-up',
                message:  '<br>Status is changed successfully'
             },{
                element: 'body',
                type: 'default',
                allow_dismiss: true,
                animate: {
                    enter: 'animated fadeInUp',
                    exit: 'animated fadeOutRight'
                },
                placement: {
                    from: "bottom",
                    align: "center"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,

            });
            },
            error: function(err){
            console.log('err ',err)
            }
        });

    });


    $(".read-image").on('change', function (e) {        
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.view-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $(".read-cover-image").on('change', function (e) {        
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.view-cover-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $(".changePaymentStatus select[name='payment_status']").on('change', function (e) {
        var app_id = jQuery(this).attr('id').split('-')[1];
        var value = this.value;
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'changePaymentStatus',
            data:{
            id:app_id,
            status:value,
            },
            success: function(result){
            console.log('result ',result)
            // if(result.success==true){
            //     Swal.fire({
            //         type: 'success',
            //         title: 'Order Status changed successfully.',
            //         timer: 1500,
            //         showConfirmButton: false,
            //     })
            // }
            // else{
            //     Swal.fire({
            //         type: 'info',
            //         text: 'Payment is not completed!',
            //     })
            // }
            },
            error: function(err){
            console.log('err ',err)
            }
        });
    });

    // if(auth_role==1){
    //     if(base_url == window.location.origin()+'/home'){
    //     alert('sf');
    //     }
    //     setInterval(function() {
            
    //             $.ajax({
    //                 headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 type:"GET",
    //                 url:base_url+'/getPendingOrder',
    //                 success: function(result){
    //                     console.log('result ',result.data.length)
    //                     if(result.data.length==0){
    //                         $('#pending-order').html('<div class="empty-state text-center pb-3"><img src="'+base_url+'/images/empty3.png" style="width:30%;height:200px;"> <h2 class="pt-3 mb-0" style="font-size:25px;">Nothing!!</h2> <p style="font-weight:600;">Your Collection list is empty....</p></div>');
    //                     }
    //                     else{
    //                         $('#pending-order').html('<table class="table align-items-center table-flush"><thead class="thead-light"> <tr> <th scope="col">Order ID</th><th scope="col">Shop</th><th scope="col">Customer</th> <th scope="col">payment</th><th scope="col">date</th> <th scope="col">Payment GateWay</th><th scope="col">Action</th></tr> </thead><tbody></tbody></table>');
    //                         result.data.forEach(element => {
    //                             $('#pending-order tbody').append('<tr><td><span class="badge label label-light-warning">'+element.order_no+'</span></td><td>'+element.shop.name+'</td><td>'+element.customer.name+'</td><td>'+result.currency+element.payment+'.00</td> <td>'+element.date+' | '+element.time+'</td><td>'+element.payment_type+'</td>   <td><a href="'+base_url+'/accept-order/'+element.id+'" class="table-action" data-toggle="tooltip" data-original-title="Accept Order"> <i class="fas fa-check-square text-success"></i> </a><a href="'+base_url+'/reject-order/'+element.id+'" class="table-action" data-toggle="tooltip" data-original-title="Reject Order"><i class="fas fa-window-close text-danger"></i> </a><a href="'+base_url+'/viewOrder/'+element.id+'/'+element.order_no+'" class="table-action" data-toggle="tooltip" data-original-title="View Order"><i class="fas fa-eye"></i></a></td></tr>');
    //                         });
    //                     }
    //                 },
    //                 error: function(err){
    //                 console.log('err ',err)
    //                 }
    //             });
    //     }, 10000);
    // }

    $(".grocery-item select[name='shop_id']").on('change', function (e) {
        var value = this.value;
        if(value==""){
            $('.grocery-item select[name="category_id"]').html('<option value="">Select Category</option>');
        }
        else{
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"GET",
                url:base_url+'/shopCategory/'+value,           
                success: function(result){
                console.log('result ',result)
                $('.grocery-item select[name="category_id"]').html('<option value="">Select Category</option>'); 
                result.data.forEach(element => {
                    $('.grocery-item select[name="category_id"]').append('<option value="'+element.id+'">'+element.name+'</option>');
                });
                },
                error: function(err){
                console.log('err ',err)
                }
            });
        }
    });
    
    $(".grocery_subcategory select[name='shop_id']").on('change', function (e) {
        var value = this.value;
        if(value==""){
            $('.grocery_subcategory select[name="category_id"]').html('<option value="">Select Category</option>');
        }
        else{
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"GET",
                url:base_url+'/shopCategory/'+value,           
                success: function(result){
                console.log('result ',result)
                $('.grocery_subcategory select[name="category_id"]').html('<option value="">Select Category</option>'); 
                result.data.forEach(element => {
                    $('.grocery_subcategory select[name="category_id"]').append('<option value="'+element.id+'">'+element.name+'</option>');
                });
                },
                error: function(err){
                console.log('err ',err)
                }
            });
        }
    });

    $(".grocery-item select[name='category_id']").on('change', function (e) {
        var value = this.value;
      
        if(value==""){
            $('.grocery-item select[name="subcategory_id"]').html('<option value="">Select Subcategory</option>');
        }
        else{
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"GET",
                url:base_url+'/itemSubcategory/'+value,           
                success: function(result){
                console.log('result ',result)
                $('.grocery-item select[name="subcategory_id"]').html('<option value="">Select Subcategory</option>'); 
                result.data.forEach(element => {
                    $('.grocery-item select[name="subcategory_id"]').append('<option value="'+element.id+'">'+element.name+'</option>');
                });
                },
                error: function(err){
                console.log('err ',err)
                }
            });
        }
    });

    // p
    $(".btn-add").on('click', function (e) {  
        var a = '<div class="row mt-3">\
            <div class="col-2">\
                <label class="form-control-label"> Quantity </label>\
                <input type="number" name="qty[]" class="form-control form-control-alternative" placeholder="Quantity" required>\
            </div>\
            <div class="col-2">\
                <label class="form-control-label"> Unit </label>\
                <select name="unit[]" class="form-control form-control-alternative" required>\
                    <option value=""> Select Item Unit </option>\
                    <option value="kg"> kg </option>\
                    <option value="gm"> gm </option>\
                    <option value="ltr"> ltr </option>\
                    <option value="ml"> ml </option>\
                    <option value="unit"> unit </option>\
                </select>\
            </div>\
            <div class="col-2">\
                <label class="form-control-label"> Price </label>\
                <input type="number" name="price[]" class="form-control form-control-alternative" placeholder="Price" required>\
            </div>\
            <div class="col-2">\
                <label class="form-control-label"> Fake Price </label>\
                <input type="number" name="fake_price[]" class="form-control form-control-alternative" placeholder="Fake Price" required>\
            </div>\
            <div class="col-2 mt-auto">\
                <button type="button" class="btn btn-danger btn-remove"> - </button>\
            </div>\
        </div>';
        $('.append').append(a);
    });

    jQuery(document).on("change",".select-driver", function () {
        var driver_id = this.value;
        var order_id = $(this).attr("data-id");
        console.log('driver_id',driver_id);
        console.log('order_id',order_id);
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'changeGroceryOrderDriver',
            data:{
            order_id:order_id,
            driver_id:driver_id,
            },
            success: function(result){
            console.log('result ',result)
            if(result.success==true){
                Swal.fire({
                    type: 'success',
                    title: 'Driver Selected changed successfully.',
                    timer: 1500,
                    showConfirmButton: false,
                })
            }
            },
            error: function(err){
            console.log('err ',err)
            }
        });
    });


    $(document).on('click', '.btn-remove', function() {
        var row = $(this).closest('.row');
        row.remove();
    });

});
function deleteItemGallery(name,id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't to delete this record!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.value) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            dataType: "JSON",
            url: base_url + '/GroceryItem/gallery/' + id + '/delete/' +name,
            success: function (result) {
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
                console.log('result ', result)
                Swal.fire({
                type: 'success',
                title: 'Deleted!',
                text: 'Record is deleted successfully.'
                })
            },
            error: function (err) {
                console.log('err ', err)
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'This record is conntect with another data!'
                })
            }
        });
    }
    })

}

function deleteData(url, id) {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't to delete this record!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.value) {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            dataType: "JSON",
            url: url + '/' + id,
            success: function (result) {
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
                console.log('result ', result)
                Swal.fire({
                type: 'success',
                title: 'Deleted!',
                text: 'Record is deleted successfully.'
                })
            },
            error: function (err) {
                console.log('err ', err)
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'This record is conntect with another data!'
                })
            }
        });
    }
    })

}

function getnotification(){
    alert('asa');
}

function notificationDetail(id){

    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"GET",
        url:'NotificationTemplate/'+id+'/edit',
        success: function(result){
          console.log('result ',result)
          $("#edit-template-form input[name='subject']").val(result.data.subject);
          $('#edit-template-form').get(0).setAttribute('action', base_url+'/NotificationTemplate/'+result.data.id);
          $('#edit-template-form .textarea_editor').data("wysihtml5").editor.setValue(result.data.mail_content);
          $("#edit-template-form textarea#input-message_content").html(result.data.message_content);
        },
        error: function(err){
          console.log('err ',err)
        }
      });

}


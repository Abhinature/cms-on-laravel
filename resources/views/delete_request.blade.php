<script>
  $('body').on('click', '.request_for_delete', function() {
    var rel_name = $(this).attr('rel_name');
    var type_id = $(this).attr('rel_id');
    var value = $(this).val();
    if (value == '0') {
      $('.hide_on_delete_check').css('display', 'block');

      swal({
        title: "Are you sure,You want to Save the Delete Request?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, archive it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: true,
        closeOnCancel: true,
        buttons: ["Cancel", "Save"]
      }).then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: 'Get',
            url: "{{ url('request-for-delete')}}" + '/' + rel_name + '/' + type_id,
            success: function(data) {

              swal({
                title: "Delete Request Saved",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, archive it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
              }).then((willDelete11) => {
                if (willDelete11 && rel_name == 'cmd_message') {
                  window.location.href = "{{ route('unit-website')}}";
                } else {
                  location.reload();
                }
              });
              $('.editmodalbyajax').modal('hide');
            }
          });
        }
      });

    } else {
      $('.hide_on_delete_check').css('display', 'block');


    }
  });
  $(document).on('click', '.delete_request_save', function() {
    // alert($('.publish_timeD').val());
    var publish_time = $('.publish_timeD').val();
    var relation = $('.relationD').val();
    var relid = $('.relidD').val();
    var otpval = $('.otpvalD').val();


    $.ajax({
      type: 'Post',
      url: "{{url('save-delete-request')}}",
      data: {
        publish_time: publish_time,
        relation: relation,
        relid: relid,
        otpval: otpval,
        _token: "{{csrf_token()}}"
      },
      success: function(xa) {
        // alert(xa.success);
        if (xa.success == true) {
          $("#delete_request_content").modal('hide');
          swal({
            title: "Content Approved for Deletion!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          }).then((willDelete) => {
            if (willDelete) {
              location.reload();
            }
          });

        } else if (xa.success == false) {
          $("#delete_request_content").modal('hide');
          swal({
            title: xa.msg,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          });

        }
      }
    });

  });


  $('body').on('click', '.delete_request', function() {
    var rel = $(this).attr('rel');
    var type_id = $(this).attr('rel_id')
    swal({
      title: "Are you sure,You want to approve the Content?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, archive it!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: 'Post',
          url: "{{url('sendotp')}}",
          data: {
            rel: rel,
            type_id: type_id,
            _token: "{{csrf_token()}}"
          },
          success: function(xa) {
            if (xa.success == true) {
              $('.relationD').val(rel);
              $('.relidD').val(type_id);
              $("#delete_request_content").modal('show');
            }
          }
        });
      }
    });
  });
</script>
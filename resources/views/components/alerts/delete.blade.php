@props(['permission'])
<script>
      $(document).ready(function() {

            // check if the user hasPermission to delete element
            const is_able = `{{ auth()->user()->hasPermission("${permission}") }}`;

            if (!is_able) {
                  $('.btn-sweet-delete').each(function(index) {
                        $(this).addClass('disabled');
                        $(this).css('cursor', 'not-allowed');
                  });
            }
            // delete single item
            $(document).on('click', '.btn-sweet-delete', function(event) {

                  // prevent default
                  event.preventDefault();

                  if (is_able) {
                        // get the route example => http://educationforfree.online/admin/models/id
                        const url = $(this).closest('form').attr('action');

                        // send some value to method
                        const csrf_token = $("meta[name='csrf_token']").attr('content');

                        // select row
                        const row = $(this).closest('tr');
                        // sweet alert
                        Swal.fire({
                              title: 'Are you sure?',
                              text: "You won't be able to revert this!",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Yes, delete it!',
                              position: 'top-end',
                        }).then((result) => {
                              if (result.isConfirmed) {
                                    // ajax delete
                                    $.ajax({
                                          url: url,
                                          type: 'POST',
                                          data: {
                                                '_method': 'DELETE',
                                                '_token': csrf_token
                                          },
                                          success: function(data) {
                                                row.remove();

                                                // swl show
                                                Swal.fire({
                                                      position: 'top-end',
                                                      title: 'Deleted!',
                                                      text: data
                                                            .msg,
                                                      icon: 'success',
                                                      timer: 1500,
                                                      timerProgressBar: true,
                                                      didOpen: (
                                                            toast
                                                      ) => {
                                                            toast.addEventListener(
                                                                  'mouseenter',
                                                                  Swal
                                                                  .stopTimer
                                                            )
                                                            toast.addEventListener(
                                                                  'mouseleave',
                                                                  Swal
                                                                  .resumeTimer
                                                            )
                                                      }
                                                })
                                          },
                                          error: function() {
                                                Swal.fire({
                                                      icon: 'error',
                                                      title: 'Oops...',
                                                      text: 'Some error occurred, try agin!',
                                                      position: 'top-end',
                                                      timer: 2500,
                                                      timerProgressBar: true,
                                                      didOpen: (
                                                            toast
                                                      ) => {
                                                            toast.addEventListener(
                                                                  'mouseenter',
                                                                  Swal
                                                                  .stopTimer
                                                            )
                                                            toast.addEventListener(
                                                                  'mouseleave',
                                                                  Swal
                                                                  .resumeTimer
                                                            )
                                                      }
                                                })
                                          }
                                    });
                              }
                        })
                  } else {
                        Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: 'You don\'t have any permissions to do it!',
                              position: 'top-end',
                              timer: 2500,
                              timerProgressBar: true,
                              didOpen: (toast) => {
                                    toast.addEventListener(
                                          'mouseenter',
                                          Swal
                                          .stopTimer
                                    )
                                    toast.addEventListener(
                                          'mouseleave',
                                          Swal
                                          .resumeTimer
                                    )
                              }
                        })
                  }

            });
      });
</script>

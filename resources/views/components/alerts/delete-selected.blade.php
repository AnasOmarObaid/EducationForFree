@props(['permission', 'route'])
<script>
      // document ready
      $(document).ready(function() {

            // click on select all checkbox
            $(document).on('click', '.select-all', function() {
                  const select_all = $(this);
                  // check if the button is checked or not
                  if (select_all.is(':checked', true)) {
                        // send checked for all
                        $('.checkbox').prop('checked', true);
                        $('.btn-sweet-select-delete').removeClass('disabled');

                  } else {
                        // remove checked for all
                        $('.checkbox').prop('checked', false);
                        $('.btn-sweet-select-delete').addClass('disabled');

                  }
            });

            // if the length of the checkbox:checked is equal of the checkbox then checked the root btn
            $(document).on('click', '.checkbox', function() {

                  if ($('.checkbox:checked').length == $('.checkbox').length)
                        $('.select-all').prop('checked', true);
                  else
                        $('.select-all').prop('checked', false);

                  // remove or add class diabled to btn-sweet-select-delete
                  if ($('.checkbox:checked').length > 0)
                        $('.btn-sweet-select-delete').removeClass('disabled');
                  else
                        $('.btn-sweet-select-delete').addClass('disabled');
            });

            // click on btn-sweet-select-delete
            $(document).on('click', '.btn-sweet-select-delete', function(e) {
                  e.preventDefault();
                  // make sure that there is checked box
                  if ($('.checkbox:checked').length > 0) {
                        // check if the user hasPermission to delete element
                        const is_able =
                              `{{ auth()->user()->hasPermission("${permission}") }}`;


                        if (is_able) {
                              const ids = [];
                              // push the ids to delete it
                              $('.checkbox:checked').each(function() {
                                    ids.push($(this).data('id'));
                              });
                              // sweet alert
                              Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You won't be able to revert this!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete selected!',
                                    position: 'top-end',
                              }).then((result) => {
                                    if (result.isConfirmed) {
                                          const ids_str = ids.join(',');
                                          // send some value to method
                                          const csrf_token = $(
                                                      "meta[name='csrf_token']")
                                                .attr('content');
                                          $.ajax({
                                                url: `{{ route($route) }}`,
                                                type: 'POST',
                                                headers: {
                                                      'X-CSRF-Token': csrf_token
                                                },

                                                data: {
                                                      'ids': ids_str
                                                },

                                                success: function(
                                                      data) {
                                                      if (data
                                                            .status ==
                                                            'success'
                                                      ) {
                                                            $('.checkbox:checked')
                                                                  .each(function() {
                                                                        $(this)
                                                                              .parents(
                                                                                    'tr'
                                                                              )
                                                                              .remove();
                                                                  });
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
                                                      }
                                                },

                                                error: function(data) {
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

                  } else {
                        Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: 'Ther is not any record to delete!',
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

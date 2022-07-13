@props(['permission'])

<script>
      // check if the user hasPermission to accept request or not
      const is_able = `{{ auth()->user()->hasPermission("${permission}") }}`;

      // make all btn hidden
      if (!is_able) {
            $('.btn-accept-control').each(function(index) {
                  $(this).addClass('disabled');
                  $(this).css('cursor', 'not-allowed');
            });
      }

      var $this;
      // click btn-accept-control button
      $(document).on('click', '.btn-accept-control', function(event) {
            event.preventDefault();
            if (is_able) {

                  $this = $(this);

                  // get the route example => http://educationforfree.online/admin/models/id
                  const url = $(this).closest('form').attr('action');

                  // send some value to method
                  const csrf_token = $("meta[name='csrf_token']").attr('content');

                  // get the name
                  const name = $this.attr('name');

                  // get the value
                  var name_value = 0;

                  // the accept is 0 the the request is accept then make it 1
                  if (name == 'accept')
                        name_value = 1

                  Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        position: 'top-end',
                  }).then((result) => {
                        if (result.isConfirmed) {
                              $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: {
                                          '_method': 'POST',
                                          '_token': csrf_token,
                                          'accept': name_value
                                    },

                                    success: function(data) {
                                          if (name == 'accept')
                                                $this.closest('tr').remove();
                                          else {
                                            //change the badge
                                            var badge = $this.parent().closest('tr').children().find('span.teacher_badge');
                                            console.log(badge);
                                            badge.removeClass('badge-danger');
                                            badge.addClass('badge-primary');
                                            badge.text('student');
                                            // remove the buttons
                                            $this.parent().closest('tr').children().find('form.accept-form').remove();
                                            $this.remove();

                                          }
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
</script>

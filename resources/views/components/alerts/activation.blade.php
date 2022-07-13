@props(['permission'])

<script>
      $(document).ready(function() {


            // check if the user hasPermission to activate the user or not
            const is_able = `{{ auth()->user()->hasPermission("${permission}") }}`;

            // make all btn hidden
            if (!is_able) {
                  $('.btn-activation').each(function(index) {
                        $(this).addClass('disabled');
                        $(this).css('cursor', 'not-allowed');
                  });
            }
            var $this;
            $(document).on('click', '.btn-activation', function(event) {
                  // prevent default action
                  event.preventDefault();
                   $this = $(this);

                  if (is_able) {

                        // get the route example => http://educationforfree.online/admin/models/id
                        const url = $(this).closest('form').attr('action');

                        // send some value to method
                        const csrf_token = $("meta[name='csrf_token']").attr('content');

                        $.ajax({
                              url: url,
                              type: 'POST',
                              data: {
                                    '_method': 'POST',
                                    '_token': csrf_token
                              },
                              success: function(data){
                                // know the status of activation
                                if($this.attr('data-activation') == 'active'){
                                    // change the data
                                    $this.attr('data-activation', 'not_active');
                                    $this.attr('title', 'make student inactive');
                                    $this.removeClass('btn-success');
                                    $this.addClass('btn-danger');
                                    var i = $this.children();
                                    i.removeClass('fa-user-check');
                                    i.addClass('fa-user-alt-slash');
                                    var badge = $this.parent().closest('tr').children().find('span.badge-not_active');
                                    badge.removeClass('badge-not_active');
                                    badge.addClass('badge-active');
                                    badge.removeClass('badge-danger');
                                    badge.addClass('badge-success');
                                    badge.text('active');

                                }else{
                                    // change the data
                                    $this.attr('data-activation', 'active');
                                    $this.attr('title', 'activation student');
                                    $this.removeClass('btn-danger');
                                    $this.addClass('btn-success');
                                    var i = $this.children();
                                    i.removeClass('fa-user-alt-slash');
                                    i.addClass('fa-user-check');
                                    var badge = $this.parent().closest('tr').children().find('span.badge-active');
                                    badge.removeClass('badge-active');
                                    badge.addClass('badge-not_active');
                                    badge.removeClass('badge-success');
                                    badge.addClass('badge-danger');
                                    badge.text('not active');
                                }
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

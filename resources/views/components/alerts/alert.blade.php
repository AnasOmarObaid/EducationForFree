@props(['merror' => 'There is error, please try again'])
@if ($errors->any())
      <script>
            Swal.fire({
                  position: 'top',
                  icon: 'error',
                  title: "{{ $merror }}",
                  showConfirmButton: true,
                  timer: 2500,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                        toast.addEventListener(
                              'mouseenter',
                              Swal
                              .stopTimer)
                        toast.addEventListener(
                              'mouseleave',
                              Swal
                              .resumeTimer
                        )
                  }
            })
      </script>
@endif

@if (session('success'))
      <script>
            Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: "{{ session('success') }}",
                  showConfirmButton: true,
                  timer: 2500,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                        toast.addEventListener(
                              'mouseenter',
                              Swal
                              .stopTimer)
                        toast.addEventListener(
                              'mouseleave',
                              Swal
                              .resumeTimer
                        )
                  }
            })
      </script>
@endif

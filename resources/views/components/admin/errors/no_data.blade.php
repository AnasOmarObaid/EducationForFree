@props(['route'])
<div {{ $attributes->merge(['class' => 'alert alert-warning  text-white m-3']) }}  role="alert">
      <h4 class="alert-heading">OOPS :)</h4>
      <p>there is no data in our database! you need to create data <a href="{{ route($route) }}" style="color:blue">by
                  click me</a>
            or click in the button in a bove
      </p>
      <hr>
      <p class="mb-0">Whenever you need to, be sure to use
            margin utilities to keep things nice and tidy.</p>
</div>

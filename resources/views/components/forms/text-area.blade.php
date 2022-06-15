@props(['name', 'rows', 'error' => 'show'])
<textarea class='form-control @error($name) is-invalid @enderror' name="{{ $name }}" rows="{{ $rows }}"
      {{ $attributes }}>{{ $slot }}</textarea>

@if ($error == 'show')

      @error($name)
            <small class="text-danger">{{ $message }}</small>
      @enderror
@endif

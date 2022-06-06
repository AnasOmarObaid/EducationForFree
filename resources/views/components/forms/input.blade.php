@props(['type', 'name', 'small' => 'hide', 'error' => 'display'])
<input type="{{ $type }}" name="{{ $name }}"
      class="form-control @error($name) is-invalid @enderror" {{ $attributes }}>

@if ($error == 'display')
      @if ($small == 'show')
            @error($name)
                  <small class="text-danger">{{ $message }}</small>
            @else
                  <small>the role name must not exit in database!</small>
            @enderror
      @endif
@endif

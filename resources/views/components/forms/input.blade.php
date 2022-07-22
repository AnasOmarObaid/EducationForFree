@props(['type', 'name', 'small' => 'hide', 'error' => 'display', 'show_name' => 'roles'])
<input type="{{ $type }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
      {{ $attributes }}>

@if ($error == 'display')
      @if ($small == 'show')
            @error($name)
                  <small class="text-danger">{{ $message }}</small>
            @else
                  <small>the {{ $show_name }} name must not exit in database!</small>
            @enderror
      @else
            @error($name)
                  <small class="text-danger">{{ $message }}</small>
            @enderror
      @endif
@endif

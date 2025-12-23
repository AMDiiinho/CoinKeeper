@props([
    'label' => '',
    'name',
    'type' => '',
    'placeholder' => '',
])

<div class="input-error">
    @if($label)
        <label for="{{ $name }}"> {{ $label }}</label>
    @endif

    <input id = "{{ $name }}"
           type = "{{ $type }}"
           name = "{{ $name }}"
           value = "{{ old($name) }}"
           placeholder = "{{ $placeholder }}"
           {{ $attributes->merge(['class' => $errors->has($name) ? 'erro-campo' : '']) }}>  
</div>
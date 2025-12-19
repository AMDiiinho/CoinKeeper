@props([
    'label' => null,
    'name',
    'options' => [], // Array ['valor' => 'Texto']
    'placeholder' => 'Selecione...',
    'errorBag' => 'default',
    'disabled' => false
])

<div>
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }}>
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach($options as $key => $text)
            <option value="{{ $key }}" {{ old($name) == $key ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name, $errorBag)
        <div class="erro">{{ $message }}</div>
    @enderror
</div>
@props([
    'id',
    'title',
    'errorBag' => null, // Para a lógica do data-show-error
    'dataAttributes' => [] // Para passar data-edit-id, etc
])

{{-- Monta os atributos data-* extras --}}
@php
    $extraData = '';
    foreach($dataAttributes as $key => $val) {
        $extraData .= ' data-' . $key . '="' . $val . '"';
    }
@endphp

<div id="{{ $id }}" 
    class="modal-container" 
    style="display: none;"
    data-show-error="{{ $errorBag && $errors->$errorBag->any() ? 'true' : 'false' }}"
    {!! $extraData !!}>

    <div class="modal-card">

        <div class="topo-card">
            <span class="bt-fechar fechar-modal" data-target="#{{ $id }}">&times;</span>
            <h2>{{ $title }}</h2>
        </div>

        {{-- O conteúdo do form entra aqui --}}
        {{ $slot }}
    </div>
</div>
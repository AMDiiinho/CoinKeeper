@php
    $logos = [
        'itau'          => 'imagens/logos/itau.png',
        'visa'          => 'imagens/logos/visa.png',
        'inter'         => 'imagens/logos/inter.png',
        'bradesco'      => 'imagens/logos/bradesco.png',
        'elo'           => 'imagens/logos/elo.png',
        'mastercard'    => 'imagens/logos/mastercard.png',
        'santander'     => 'imagens/logos/santander.png',
        'caixa'         => 'imagens/logos/caixa.png',
        'bancodobrasil' => 'imagens/logos/bancodobrasil.png',
        'nubank'        => 'imagens/logos/nubank.png',
        'carteira'      => 'imagens/logos/carteira.png',
    ];
@endphp

<div class="logo-conta">
    <img src="{{ asset($logos[$banco] ?? 'images/logos/default.png') }}" alt="Logo {{ $banco }}">
</div>

@props(['clase' => ''])

<svg class="flor-svg flor-sol {{ $clase }}" viewBox="0 0 120 120" aria-hidden="true" focusable="false">
    <g class="petalos-girasol">
        @for ($i = 0; $i < 12; $i++)
            <ellipse cx="60" cy="22" rx="13" ry="24" fill="{{ $i % 2 ? '#FFC400' : '#FFD02E' }}" stroke="#E8A600" stroke-width="1" transform="rotate({{ $i * 30 }} 60 60)"/>
        @endfor
    </g>
    <g class="petalos-internos">
        @for ($i = 0; $i < 8; $i++)
            <ellipse cx="60" cy="34" rx="8" ry="14" fill="#F2A700" transform="rotate({{ $i * 45 + 15 }} 60 60)"/>
        @endfor
    </g>
    <circle cx="60" cy="60" r="17" fill="#7A4A12"/>
    <circle cx="60" cy="60" r="14" fill="#8F5B1C" stroke="#5E3A10" stroke-width="2"/>
    @foreach ([['x' => 70, 'y' => 60], ['x' => 67, 'y' => 67], ['x' => 60, 'y' => 70], ['x' => 53, 'y' => 67], ['x' => 50, 'y' => 60], ['x' => 53, 'y' => 53], ['x' => 60, 'y' => 50], ['x' => 67, 'y' => 53]] as $punto)
        <circle cx="{{ $punto['x'] }}" cy="{{ $punto['y'] }}" r="2.2" fill="#5E3A10"/>
    @endforeach
</svg>
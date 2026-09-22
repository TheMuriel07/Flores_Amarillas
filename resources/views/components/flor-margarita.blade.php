@props(['clase' => ''])

<svg class="flor-svg flor-margarita {{ $clase }}" viewBox="0 0 120 130" aria-hidden="true" focusable="false">
    <line x1="60" y1="76" x2="60" y2="128" stroke="#3E7C2F" stroke-width="5" stroke-linecap="round"/>
    <path d="M60 92 C 46 86 36 90 30 102" stroke="#4C9A3A" stroke-width="5" fill="none" stroke-linecap="round"/>
    <path d="M60 84 C 74 78 84 82 90 92" stroke="#3E7C2F" stroke-width="4" fill="none" stroke-linecap="round"/>
    <g class="capullo-margarita">
        @for ($i = 0; $i < 9; $i++)
            <ellipse cx="60" cy="28" rx="11" ry="19" fill="#FFD23F" stroke="#F0AE00" stroke-width="1" transform="rotate({{ $i * 40 }} 60 60)"/>
        @endfor
        @for ($i = 0; $i < 9; $i++)
            <ellipse cx="60" cy="33" rx="6.5" ry="12" fill="#FFE98A" transform="rotate({{ $i * 40 + 20 }} 60 60)"/>
        @endfor
        <circle cx="60" cy="60" r="15" fill="#FF9E1B"/>
        <circle cx="60" cy="60" r="8" fill="#7A4A12"/>
    </g>
</svg>
@props(['clase' => ''])

<svg class="flor-svg flor-tulipan {{ $clase }}" viewBox="0 0 120 130" aria-hidden="true" focusable="false">
    <line x1="60" y1="52" x2="60" y2="128" stroke="#3E7C2F" stroke-width="5" stroke-linecap="round"/>
    <path d="M60 88 C 46 80 36 82 28 94 C 40 98 52 96 60 88 Z" fill="#3E7C2F"/>
    <path d="M60 78 C 72 70 82 72 92 82 C 80 88 70 86 60 78 Z" fill="#4C9A3A"/>
    <g class="corola-tulipan">
        <path d="M60 52 C 42 48 36 22 46 12 C 52 9 58 20 60 52 Z" fill="#FFAB00"/>
        <path d="M60 52 C 78 48 84 22 74 12 C 68 9 62 20 60 52 Z" fill="#FFB300"/>
        <path d="M60 54 C 54 30 56 10 60 6 C 64 10 66 30 60 54 Z" fill="#FFD23F"/>
    </g>
</svg>
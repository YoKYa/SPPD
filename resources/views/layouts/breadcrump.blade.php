<nav aria-label="breadcrumb" style="margin:0;">
    <ol class="breadcrumb shadow" style="background-color: rgb(0, 183, 255);">
        <li class="breadcrumb-item active text-white" aria-current="page"> 
            {{-- Path posisi link --}}
            {{ $path }} -
            {{-- Role Multi User --}}
            @if ($role == 1)
                Admin                
            @endif
        </li>
    </ol>
</nav>
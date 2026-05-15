@php
    $success = session('success');
    $error   = session('error');
    $info    = session('info');
    $hasFlash = $success || $error || $info;
@endphp

{{-- Toast container — always rendered so JS can push runtime toasts too --}}
<div id="toastRoot" class="fixed top-5 right-5 z-[100] flex flex-col gap-3 pointer-events-none w-[calc(100vw-2.5rem)] max-w-sm"></div>

@if($hasFlash)
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            @if($success)
                window.kcToast?.({ type: 'success', message: @json($success) });
            @endif
            @if($error)
                window.kcToast?.({ type: 'error', message: @json($error) });
            @endif
            @if($info)
                window.kcToast?.({ type: 'info', message: @json($info) });
            @endif
        });
    </script>
@endif

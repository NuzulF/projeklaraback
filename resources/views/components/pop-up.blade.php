
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
@if (session('pop-up'))
    @php
        $message = session('pop-up');
    @endphp
    <script>
        Swal.fire(
            '{{ $message['head'] }}',
            '{!! str_replace("'", "\'",$message['body']) !!}',
            '{{ $message['status'] }}'
        )
    </script>
@endif
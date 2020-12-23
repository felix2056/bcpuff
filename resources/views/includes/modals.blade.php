<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
</script>

@if (Session::has('success') || Session::has('error') || Session::has('warning'))
@if (Session::has('success'))
<script>
    document.onreadystatechange = () => {
            if (document.readyState === 'complete') {
                var text = "{{ Session::get('success') }}";

                Toast.fire({
                    icon: 'success',
                    title: String(text)
                });
            }
        };
</script>

@elseif(Session::has('warning'))
<script>
    document.onreadystatechange = () => {
        if (document.readyState === 'complete') {
            var text = "{{ Session::get('warning') }}";

            Toast.fire({
                icon: 'warning',
                title: String(text)
            });
        }
    };
</script>

@elseif(Session::has('error'))
<script>
    document.onreadystatechange = () => {
        if (document.readyState === 'complete') {
            var text = "{{ Session::get('error') }}";

            Toast.fire({
                icon: 'error',
                title: String(text)
            });
        }
    };
</script>
@endif
@endif
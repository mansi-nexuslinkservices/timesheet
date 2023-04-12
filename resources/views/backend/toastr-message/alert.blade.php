@if(Session::has('success'))
<script>
    toastr.success("{{ session('success') }}");
</script>
@endif
@if(Session::has('error'))
<script>
    toastr.error("{{ session('error') }}");
</script>
@endif
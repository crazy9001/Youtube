<script type="text/javascript">

    var Youtube = Youtube || {};

    Youtube.languages = {
        'notices_msg': {
            'success': '{{ trans('bases::layouts.success') }}!',
            'error': '{{ trans('bases::layouts.error') }}!'
        },
    }
</script>

@if (session()->has('success_msg') || session()->has('error_msg') || isset($errors) || isset($error_msg))
    <script type="text/javascript">
        $(document).ready(function () {

            @if (session()->has('success_msg'))
            Youtube.showNotice('success', '{{ session('success_msg') }}', Youtube.languages.notices_msg.success);
            @endif
            @if (session()->has('error_msg'))
            Youtube.showNotice('error', '{{ session('error_msg') }}', Youtube.languages.notices_msg.error);
            @endif
            @if (isset($error_msg))
            Youtube.showNotice('error', '{{ $error_msg }}', Youtube.languages.notices_msg.error);
            @endif
            @if (isset($errors))
            @foreach ($errors->all() as $error)
            Youtube.showNotice('error', '{{ $error }}', Youtube.languages.notices_msg.error);
            @endforeach
            @endif
        });
    </script>
@endif
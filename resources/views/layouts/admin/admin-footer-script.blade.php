<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ Helper::assets('assets/js/vendor.min.js') }}"></script>
@yield('script')
<script type="text/javascript"> var assetUrl="{{ Helper::assets('assets/') }}"; </script>
<script src="{{ Helper::assets('assets/js/app.min.js') }}"></script>
<script src="{{ Helper::assets('assets/js/custom.js') }}"></script>

@yield('script-bottom')

@if(isset($notificationjs) && $notificationjs)
<script defer type="text/javascript">    
    var get_notification_link = "{{ route('user.notifications') }}";
</script>
<script defer src="{{ Helper::assets('assets/js/pages/notification.js') }}"></script>
@endif

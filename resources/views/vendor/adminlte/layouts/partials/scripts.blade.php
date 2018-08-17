<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script>
var AdminLTEOptions = {
//Enable sidebar expand on hover effect for sidebar mini
//This option is forced to true if both the fixed layout and sidebar mini
//are used together
sidebarExpandOnHover: true,
//BoxRefresh Plugin
enableBoxRefresh: true,
//Bootstrap.js tooltip
enableBSToppltip: true
};
</script>
<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};

</script>

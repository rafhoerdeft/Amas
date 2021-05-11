<footer class="footer footer-static footer-light navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-left d-block d-md-inline-block">Copyright &copy; <?= date('Y') ?> <a class="text-bold-800 grey darken-2" href="https://diskominfo.magelangkab.go.id" target="_blank">DISKOMINFO </a> Kabupaten Magelang. </span>
        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i
                class="ft-heart pink"></i></span>
                <span id="scroll-top"></span></span>
    </p>
</footer>

<script src="<?= assets_url ?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<script src="<?= assets_url . "app-assets/js/core/app-menu.js" ?>"></script>
<script src="<?= assets_url . "app-assets/js/core/app.js" ?>"></script>
<script src="<?= assets_url . "app-assets/js/scripts/customizer.js" ?>"></script>
<script src="<?= assets_url . "app-assets/vendors/js/ui/jquery.sticky.js" ?>"></script>
<script src="<?= assets_url . "app-assets/js/scripts/footer.min.js" ?>"></script>

<!-- BEGIN VENDOR JS-->
@yield('footer')

<script type="text/javascript">
    function inputAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    // alert(charCode);
    if (charCode > 31 && (charCode < 46 || charCode > 57))
        return false;
    return true;
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#alts').fadeTo(3000, 500).slideUp(500);
    });
</script>
</body>

</html>
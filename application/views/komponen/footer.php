    <footer class="footer footer-static footer-light navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">Copyright &copy; <?= date('Y') ?> <a class="text-bold-800 grey darken-2" href="https://diskominfo.magelangkab.go.id" target="_blank">DISKOMINFO </a> Kabupaten Magelang. </span>
            <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i
                    class="ft-heart pink"></i></span>
                    <span id="scroll-top"></span></span>
        </p>
    </footer>
    <!-- BEGIN VENDOR JS-->
    <?php foreach ($js as $val) { ?>
        <script src="<?= $val ?>"></script>
    <?php } ?>

    <?php
    if (isset($script)) {
        foreach ($script as $scr) {
    ?>
        <script type="text/javascript">
            <?= $scr ?>
        </script>
    <?php }
    } ?>

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
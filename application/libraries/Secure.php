<?php
    defined('BASEPATH') or exit('No direct script access allowed');
      
    class Secure {
        public function __construct() {
            $this->ci =& get_instance();
        }

        public function auth($cek='') {
            $result = false;

            if ($this->ci->session->userdata('logs') != $cek) {
                $this->ci->session->sess_destroy();
                ?>
                    <script>
                        alert('Silahkan login dahulu!');
                        document.location = '<?=base_url('Auth');?>';
                    </script>
                <?php
            } 
        }
    }

?>
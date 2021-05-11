<?php 
    $this->load->view('komponen/header',$header);
    $this->load->view('menu',$menu);
    if(isset($konten))$this->load->view($konten, $cont);
    $this->load->view('komponen/footer',$footer);
?>
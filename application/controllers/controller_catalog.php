<?php

class Controller_Catalog extends Controller { 
    function action_index() { 
        $this->view->generate('catalog_view.php', 'template_view.php'); 
    } 
}

?>
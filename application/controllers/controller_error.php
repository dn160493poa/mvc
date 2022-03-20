<?php

class Controller_Error extends Controller
{
    public function action_422()
    {
        $this->view->generate('errors/422.php', 'template_view.php', [
            'error' => '422 - is bad'
        ]);
    }

    public function action_406()
    {
        $this->view->generate('errors/406.php', 'template_view.php', [
            'error' => '406 - is bad'
        ]);
    }
}
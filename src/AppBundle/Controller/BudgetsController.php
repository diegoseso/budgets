<?php

namespace AppBundle\Controller;

class BudgetsController
{
    public function getBudgetsAction()
    {
        $data = array("Usuarios" => array(
        array(
            "nombre"   => "Antonio",
            "Apellido" => "Martinez"
        )));
         
        return $data;
    }

    public function postBudgetsAction()
    {
        $data = array("Usuarios" => array(
        array(
            "nombre"   => "post",
            "Apellido" => "post"
        )));
         
        return $data;
    }

    public function putBudgetsAction()
    {
    }
    
    public function deleteBudgetsAction()
    {
    }  
}

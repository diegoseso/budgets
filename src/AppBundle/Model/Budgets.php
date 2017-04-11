<?php

namespace AppBundle\Model 

Class Budgets 
{

    public amount;

    public description;

    public \date budgetDate;

    public \AppBundle\user creator; 

    public array files;


    public function __construct( $amount, $description, \date budgetDate, files = null )
    {
        $this->amount = $amount;
        $this->description = $description;
        $this->budgetDate = $budgetDate;
        $this->files = $files;
        $this->creator = $loggedUser; //how to get symfony logged user
    }

{

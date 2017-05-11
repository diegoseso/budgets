<?php

namespace AppBundle\Controller;

use AppBundle\Document\Budget;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BudgetController extends Controller
{
    /**
     * @Route("/budget/add", name="create")
     * @Method({"PUT"})
     */
    public function newAction( Request $data )
    {
        $budget = new Budget();

        $dataForBudget = json_decode( $data->request->get( 'json' ) ); 

        $budget->setName( $dataForBudget->name );
        $budget->setAmount( $dataForBudget->amount );

        $mongoD = $this->get('doctrine_mongodb')->getManager();
        $mongoD->persist($budget);
        $mongoD->flush();
        
        return new Response( json_encode( array( 'status'=>'success', 'id'=>$budget->getId() ) ) );
    }
    
    /**
     * @Route("/budget/view/{id}", name="get")
     * @Method({"GET"})
     */
    public function getAction($id)
    {
        $budget = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:Budget')
            ->find( $id );
        if ( !$budget ) {
            throw $this->createNotFoundException( 'No product found for id '.$id );
        }
        return new Response( json_encode( array( 'status'=>'success', 'data'=>$this->convertToArray( $budget ) ) ) );
    }

    /**
     * @Route("/budget/list", name="getList")
     * @Method({"GET"})
     */
    public function getListAction()
    {
        $budgets = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:Budget')
            ->findAll();
        
        foreach( $budgets as $budget ){
            $budgetList[] = $this->convertToArray( $budget ); 
        }
        
        if (!$budgets) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        return new Response( json_encode( array( 'status'=>'success', 'data'=>$budgetList ) ) );
    }



    /**
     * @Route("/budget/edit", name="edit")
     * @Method({"POST"})
     */
    public function editAction( Request $request )
    {
        $budgetNewData = json_decode( $request->request->get('json') );
        
        $budget = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:Budget')
            ->find( $budgetNewData->id );
        if ( !$budget ) {
            throw $this->createNotFoundException('No product found for id '.$budgetNewData->id);
        }
        
        $budget->setName( $budgetNewData->name );       
        $budget->setAmount( $budgetNewData->amount );       
        
        $budgetMongoDocument = $this->get('doctrine_mongodb')->getManager();
        $budgetMongoDocument->persist( $budget );
        $budgetMongoDocument->flush();
        
        return new Response( json_encode( array( 'status'=>'success', 'data'=>$budget ) ) );
    }
    
    /**
     * @Route("/budget/attach", name="attach")
     * @Method({"POST"})
     */
    public function attachAction( Request $request )
    {
        $a = $request->files->all();
        
        var_dump( $a );
        die();
        return new Response( json_encode( array( 'status'=>'success', 'data'=>$budget ) ) );
    }
  
    
    /**
     * @Route("/budget/delete/{id}", name="delete")
     * @Method({"DELETE"})
     */
    public function deleteAction( $id )
    {
        $budget = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:Budget')
            ->find( $id );
        if ( !$budget ) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        
        $mongoD = $this->get('doctrine_mongodb')->getManager();
        $mongoD->remove( $budget );
        $mongoD->flush();
        return new Response( json_encode( array( 'status'=>'success' ) ) );
    
    }

    private function convertToArray( $object )
    {
        return $object->toArray();
    }
}

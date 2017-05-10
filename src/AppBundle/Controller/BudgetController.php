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
     * @Route("/budget/modify", name="alter")
     * @Method({"POST"})
     */
    public function alterProductAction( Request $request )
    {
        $id = $request->request->get('id');
        $name = $request->request->get('name');
        $product = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:Product')
            ->find($id);
        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        $product->setName( $name );        
        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($product);
        $dm->flush();
        die();
    }
    /**
     * @Route("/budget/delete", name="delete")
     * @Method({"DELETE"})
     */
    public function deleteAction( Request $request)
    {
        $id = $request->request->get('id');
        
        $product = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:Product')
            ->find($id);
        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->remove( $product );
        $dm->flush();
    }

    private function convertToArray( $object )
    {
        return $object->toArray();
    }
}

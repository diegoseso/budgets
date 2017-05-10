<?php

namespace AppBundle\Controller;

use AppBundle\Document\Product;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/budget/add", name="create")
     * @Method({"PUT"})
     */
    public function newAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($product);
        $dm->flush();
        return new Response( json_encode( array( 'id'=>$product->getId() ) ) );
    }
    
    /**
     * @Route("/budget/view/{id}", name="get")
     * @Method({"GET"})
     */
    public function getAction($id)
    {
        $product = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:Product')
            ->find($id);
        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        return $product;
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
}

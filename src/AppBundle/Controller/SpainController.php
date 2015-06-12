<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Spain;
use AppBundle\Form\SpainType;

/**
 * Spain controller.
 *
 * @Route("/admin/spain")
 */
class SpainController extends Controller
{

    /**
     * Lists all Spain entities.
     *
     * @Route("/", name="admin_spain")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Spain')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Spain entity.
     *
     * @Route("/", name="admin_spain_create")
     * @Method("POST")
     * @Template("AppBundle:Spain:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Spain();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_spain_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Spain entity.
     *
     * @param Spain $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Spain $entity)
    {
        $form = $this->createForm(new SpainType(), $entity, array(
            'action' => $this->generateUrl('admin_spain_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Spain entity.
     *
     * @Route("/new", name="admin_spain_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Spain();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Spain entity.
     *
     * @Route("/{id}", name="admin_spain_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Spain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spain entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Spain entity.
     *
     * @Route("/{id}/edit", name="admin_spain_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Spain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spain entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Spain entity.
    *
    * @param Spain $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Spain $entity)
    {
        $form = $this->createForm(new SpainType(), $entity, array(
            'action' => $this->generateUrl('admin_spain_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Spain entity.
     *
     * @Route("/{id}", name="admin_spain_update")
     * @Method("PUT")
     * @Template("AppBundle:Spain:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Spain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spain entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_spain_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Spain entity.
     *
     * @Route("/{id}", name="admin_spain_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Spain')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Spain entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_spain'));
    }

    /**
     * Creates a form to delete a Spain entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_spain_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

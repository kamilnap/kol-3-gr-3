<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Romania;
use AppBundle\Form\RomaniaType;

/**
 * Romania controller.
 *
 * @Route("/admin/romania")
 */
class RomaniaController extends Controller
{

    /**
     * Lists all Romania entities.
     *
     * @Route("/", name="admin_romania")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Romania')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Romania entity.
     *
     * @Route("/", name="admin_romania_create")
     * @Method("POST")
     * @Template("AppBundle:Romania:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Romania();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_romania_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Romania entity.
     *
     * @param Romania $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Romania $entity)
    {
        $form = $this->createForm(new RomaniaType(), $entity, array(
            'action' => $this->generateUrl('admin_romania_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Romania entity.
     *
     * @Route("/new", name="admin_romania_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Romania();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Romania entity.
     *
     * @Route("/{id}", name="admin_romania_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Romania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Romania entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Romania entity.
     *
     * @Route("/{id}/edit", name="admin_romania_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Romania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Romania entity.');
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
    * Creates a form to edit a Romania entity.
    *
    * @param Romania $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Romania $entity)
    {
        $form = $this->createForm(new RomaniaType(), $entity, array(
            'action' => $this->generateUrl('admin_romania_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Romania entity.
     *
     * @Route("/{id}", name="admin_romania_update")
     * @Method("PUT")
     * @Template("AppBundle:Romania:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Romania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Romania entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_romania_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Romania entity.
     *
     * @Route("/{id}", name="admin_romania_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Romania')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Romania entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_romania'));
    }

    /**
     * Creates a form to delete a Romania entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_romania_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

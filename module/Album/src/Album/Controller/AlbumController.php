<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Form\AlbumForm;
use Album\Model;
use AntonStoeckl\Resources\Album;

class AlbumController extends AbstractActionController
{
    protected $albumModel;

    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => $this->getAlbumModel()->fetchAllAlbums(),
        ));
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if ($request->isPost()) {
            //TODO: move this into repo, it is manbdango specific
            $album = new Album($this->getAlbumModel()->getAlbumRepository()->getMandango());
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->fromArray($form->getData());
                $this->getAlbumModel()->saveAlbum($album);

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }

        return array('form' => $form);
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id', null);

        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                    'action' => 'add'
                ));
        }

        $album = $this->getAlbumModel()->fetchOneAlbumById($id);

        $form  = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAlbumModel()->saveAlbum($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', null);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = $request->getPost('id');
                $this->getAlbumModel()->deleteAlbum($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return array(
            'id'    => $id,
            'album' => $this->getAlbumModel()->fetchOneAlbumById($id)
        );
    }

    /**
     * @return \Album\Model\Album
     */
    public function getAlbumModel()
    {
        if (!$this->albumModel) {
            $sm = $this->getServiceLocator();
            $this->albumModel = $sm->get('Album\Model\Album');
        }

        return $this->albumModel;
    }
}


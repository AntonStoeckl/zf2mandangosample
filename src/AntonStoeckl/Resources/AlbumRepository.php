<?php

namespace AntonStoeckl\Resources;

/**
 * Repository of \AntonStoeckl\Resources\Album document.
 */
class AlbumRepository
    extends Base\AlbumRepository
    implements AlbumRepositoryInterface
{
    /**
     * @return mixed
     */
    public function createNewAlbum()
    {
        $class = '\\' . $this->getDocumentClass();

        return new $class($this->getMandango());
    }

    /**
     * @return array
     */
    public function fetchAllAlbums()
    {
        return $this->createQuery()->all();
    }

    /**
     * @param string $id
     * @return \Mandango\Document\Document|null
     */
    public function fetchOneAlbumById($id)
    {
        $query = $this->createQuery()
            ->criteria(array('_id' => $this->idToMongo($id)));

        return $query->one();
    }

    /**
     * @param AlbumItemInterface $album
     */
    public function saveAlbum(AlbumItemInterface $album)
    {
        $this->save($album);
    }

    /**
     * @param string $id
     */
    public function deleteAlbumById($id)
    {
        $album = $this->fetchOneAlbumById($id);

        $this->delete($album);
    }
}
<?php

namespace Album\Resource\Mandango;

/**
 * Repository of Album\Resource\Mandango\Album document.
 */
class AlbumRepository extends Base\AlbumRepository implements AlbumRepositoryInterface
{
    /**
     * Creates a new (empty) album document.
     *
     * @return \Album\Resource\Mandango\Album
     */
    public function createNewAlbum()
    {
        $class = '\\' . $this->getDocumentClass();

        return new $class($this->getMandango());
    }

    /**
     * Fetches an array of all album documents.
     *
     * @return array
     */
    public function fetchAllAlbums()
    {
        return $this->createQuery()->all();
    }

    /**
     * Fetch one album document by it's id.
     *
     * @param string $id
     * @return \Album\Resource\Mandango\Album|null
     */
    public function fetchOneAlbumById($id)
    {
        $query = $this->createQuery()
            ->criteria(array('_id' => $this->idToMongo($id)));

        return $query->one();
    }

    /**
     * Save (persist) an album document.
     *
     * @param AlbumItemInterface $album
     */
    public function saveAlbum(AlbumItemInterface $album)
    {
        $this->save($album);
    }

    /**
     * Delete an album document by it's id.
     *
     * @param string $id
     */
    public function deleteAlbumById($id)
    {
        $album = $this->fetchOneAlbumById($id);

        $this->delete($album);
    }
}
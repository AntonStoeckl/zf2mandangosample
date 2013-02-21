<?php

namespace AntonStoeckl\Resources;

/**
 * Repository of AntonStoeckl\Resources\Album document.
 */
class AlbumRepository
    extends Base\AlbumRepository
    implements AlbumRepositoryInterface
{
    public function fetchAllAlbums()
    {
        return $this->createQuery()->all();
    }

    public function fetchOneAlbumById($id)
    {
        $query = $this->createQuery()
            ->criteria(array('_id' => $this->idToMongo($id)));

        return $query->one();
    }

    public function saveAlbum(AlbumItemInterface $album)
    {
        $this->save($album);
    }

    public function deleteAlbum($id)
    {

    }
}
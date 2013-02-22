<?php

namespace Album\Model;

use AntonStoeckl\Resources\AlbumRepositoryInterface;
use AntonStoeckl\Resources\AlbumItemInterface;

class Album
{
    /**
     * @var \AntonStoeckl\Resources\AlbumRepositoryInterface
     */
    protected $albumRepository;

    public function __construct(AlbumRepositoryInterface $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    /**
     * @return \AntonStoeckl\Resources\AlbumRepositoryInterface
     */
    public function getAlbumRepository()
    {
        return $this->albumRepository;
    }

    /**
     * @return mixed
     */
    public function fetchAllAlbums()
    {
        return $this->albumRepository->fetchAllAlbums();
    }

    /**
     * @param string $id
     * @return \AntonStoeckl\Resources\AlbumItemInterface
     */
    public function fetchOneAlbumById($id)
    {
        return $this->albumRepository->fetchOneAlbumById($id);
    }

    /**
     * @param \AntonStoeckl\Resources\AlbumItemInterface $album
     */
    public function saveAlbum(AlbumItemInterface $album)
    {
        $this->albumRepository->saveAlbum($album);
    }

    /**
     * @param string $id
     */
    public function deleteAlbum($id)
    {
        $this->albumRepository->deleteAlbum($id);
    }
}

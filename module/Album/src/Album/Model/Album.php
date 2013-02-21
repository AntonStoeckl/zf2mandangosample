<?php

namespace Album\Model;

use AntonStoeckl\Resources\AlbumRepositoryInterface;

class Album
{
    protected $albumRepository;

    public function __construct(AlbumRepositoryInterface $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    public function fetchAllAlbums()
    {
        return $this->albumRepository->fetchAllAlbums();
    }

    public function fetchOneAlbumById($id)
    {
        return $this->albumRepository->fetchOneAlbumById($id);
    }

    public function saveAlbum($album)
    {
        $this->albumRepository->saveAlbum($album);
    }

    public function deleteAlbum($id)
    {
        $this->albumRepository->deleteAlbum($id);
    }
}

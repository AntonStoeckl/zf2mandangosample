<?php

namespace Album\Model;

use Album\Resource\Mandango\AlbumRepositoryInterface;
use Album\Resource\Mandango\AlbumItemInterface;

class Album
{
    /**
     * @var \Album\Resource\Mandango\AlbumRepositoryInterface
     */
    protected $albumRepository;

    /**
     * The constructor
     *
     * @param \Album\Resource\Mandango\AlbumRepositoryInterface $albumRepository
     */
    public function __construct(AlbumRepositoryInterface $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    /**
     * @return \Album\Resource\Mandango\AlbumRepositoryInterface
     */
    public function getAlbumRepository()
    {
        return $this->albumRepository;
    }

    /**
     * @return mixed
     */
    public function createNewAlbum()
    {
        return $this->albumRepository->createNewAlbum();
    }

    /**
     * @return array
     */
    public function fetchAllAlbums()
    {
        return $this->albumRepository->fetchAllAlbums();
    }

    /**
     * @param string $id
     * @return \Album\Resource\Mandango\AlbumItemInterface
     */
    public function fetchOneAlbumById($id)
    {
        return $this->albumRepository->fetchOneAlbumById($id);
    }

    /**
     * @param \Album\Resource\Mandango\AlbumItemInterface $album
     */
    public function saveAlbum(AlbumItemInterface $album)
    {
        $this->albumRepository->saveAlbum($album);
    }

    /**
     * @param string $id
     */
    public function deleteAlbumById($id)
    {
        $this->albumRepository->deleteAlbumById($id);
    }
}

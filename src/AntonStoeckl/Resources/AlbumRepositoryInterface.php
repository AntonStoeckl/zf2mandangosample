<?php

namespace AntonStoeckl\Resources;

interface AlbumRepositoryInterface
{
    public function createNewAlbum();
    public function fetchAllAlbums();
    public function fetchOneAlbumById($id);
    public function saveAlbum(AlbumItemInterface $album);
    public function deleteAlbumById($id);
}

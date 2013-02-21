<?php

namespace AntonStoeckl\Resources;

interface AlbumRepositoryInterface
{
    public function fetchAllAlbums();
    public function fetchOneAlbumById($id);
    public function saveAlbum(AlbumItemInterface $album);
    public function deleteAlbum($id);
}

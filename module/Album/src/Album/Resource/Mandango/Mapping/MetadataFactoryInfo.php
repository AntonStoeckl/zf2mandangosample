<?php

namespace Album\Resource\Mandango\Mapping;

class MetadataFactoryInfo
{
    public function getAlbumResourceMandangoTestsubdocClass()
    {
        return array(
            'isEmbedded' => true,
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'foo' => array(
                    'dbName' => 'foo',
                    'type' => 'string',
                ),
                'bar' => array(
                    'dbName' => 'bar',
                    'type' => 'string',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getAlbumResourceMandangoAlbumClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'album',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'artist' => array(
                    'type' => 'string',
                    'dbName' => 'artist',
                ),
                'title' => array(
                    'type' => 'string',
                    'dbName' => 'title',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getAlbumResourceMandangoTestdocClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'album',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'artist' => array(
                    'dbName' => 'artist',
                    'type' => 'string',
                ),
                'title' => array(
                    'dbName' => 'title',
                    'type' => 'string',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(
                'source' => array(
                    'class' => 'Album\\Resource\\Mandango\\Testsubdoc',
                ),
            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }
}
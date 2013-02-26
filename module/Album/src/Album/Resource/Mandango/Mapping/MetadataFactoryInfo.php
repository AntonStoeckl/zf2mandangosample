<?php

namespace Album\Resource\Mandango\Mapping;

class MetadataFactoryInfo
{
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
}
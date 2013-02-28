<?php

namespace Album\Resource\Mandango\Mapping;

class MetadataFactory extends \Mandango\MetadataFactory
{
    protected $classes = array(
        'Album\\Resource\\Mandango\\Testsubdoc' => true,
        'Album\\Resource\\Mandango\\Album' => false,
        'Album\\Resource\\Mandango\\Testdoc' => false,
    );
}
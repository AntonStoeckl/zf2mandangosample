<?php

namespace Album\Resource\Mandango\Mapping;

class MetadataFactory extends \Mandango\MetadataFactory
{
    protected $classes = array(
        'Album\\Resource\\Mandango\\Album' => false,
    );
}
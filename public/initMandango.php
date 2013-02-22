<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'vendor/autoload.php';

$resourcesDir = 'src/AntonStoeckl/Resources';

use Mandango\Mondator\Mondator;

$mondator = new Mondator();

// assign the config classes
$mondator->setConfigClasses(array(
        'AntonStoeckl\Resources\Album' => array(
            'collection' => 'album',
            'fields' => array(
                'artist' => 'string',
                'title'  => 'string',
            ),
        ),
    ));

// assign extensions
$mondator->setExtensions(array(
        new Mandango\Extension\Core(array(
            'metadata_factory_class'  => 'AntonStoeckl\Resources\Mapping\MetadataFactory',
            'metadata_factory_output' => $resourcesDir . '/Mapping',
            'default_output'          => $resourcesDir,
        )),
        new Zf2mandango\Mandango\Extension\DocumentArraySerializable(),
    ));

// process
$mondator->process();
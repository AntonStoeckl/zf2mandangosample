<?php

namespace Album;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'LogFormatter' => function($sm) {
                    return new \Zend\Log\Formatter\FirePhp();
                },
                'LogWriter' => function($sm) {
                    return new \Zend\Log\Writer\FirePhp();
                },
                'Logger' => function($sm) {
                    $logger = new \Zend\Log\Logger();
                    $writer = $sm->get('LogWriter');
                    $formatter = $sm->get('LogFormatter');
                    $writer->setFormatter($formatter);
                    $logger->addWriter($writer);
                    return $logger;
                },
                'Mandango' => function($sm) {
                    $config = $sm->get('Config');
                    $metadataFactory = new \Album\Resource\Mandango\Mapping\MetadataFactory();
                    $cacheDir = isset($config['mandango']['cache_dir'])
                        ? $config['mandango']['cache_dir']
                        : './module/Album/data/cache/mandango';
                    $cache = new \Mandango\Cache\FilesystemCache($cacheDir);
                    $logger = $sm->get('Logger');
                    $mandangoLogger = function(array $log) use ($logger) {
                        $logger->info('Mandango query logger', $log);
                    };
                    $mandango = new \Mandango\Mandango($metadataFactory, $cache, $mandangoLogger);
                    $mongoDbConfig = isset($config['mongodb'])
                        ? $config['mongodb']
                        : array('uri' => 'mongodb://localhost:27017', 'database' => 'default');
                    $connection = new \Mandango\Connection(
                        $mongoDbConfig['uri'],
                        $mongoDbConfig['database']
                    );
                    $mandango->setConnection('primary', $connection);
                    $mandango->setDefaultConnectionName('primary');
                    return $mandango;
                },
                'Album\Resource\Mandango\AlbumRepository' => function($sm) {
                    $mandango = $sm->get('Mandango');
                    return $mandango->getRepository('Album\Resource\Mandango\Album');
                },
                'Album\Model\Album' => function($sm) {
                    $repository = $sm->get('Album\Resource\Mandango\AlbumRepository');
                    return new \Album\Model\Album($repository);
                },
                'Album\Mondator' => function($sm) {
                    $config = $sm->get('Config');
                    $mondator = new \Mandango\Mondator\Mondator();
                    $schemaConfigDir = isset($config['mandango']['mondator']['schema_config_dir'])
                        ? $config['mandango']['mondator']['schema_config_dir']
                        : './module/Album/config/schema/mandango';
                    $documentConfig = new \Zf2mandango\Mondator\Config\Processor($schemaConfigDir);
                    $mondator->setConfigClasses($documentConfig->output());
                    $resourcesOutputDir = isset($config['mandango']['mondator']['resources_output_dir'])
                        ? $config['mandango']['mondator']['resources_output_dir']
                        : './module/Album/src/Album/Resource/Mandango';
                    $mondator->setExtensions(
                        array(
                            new \Mandango\Extension\Core(
                                array(
                                    'metadata_factory_class'  => 'Album\Resource\Mandango\Mapping\MetadataFactory',
                                    'metadata_factory_output' => $resourcesOutputDir . '/Mapping',
                                    'default_output'          => $resourcesOutputDir,
                                )
                            ),
                            new \Zf2mandango\Mandango\Extension\DocumentArraySerializable(),
                        )
                    );
                    return $mondator;
                }
            ),
        );
    }
}


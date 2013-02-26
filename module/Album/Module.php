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
                    $metadataFactory = new \Album\Resource\Mandango\Mapping\MetadataFactory();
                    $cache = new \Mandango\Cache\FilesystemCache('./data/cache/mandango');
                    $logger = $sm->get('Logger');
                    $mandangoLogger = function(array $log) use ($logger) {
                        $logger->info('Mandango query logger', $log);
                    };
                    $mandango = new \Mandango\Mandango($metadataFactory, $cache, $mandangoLogger);
                    $config = $sm->get('Config');
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
            ),
        );
    }
}


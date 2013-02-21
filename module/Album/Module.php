<?php

namespace Album;

use Album\Model\Album;
use Mandango\Cache\FilesystemCache;
use Mandango\Connection;
use Mandango\Mandango;
use AntonStoeckl\Resources\Mapping\MetadataFactory;
use Zend\Log\Writer\FirePhp as FirePhpWriter;
use Zend\Log\Logger;
use Zend\Log\Formatter\FirePhp as FirePhpFormatter;

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
                    return new FirePhpFormatter();
                },
                'LogWriter' => function($sm) {
                    return new FirePhpWriter();
                },
                'Logger' => function($sm) {
                    $logger = new Logger();
                    $writer = $sm->get('LogWriter');
                    $formatter = $sm->get('LogFormatter');
                    $writer->setFormatter($formatter);
                    $logger->addWriter($writer);
                    return $logger;
                },
                'Mandango' => function($sm) {
                    $metadataFactory = new MetadataFactory();
                    $cache = new FilesystemCache('./data/cache/mandango');
                    $logger = $sm->get('Logger');
                    $mandangoLogger = function(array $log) use ($logger) {
                        $logger->info('Mandango query logger', $log);
                    };
                    $mandango = new Mandango($metadataFactory, $cache, $mandangoLogger);
                    $config = $sm->get('Config');
                    $mongoDbConfig = isset($config['mongodb'])
                        ? $config['mongodb']
                        : array('uri' => 'mongodb://localhost:27017', 'database' => 'default');
                    $connection = new Connection(
                        $mongoDbConfig['uri'],
                        $mongoDbConfig['database']
                    );
                    $mandango->setConnection('primary', $connection);
                    $mandango->setDefaultConnectionName('primary');
                    return $mandango;
                },
                'AntonStoeckl\Resources\AlbumRepository' => function($sm) {
                    $mandango = $sm->get('Mandango');
                    return $mandango->getRepository('AntonStoeckl\Resources\Album');
                },
                'Album\Model\Album' => function($sm) {
                    $repository = $sm->get('AntonStoeckl\Resources\AlbumRepository');
                    return new Album($repository);
                },
            ),
        );
    }
}


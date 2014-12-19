<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Elasticsearch
 *
 * PHP version 5.5
 *
 * @category   test
 * @package    Elasticsearch
 * @subpackage Tests
 * @author     Ralph Zickert <ralph.zickert@0xz.de>
 * @license    MIT https://github.com/xeroxzone/elasticsearch/blob/master/LICENSE
 * @version    GIT: $Id$
 */

namespace Xz\Elasticsearch\Tests\Libraries;

use Monolog\Handler\SyslogHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Silex\Application;
use Silex\WebTestCase;
use Xz\Elasticsearch\ElasticsearchServiceProvider;
use Xz\Elasticsearch\Libraries\ElasticsearchLibrary;

/**
 * Elasticsearch
 *
 * Elasticsearch Library Test
 *
 * @category   test
 * @package    Elasticsearch
 * @subpackage Tests
 * @author     Ralph Zickert <ralph.zickert@0xz.de>
 * @license    MIT https://github.com/xeroxzone/elasticsearch/blob/master/LICENSE
 * @see        WebTestCase
 */
class ElasticsearchLibraryTest extends WebTestCase
{
    /**
     * @var Application
     */
    protected $app;

    public function createApplication()
    {
        $app = new Application();
        $app['elasticsearchLogPath'] = __DIR__;
        $app['debug'] = true;
        $app['session.test'] = true;
        $app['exception_handler']->disable();

        $logger    = new Logger('log');
        $handler   = new SyslogHandler('elasticsearch');
        $processor = new IntrospectionProcessor();

        $logger->pushHandler($handler);
        $logger->pushProcessor($processor);

        $app->register(new ElasticsearchServiceProvider(), [
            'elasticsearch.options' => [
                'hosts' => [
                    'localhost:9200'
                ],
                'connectionParams' => [
                    'auth' => [
                        'username',
                        'password',
                        'Basic'
                    ]
                ],
                'logging' => true,
                'logObject' => $logger
            ]
        ]);

        return $app;
    }

    public function testConnection()
    {
        /** @var ElasticsearchLibrary $elasticsearch */
        $elasticsearch = $this->app['elasticsearch'];
        $client = $elasticsearch->getClient();

        $this->assertTrue($client->ping(), 'Elaticsearch client not reachable!');
    }

    public function testIndexCreate()
    {
        /** @var ElasticsearchLibrary $elasticsearch */
        $elasticsearch = $this->app['elasticsearch'];
        $client = $elasticsearch->getClient();

        $indexParams = [
            'index' => 'test_index'
        ];

        if ($client->indices()->exists($indexParams) === false) {
            $index = $client->indices()->create($indexParams);
            $this->assertTrue(\is_array($index));
        } else {
            $this->assertTrue($client->indices()->exists($indexParams));
        }
    }

    public function testIndex()
    {
        /** @var ElasticsearchLibrary $elasticsearch */
        $elasticsearch = $this->app['elasticsearch'];
        $client = $elasticsearch->getClient();

        $params = [
            'index' => 'test_index',
            'type' => 'test_type',
            'body' => [
                'testfield' => 'testcontent'
            ]
        ];

        $document = $client->index($params);

        $this->assertTrue(\is_array($document));

        if (\is_array($document)) {
            $this->assertArrayHasKey('created', $document);
            if (array_key_exists('created', $document)) {
                $this->assertTrue($document['created']);
            }
        }
    }

    public function testSearch()
    {
        /** @var ElasticsearchLibrary $elasticsearch */
        $elasticsearch = $this->app['elasticsearch'];
        $client = $elasticsearch->getClient();

        $params = [
            'index' => 'test_index',
            'type' => 'test_type',
            'body' => [
                'query' => [
                    'match' => [
                        'testfield' => 'testcontent'
                    ]
                ]
            ],
            "size" => 25,
            'ignore' => [400, 404]
        ];

        $results = $client->search($params);

        $total = $results['hits']['total'];

        $this->assertGreaterThanOrEqual(0, $total);
    }

    public function testIndexDelete()
    {
        /** @var ElasticsearchLibrary $elasticsearch */
        $elasticsearch = $this->app['elasticsearch'];
        $client = $elasticsearch->getClient();

        $indexParams = [
            'index' => 'test_index'
        ];

        if ($client->indices()->exists($indexParams) === true) {
            $index = $client->indices()->delete($indexParams);
            $this->assertTrue(\is_array($index));
        }
    }
}

<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Elasticsearch
 *
 * PHP version 5.5
 *
 * @category   library
 * @package    Elasticsearch
 * @author     Ralph Zickert <ralph.zickert@0xz.de>
 * @license    MIT https://github.com/xeroxzone/elasticsearch/blob/master/LICENSE
 * @version    GIT: $Id$
 */
namespace Xz\Elasticsearch;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Xz\Elasticsearch\Libraries\ElasticsearchLibrary;

/**
 * Elasticsearch
 *
 * Elasticsearch Service Provider
 *
 * @category   library
 * @package    Elasticsearch
 * @author     Ralph Zickert <ralph.zickert@0xz.de>
 * @license    MIT https://github.com/xeroxzone/elasticsearch/blob/master/LICENSE
 * @see        ServiceProviderInterface
 */
class ElasticsearchServiceProvider implements ServiceProviderInterface
{
    const ELASTICSEARCH_OPTIONS_KEY = 'elasticsearch.options';

    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['elasticsearch'] = $app->share(
            function () use ($app) {
                if (!isset($app[self::ELASTICSEARCH_OPTIONS_KEY])) {
                    throw new \InvalidArgumentException('Missing parameters: ' . self::ELASTICSEARCH_OPTIONS_KEY);
                }
                $application = new ElasticsearchLibrary($app[self::ELASTICSEARCH_OPTIONS_KEY]);
                return $application;
            }
        );
    }

    /**
     * @param Application $app
     * @return void
     */
    public function boot(Application $app)
    {

    }
}

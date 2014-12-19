<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Elasticsearch
 *
 * PHP version 5.5
 *
 * @category   library
 * @package    Elasticsearch
 * @subpackage Libraries
 * @author     Ralph Zickert <ralph.zickert@0xz.de>
 * @license    MIT https://github.com/xeroxzone/elasticsearch/blob/master/LICENSE
 * @version    GIT: $Id$
 */
namespace Xz\Elasticsearch\Libraries;

use Elasticsearch\Client;
use Silex\Application;

/**
 * Elasticsearch
 *
 * Elasticsearch Library
 *
 * @category   library
 * @package    Elasticsearch
 * @subpackage Libraries
 * @author     Ralph Zickert <ralph.zickert@0xz.de>
 */
class ElasticsearchLibrary
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Create a new Elasticsearch\Client()
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->client = new Client($options);
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}

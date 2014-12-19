<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Elasticsearch
 *
 * PHP version 5.5
 *
 * @category   library
 * @package    Elasticsearch
 * @subpackage Traits
 * @author     Ralph Zickert <ralph.zickert@0xz.de>
 * @license    MIT https://github.com/xeroxzone/elasticsearch/blob/master/LICENSE
 * @version    GIT: $Id$
 */
namespace Xz\Elasticsearch\Traits;

use Silex\Application;
use Xz\Elasticsearch\Libraries\ElasticSearchLibrary;

/**
 * Elasticsearch
 *
 * Elasticsearch Trait
 *
 * @category   trait
 * @package    Elasticsearch
 * @subpackage Traits
 * @author     Ralph Zickert <ralph.zickert@0xz.de>
 * @license    MIT https://github.com/xeroxzone/elasticsearch/blob/master/LICENSE
 * @version    Release: 0.1.0
 * @abstract
 */
trait ElasticsearchTrait
{
    /**
     * @return \Elasticsearch\Client
     */
    public function elasticsearch()
    {
        /** @var Application $this */
        /** @var ElasticsearchLibrary $elasticsearch */
        $elasticsearch = $this['elasticsearch'];
        return $elasticsearch->getClient();
    }
}

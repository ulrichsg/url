<?php
/**
* This file is part of the League.url library
*
* @license http://opensource.org/licenses/MIT
* @link https://github.com/thephpleague/url/
* @version 3.2.0
* @package League.url
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace League\Url;

use League\Url\Interfaces\Url as UrlInterface;

/**
 * A Immutable Value Object class to manipulate URLs
 *
 *  @package League.url
 *  @since  3.0.0
 */
class UrlImmutable extends AbstractUrl implements UrlInterface
{
    /**
     * To Enable cloning
     */
    public function __clone()
    {
        $this->scheme = clone $this->scheme;
        $this->user = clone $this->user;
        $this->pass = clone $this->pass;
        $this->host = clone $this->host;
        $this->port = clone $this->port;
        $this->path = clone $this->path;
        $this->query = clone $this->query;
        $this->fragment = clone $this->fragment;
    }

    /**
     * {@inheritdoc}
     */
    public function setScheme($data)
    {
        $clone = clone $this;
        $clone->scheme->set($data);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function getScheme()
    {
        return clone $this->scheme;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser($data)
    {
        $clone = clone $this;
        $clone->user->set($data);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser()
    {
        return clone $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setPass($data)
    {
        $clone = clone $this;
        $clone->pass->set($data);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function getPass()
    {
        return clone $this->pass;
    }

    /**
     * {@inheritdoc}
     */
    public function setHost($data)
    {
        $clone = clone $this;
        $clone->host->set($data);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function getHost()
    {
        return clone $this->host;
    }

    /**
     * {@inheritdoc}
     */
    public function setPort($data)
    {
        $clone = clone $this;
        $clone->port->set($data);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function getPort()
    {
        return clone $this->port;
    }

    /**
     * {@inheritdoc}
     */
    public function setPath($data)
    {
        $clone = clone $this;
        $clone->path->set($data);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return clone $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuery($data)
    {
        $clone = clone $this;
        $clone->query->set($data);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery()
    {
        return clone $this->query;
    }

    /**
     * {@inheritdoc}
     */
    public function setFragment($data)
    {
        $clone = clone $this;
        $clone->fragment->set($data);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function getFragment()
    {
        return clone $this->fragment;
    }
}

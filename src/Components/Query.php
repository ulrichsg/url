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
namespace League\Url\Components;

use ArrayAccess;
use InvalidArgumentException;
use League\Url\Interfaces\Component;
use League\Url\Interfaces\Query as QueryInterface;
use RuntimeException;
use Traversable;

/**
 *  A class to manipulate URL Query component
 *
 *  @package League.url
 *  @since  1.0.0
 */
class Query extends AbstractContainer implements QueryInterface, ArrayAccess
{
    /**
     * The Constructor
     *
     * @param mixed $data can be string, array or Traversable
     *                    object convertible into Query String
     */
    public function __construct($data = null)
    {

        $this->set($data);
    }

    /**
     * {@inheritdoc}
     */
    public function set($data)
    {
        if (! is_null($data) && ! static::isStringable($data)) {
            throw new InvalidArgumentException('set expects an stringable argument');
        }
        $this->data = $this->validate($this->extractDataFromString($data));
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        if (!$this->data) {
            return null;
        }

        return str_replace(
            array('%E7', '+'),
            array('~', '%20'),
            http_build_query($this->data, '', '&')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getUriComponent()
    {
        $value = $this->__toString();
        if ('' != $value) {
            return '?'.$value;
        }

        return $value;
    }

    /**
     * Return a Query Parameter
     *
     * @param string $key     the query parameter key
     * @param mixed  $default the query parameter default value
     *
     * @return mixed
     */
    public function getParameter($key, $default = null)
    {
        $res = $this->offsetGet($key);
        if (is_null($res)) {
            return $default;
        }

        return $res;
    }

    /**
     * Query Parameter Setter
     *
     * @param string $key   the query parameter key
     * @param mixed  $value the query parameter value
     */
    public function setParameter($key, $value)
    {
        if (is_null($key)) {
            throw new RuntimeException('offset can not be null');
        }
        $this->modify(array($key => $value));
    }

    /**
     * {@inheritdoc}
     */
    public function modify($data)
    {
        $data = array_merge($this->data, $this->validate($data));

        $this->data = array_filter($data, function ($value) {
            if (is_string($value)) {
                $value = trim($value);
            }

            return null !== $value && '' !== $value;
        });
    }

    protected function extractDataFromString($str)
    {
        $str = (string) $str;
        if ('' == $str) {
            return array();
        }

        if ('?' == $str[0]) {
            $str = substr($str, 1);
        }

        $str = preg_replace_callback('/(?:^|(?<=&))[^=[]+/', function ($match) {
            return bin2hex(urldecode($match[0]));
        }, $str);
        parse_str($str, $arr);

        //hexbin does not work in PHP 5.3
        $arr = array_combine(array_map(function ($value) {
            return pack('H*', $value);
        }, array_keys($arr)), $arr);

        return $arr;
    }

    /**
     * {@inheritdoc}
     */
    protected function validate($data)
    {
        if ($data instanceof Traversable) {
            return iterator_to_array($data);
        } elseif (is_array($data)) {
            return $data;
        }

        $data = (string) $data;
        $data = trim($data);

        return $this->extractDataFromString($data);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        if (isset($this->data[$offset])) {
            return $this->data[$offset];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        return $this->setParameter($offset, $value);
    }
}

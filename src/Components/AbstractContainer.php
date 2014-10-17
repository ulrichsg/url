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

use ArrayIterator;
use Countable;
use IteratorAggregate;
use League\Url\Interfaces\Component;

/**
 *  A class to manipulate URL Array like components
 *
 *  @package League.url
 *  @since  3.0.0
 */
abstract class AbstractContainer implements IteratorAggregate, Countable
{
    /**
     * container holder
     *
     * @var array
     */
    protected $data = array();

    /**
     * return a array representation of the data
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * return the array keys
     *
     * @return array
     */
    public function keys()
    {
        $args = func_get_args();
        if (! $args) {
            return array_keys($this->data);
        }

        return array_keys($this->data, $args[0], true);
    }

    /**
     * IteratorAggregate Interface method
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Countable Interface method
     *
     * @return integer
     */
    public function count($mode = COUNT_NORMAL)
    {
        return count($this->data, $mode);
    }

    /**
     * Tell whether the data can be converted into a string
     *
     * @param mixed $data
     *
     * @return boolean
     */
    public static function isStringable($data)
    {
        return is_string($data) || (is_object($data)) && (method_exists($data, '__toString'));
    }

    /**
     * {@inheritdoc}
     */
    public function sameValueAs(Component $component)
    {
        return $this->__toString() === $component->__toString();
    }
}

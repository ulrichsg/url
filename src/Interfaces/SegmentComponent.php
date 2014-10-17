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
namespace League\Url\Interfaces;

/**
 *  A class to manipulate URL Query component
 *
 *  @package League.url
 *  @since  1.0.0
 */
interface SegmentComponent extends Component
{
    /**
     * return a array representation of the data
     *
     * @return array
     */
    public function toArray();

    /**
     * return the array keys
     *
     * @return array
     */
    public function keys();

    /**
     * Append data to the component
     *
     * @param mixed   $data         the data can be a array, a Traversable or a string
     * @param string  $whence       where the data should be prepended to
     * @param integer $whence_index the recurrence index of $whence
     *
     * @return void
     */
    public function append($data, $whence = null, $whence_index = null);

    /**
     * Prepend data to the component
     *
     * @param mixed   $data         the data can be a array, a Traversable or a string
     * @param string  $whence       where the data should be prepended to
     * @param integer $whence_index the recurrence index of $whence
     *
     * @return void
     */
    public function prepend($data, $whence = null, $whence_index = null);

    /**
     * Remove part of the component
     *
     * @param mixed $data the data can be a array, a Traversable or a string
     *
     * @return void
     */
    public function remove($data);

    /**
     * Return a Segment Parameter
     *
     * @param integer $key     the query parameter key
     * @param mixed   $default the query parameter default value
     *
     * @return mixed
     */
    public function getSegment($key, $default = null);

    /**
     * Segment Parameter Setter
     *
     * @param integer $key   the query parameter key
     * @param mixed   $value the query parameter value
     */
    public function setSegment($key, $value);
}

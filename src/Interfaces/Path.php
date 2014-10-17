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
interface Path extends SegmentComponent
{
    /**
     * Return a new Path relative to the given Path
     *
     * @param Path $path
     *
     * @return Path
     */
    public function relativeTo(Path $path = null);
}

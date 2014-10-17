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
 *  A class to manipulate URL Host component
 *
 *  @package League.url
 *  @since  1.0.0
 */
interface Host extends Path
{
    /**
     * Tell wether the host is an IPV4 IP
     *
     * @return boolean
     */
    public function isIpv4();

    /**
     * Tell wether the host is an IPV6 IP
     *
     * @return boolean
     */
    public function isIpv6();

    /**
     * Tell wether the host is an IP
     *
     * @return boolean
     */
    public function isIp();

    /**
     * Return the unicode string representation of a hostname
     *
     * @return string
     */
    public function toUnicode();

    /**
     * Return the ascii string representation of a hostname
     *
     * @return string
     */
    public function toAscii();
}

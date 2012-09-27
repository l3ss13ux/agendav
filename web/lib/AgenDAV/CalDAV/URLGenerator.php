<?php
namespace AgenDAV\CalDAV;

/*
 * Copyright 2012 Jorge López Pérez <jorge@adobo.org>
 *
 *  This file is part of AgenDAV.
 *
 *  AgenDAV is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  AgenDAV is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with AgenDAV.  If not, see <http://www.gnu.org/licenses/>.
 */

class URLGenerator
{
    private $principal_template;
    private $base;
    private $calendar_homeset_template;
    private $CI;

    public function __construct($base, $principal_template, $calendar_homeset_template) {
        $this->base = $base;
        $this->principal_template = $principal_template;
        $this->calendar_homeset_template = $calendar_homeset_template;
    }

    /**
     * Builds a principal URL
     *
     * @param string $username User name
     * @param bool $absolute Use absolute URL or relative
     *
     * @return string Principal URL
     */
    public function generatePrincipal($username, $absolute = false)
    {
        $url = preg_replace(
            '/%u/',
            $username,
            $this->principal_template
        );

        return $absolute ? $url : $this->getPath($url);
    }


    /**
     * Builds the calendar-home-set URL
     *
     * @param string $username User name
     * @param bool $absolute Use absolute URL or relative
     *
     * @return string Calendar home set URL
     */
    public function generateCalendarHomeSet($username, $absolute = false)
    {
        $url = preg_replace(
            '/%u/',
            $username,
            $this->calendar_homeset_template
        );

        return $absolute ? $url : $this->getPath($url);
    }

    /**
     * Extracts path from a provided URL 
     * 
     * @param string $url URL
     * @return string Path from the URL
     */
    private function getPath($url)
    {
        $parsed = parse_url($url);

        return $parsed['path'];
    }

}
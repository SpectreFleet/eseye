<?php
/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015, 2016, 2017  Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace Seat\Eseye\Cache;


/**
 * Class FileCache
 * @package Seat\Eseye\Cache
 */
class FileCache implements CacheInterface
{

    /**
     * @param string $key
     * @param string $value
     * @param string $expires
     *
     * @return mixed
     */
    public function set(string $key, string $value, string $expires)
    {
        // TODO: Implement set() method.
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return mixed
     */
    public function get(string $key, string $value)
    {
        // TODO: Implement get() method.
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function forget(string $key)
    {
        // TODO: Implement forget() method.
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return mixed
     */
    public function has(string $key, string $value)
    {
        // TODO: Implement has() method.
    }
}
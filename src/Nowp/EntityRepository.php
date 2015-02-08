<?php
/**
 *
 */

namespace Nowp\Common;


interface EntityRepository 
{
    /**
     * Persists and Entity to storage
     *
     * @param Entity $entity
     * @return mixed
     */
    function save(Entity $entity);
}
<?php

namespace HubSpot\Discovery\Crm;

use HubSpot\Discovery\DiscoveryBase;

class ObjectDiscovery extends DiscoveryBase
{
    public function getAll($properties = null, $associations = null, $archived = false): array
    {
        $objects = [];
        $after = null;

        do {
            $page = $this->basicApi()
                ->getPage(100, $after, $properties, $associations, $archived)
            ;

            $objects = array_merge($objects, $page->getResults());

            if (!is_null($page->getPaging())) {
                $after = $page->getPaging()->getNext()->getAfter();
            }
        } while (is_object($page) && $page->getPaging());

        return $objects;
    }
}

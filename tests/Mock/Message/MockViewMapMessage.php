<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Message;

use OpenTribes\Core\Message\ViewMapMessage;
use OpenTribes\Core\Utils\Location;
use OpenTribes\Core\Utils\Viewport;
use OpenTribes\Core\View\MapView;

final class MockViewMapMessage implements ViewMapMessage
{
    public ?MapView $map = null;
    public function __construct(private ?Viewport $viewport = null)
    {
        if(!$this->viewport){
            $this->viewport =  new Viewport(new Location(1, 1), 3, 3);
        }
    }

    public function getViewport(): Viewport
    {
      return $this->viewport;
    }

    public function setMap(MapView $map):void
    {
       $this->map =$map;
    }

}
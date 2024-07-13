<?php

namespace psycofeu\antiFallDamage;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
    protected function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->notice("Plugin enable");
        $this->saveDefaultConfig();
    }
    public function onFallDamage(EntityDamageEvent $event)
    {
        if ($event->getCause() === EntityDamageEvent::CAUSE_FALL){
            if ($this->getConfig()->get("in_all_world")){
                $event->cancel();
            }else{
                if (in_array($event->getEntity()->getWorld()->getFolderName(), $this->getConfig()->get("world_enable"))){
                    $event->cancel();
                }
            }
        }
    }
}
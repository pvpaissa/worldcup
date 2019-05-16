<?php

namespace Cleanse\WorldCup\Components;

use Redirect;
use Cms\Classes\ComponentBase;

use Cleanse\WorldCup\Models\Prize;

class AdminPrize extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'World Cup Prize Admin',
            'description' => 'Admin for prize overlay.'
        ];
    }

    public function onRun()
    {
        $this->addCss('/plugins/cleanse/event/assets/css/events.css');
        $this->addJs('/plugins/cleanse/event/assets/js/events.js');

        $this->page['prize'] = $this->getPrize();
    }

    public function onUpdatePrize()
    {
        $post = post();

        $this->updatePrize($post);

        return Redirect::to('/world-cup/manage-prize');
    }

    private function updatePrize($post)
    {
        $getPrize = Prize::find(1);
        $getPrize->value = $post['event-prize'];

        $getPrize->save();
    }

    private function getPrize()
    {
        $prize = Prize::find(1);

        if (!isset($prize)) {
            return [];
        }

        return $prize->value;
    }
}

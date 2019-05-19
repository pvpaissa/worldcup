<?php

namespace Cleanse\WorldCup\Components;

use Cookie;
use Redirect;
use Cms\Classes\ComponentBase;

use Cleanse\WorldCup\Models\Team;

class Results extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'            => 'Feast World Cup Results',
            'description'     => 'Displays results page for The Feast World Cup.'
        ];
    }

    public function onRun()
    {
        $this->page['lang'] = $this->getLanguage();
        $this->page['regions'] = $this->regionNames();
        $this->page['regionals'] = $this->getRegionalQualifiers();
        $this->page['main_groups'] = $this->getMainGroups();
    }

    private function regionNames()
    {
        return [
            'eu' => 'European',
            'jp' => 'Japanese',
            'na' => 'North American'
        ];
    }

    private function getRegionalQualifiers()
    {
        return [
            'jp' => [
                'teams' => [
                    'Z†Fanclub',
                    'CrimeWolf',
                    'Sfidante',
                    'Gangster Inn'
                ],
                'links' => [
                    'Group Stage' => 'fwc-jp-regional-qualifier-groups',
                    'Bracket Stage' => 'japan-regional-qualifiers-bracket-stage'
                ]
            ],
            'eu' => [
                'teams' => [
                    'Who?',
                    'A-Pork-Calypse',
                    'Trois Pourcents'
                ],
                'links' => [
                    'Bracket Stage' => 'fwc-eu-regional-qualifiers'
                ]
            ],
            'na' => [
                'teams' => [
                    'bUrself',
                    'Insert Name',
                    'Suboptimal',
                    'Lester and Friends'
                ],
                'links' => [
                    'Bracket Stage' => 'fwc-na-regional-qualifiers'
                ]
            ]
        ];
    }

    private function getMainGroups()
    {
        return [
            'groups' => [
                '1' => [
                    'CrimeWolf',
                    'bUrself',
                    'Trois Pourcents'
                ],
                '2' => [
                    'Gangster Inn',
                    'Suboptimal',
                    'A-Pork-Calypse'
                ],
                '3' => [
                    'Sfidante',
                    'Lester and Friends',
                    'Who?'
                ],
                '4' => [
                    'Z†Fanclub',
                    'Insert Name'
                ],
            ],
            'links' => [
                'Main Event: Group Stage' => 'the-feast-world-cup-main-event-group-stage'
            ]
        ];
    }

    private function getLanguage()
    {
        $lang = Cookie::get('lang');

        if (isset($lang)) {
            $language = $lang;
        } else {
            $language = 'en';
        }

        return $language;
    }

    public function onSetLanguage()
    {
        $language = post('lang');
        $languages = ['en', 'jp'];

        if (in_array($language, $languages)) {
            return redirect('/world-cup/results')
                ->withCookie(Cookie::forever('lang', $language));
        }

        return Redirect::to('/');
    }
}

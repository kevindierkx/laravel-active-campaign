<?php

namespace Label84\ActiveCampaign\Factories;

use Label84\ActiveCampaign\DataObjects\ActiveCampaignList;

class ListFactory
{
    public static function make(array $attributes): ActiveCampaignList
    {
        return new ActiveCampaignList(
            intval($attributes['id']),
            $attributes['name'],
        );
    }
}

<?php

namespace Label84\ActiveCampaign\Facades;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Facade;
use Label84\ActiveCampaign\Resources\ActiveCampaignContactsResource;
use Label84\ActiveCampaign\Resources\ActiveCampaignFieldValuesResource;
use Label84\ActiveCampaign\Resources\ActiveCampaignListsResource;
use Label84\ActiveCampaign\Resources\ActiveCampaignTagsResource;

/**
 * @method PendingRequest                    makeRequest()
 * @method ActiveCampaignContactsResource    contacts()
 * @method ActiveCampaignFieldValuesResource fieldValues()
 * @method ActiveCampaignTagsResource        tags()
 * @method ActiveCampaignListsResource       lists()
 */
class ActiveCampaign extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'active-campaign';
    }
}

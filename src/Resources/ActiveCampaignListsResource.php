<?php

namespace Label84\ActiveCampaign\Resources;

use Illuminate\Support\Collection;
use Label84\ActiveCampaign\DataObjects\ActiveCampaignList;
use Label84\ActiveCampaign\Factories\ListFactory;

class ActiveCampaignListsResource extends ActiveCampaignBaseResource
{
    public function get(int $id): ActiveCampaignList
    {
        $list = $this->request(
            method: 'get',
            path: 'lists/'.$id,
            responseKey: 'list'
        );

        return ListFactory::make($list);
    }

    public function list(array $query = []): Collection
    {
        $lists = $this->request(
            method: 'get',
            path: 'lists',
            data: $query,
            responseKey: 'lists'
        );

        return (new Collection($lists))
            ->map(fn ($list) => ListFactory::make($list));
    }
}

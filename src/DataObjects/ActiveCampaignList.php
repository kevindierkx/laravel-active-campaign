<?php

namespace Label84\ActiveCampaign\DataObjects;

class ActiveCampaignList
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {
    }
}

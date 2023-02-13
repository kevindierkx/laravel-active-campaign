<?php

namespace Label84\ActiveCampaign\Resources;

use Illuminate\Support\Collection;
use Label84\ActiveCampaign\DataObjects\ActiveCampaignContact;
use Label84\ActiveCampaign\Exceptions\ActiveCampaignException;
use Label84\ActiveCampaign\Factories\ContactFactory;

class ActiveCampaignContactsResource extends ActiveCampaignBaseResource
{
    /**
     * Retreive an existing contact by their id.
     *
     * @param int $id
     *
     * @return ActiveCampaignContact
     */
    public function get(int $id): ActiveCampaignContact
    {
        $contact = $this->request(
            method: 'get',
            path: 'contacts/'.$id,
            responseKey: 'contact'
        );

        return ContactFactory::make($contact);
    }

    /**
     * List all contact, search contacts, or filter contacts by query defined criteria.
     *
     * @param array $query
     *
     * @return Collection<int, ActiveCampaignContact>
     */
    public function list(array $query = []): Collection
    {
        $contacts = $this->request(
            method: 'get',
            path: 'contacts',
            data: $query,
            responseKey: 'contacts'
        );

        return collect($contacts)
            ->map(fn ($contact) => ContactFactory::make($contact));
    }

    /**
     * Create a contact and get the contact id.
     *
     * @param string $email
     * @param array  $attributes
     *
     * @throws ActiveCampaignException
     *
     * @return string
     */
    public function create(string $email, array $attributes = []): string
    {
        $contact = $this->request(
            method: 'post',
            path: 'contacts',
            data: [
                'contact' => [
                    'email' => $email,
                ] + $attributes,
            ],
            responseKey: 'contact'
        );

        return $contact['id'];
    }

    /**
     * Update an existing contact.
     *
     * @param ActiveCampaignContact $contact
     *
     * @throws ActiveCampaignException
     *
     * @return ActiveCampaignContact
     */
    public function update(ActiveCampaignContact $contact): ActiveCampaignContact
    {
        $contact = $this->request(
            method: 'put',
            path: 'contacts/'.$contact->id,
            data: [
                'contact' => [
                    'email' => $contact->email,
                    'firstName' => $contact->firstName,
                    'lastName' => $contact->lastName,
                    'phone' => $contact->phone,
                ],
            ],
            responseKey: 'contact'
        );

        return ContactFactory::make($contact);
    }

    /**
     * Delete an existing contact by their id.
     *
     * @param int $id
     *
     * @throws ActiveCampaignException
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $this->request(
            method: 'delete',
            path: 'contacts/'.$id
        );
    }

    public function subscribe(int $id, int $listId): string
    {
        $contactList = $this->request(
            method: 'post',
            path: 'contactList',
            data: [
                'contactList' => [
                    'contact' => $id,
                    'list' => $listId,
                    'status' => 1,
                ],
            ],
            responseKey: 'contactList'
        );

        return $contactList['id'];
    }

    /**
     * Add a tag to a contact.
     *
     * @see https://developers.activecampaign.com/reference/create-contact-tag
     *
     * @param int $id
     * @param int $tagId
     *
     * @throws ActiveCampaignException
     *
     * @return string
     */
    public function tag(int $id, int $tagId): string
    {
        $contactTag = $this->request(
            method: 'post',
            path: 'contactTags',
            data: [
                'contactTag' => [
                    'contact' => $id,
                    'tag' => $tagId,
                ],
            ],
            responseKey: 'contactTag'
        );

        return $contactTag['id'];
    }

    /**
     * Remove a tag from a contact.
     *
     * @see https://developers.activecampaign.com/reference#delete-contact-tag
     *
     * @param int $contactTagId
     *
     * @throws ActiveCampaignException
     *
     * @return void
     */
    public function untag(int $contactTagId): void
    {
        $this->request(
            method: 'delete',
            path: 'contactTags/'.$contactTagId
        );
    }
}

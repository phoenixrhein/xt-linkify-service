<?php

namespace de\xovatec\linkify\Services;

use DateTime;
use de\xovatec\linkify\Models\LinkList;
use Exception;
use Illuminate\Database\Eloquent\Collection;

/**
 * LinkService class
 */
class LinkService
{

    /**
     * 
     * @var UserService
     */
    private UserService $user;

    /**
     * 
     * @var LinkGroupService
     */
    private LinkGroupService $linkGroup;

    /**
     * LinkService constructor
     * 
     * @param UserService $user
     * @param LinkGroupService $linkGroup
     */
    public function __construct(UserService $user, LinkGroupService $linkGroup)
    {
        $this->user = $user;
        $this->linkGroup = $linkGroup;
    }

    /**
     * Get link list
     * 
     * @return Collection
     */
    public function getList(): Collection
    {
        $user = $this->user->getSessionUser();
        $defaultGroup = $this->linkGroup->getDefaultGroup($user);

        return LinkList::where('fk_link_group_id', $defaultGroup->id)->orderByDesc('id')->get();
    }

    /**
     * Add new link
     * 
     * @param string $link
     * @return boolean
     */
    public function add(string $link)
    {
        try {
            $user = $this->user->getSessionUser();
            $defaultGroup = $this->linkGroup->getDefaultGroup($user);
            $linkRow = new LinkList;
            $linkRow->link = $link;
            $linkRow->fk_link_group_id = $defaultGroup->id;
            $linkRow->save();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * MArk link as read
     * 
     * @param int $id
     * @return bool
     */
    public function markAsRead(int $id): bool
    {
        try {
            $link = LinkList::findOrFail($id);
            $link->read_at = new DateTime();
            $link->save();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

}

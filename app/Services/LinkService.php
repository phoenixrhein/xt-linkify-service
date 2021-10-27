<?php

namespace de\xovatec\linkify\Services;

use de\xovatec\linkify\Models\LinkList;

class LinkService
{

    /**
     * 
     * @var UserService
     */
    private UserService $user;
    private LinkGroupService $linkGroup;

    public function __construct(UserService $user, LinkGroupService $linkGroup)
    {
        $this->user = $user;
        $this->linkGroup = $linkGroup;
    }

    public function getList()
    {
        $user = $this->user->getSessionUser();
        $defaultGroup = $this->linkGroup->getDefaultGroup($user);

        return LinkList::where('fk_link_group_id', $defaultGroup->id)->get();
    }

    public function add()
    {
        
    }

    public function markAsRead()
    {
        
    }

}

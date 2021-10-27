<?php

namespace de\xovatec\linkify\Services;

use de\xovatec\linkify\Models\LinkGroup;
use de\xovatec\linkify\Models\User;

class LinkGroupService
{
    public function getDefaultGroup(User $user):? LinkGroup
    {
        return LinkGroup::first();
    }
}


<?php

namespace SecretParty\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SecretPartyUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

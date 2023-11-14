<?php

namespace App\Scopes;

use App\Scopes\FilterScope;

class ContactFilterScope extends FilterScope
{
    protected $filterColumns = ['company_id'];
}
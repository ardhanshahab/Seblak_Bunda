<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class CategoryScope implements DataTableScope
{
   
    public function apply($query)
    {
        return $query->onlyTrashed();
    }
}

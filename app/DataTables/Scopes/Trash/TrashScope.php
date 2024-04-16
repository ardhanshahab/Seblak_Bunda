<?php

namespace App\DataTables\Scopes\Trash;

use Yajra\DataTables\Contracts\DataTableScope;

class TrashScope implements DataTableScope
{
    public function apply($query)
    {
        return $query->onlyTrashed();
    }
}

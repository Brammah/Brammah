<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use App\Http\Traits\RecordAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use RecordAction;
    use InsertStatus;
    use Sluggable;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => ['name', 'phone'],
                'separator' => '-',
                'onUpdate'  => true,
            ],
        ];
    }
}

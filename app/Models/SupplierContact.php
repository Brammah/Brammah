<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use App\Http\Traits\RecordAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierContact extends Model
{
    use HasFactory;
    // use Sluggable;
    use RecordAction;
    use InsertStatus;

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name',
    //             'onUpdate' => true,
    //         ],
    //     ];
    // }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}

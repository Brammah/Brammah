<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use App\Http\Traits\RecordAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockProduct extends Model
{
    use HasFactory;
    use InsertStatus;
    use RecordAction;

    public function productRestock()
    {
        return $this->belongsTo(ProductRestock::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

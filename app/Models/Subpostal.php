<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Subpostal extends Model
    {
        protected $fillable = ['name','description','postal_id'];

        public function postal()  {
            return $this->hasOne(Postal::class, "id", "postal_id");
        }
    }

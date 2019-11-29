<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class TrailMarker extends Model
    {
        protected $fillable = ['name','location','description','road_accessible','nearest_postal_id'];

        public function nearest_postal() {
            return $this->hasOne(Postal::class, "id" , "nearest_postal_id");
        }
    }

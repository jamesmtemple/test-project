<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Postal extends Model
    {
        protected $fillable = ['common_name','name','description','jurisdiction','hazmat_alert','brush_alert','leo_alert','fire_station_id'];

        public function station() {
          return $this->hasOne(Station::class, "id", "fire_station_id");
        }
    }

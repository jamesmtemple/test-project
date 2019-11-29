<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Grid extends Model
    {
        protected $fillable = ['name','nearest_dock_id','nearest_helipad_id'];

        public function nearest_dock() {
            return $this->hasOne(Postal::class, "id" , "nearest_dock_id");
        }

        public function nearest_helipad() {
            return $this->hasOne(Postal::class, "id" , "nearest_helipad_id");
        }
    }

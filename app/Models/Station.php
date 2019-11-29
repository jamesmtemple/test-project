<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Station extends Model
    {
        protected $fillable = ['name','location','units'];

        public function types() {
            return $this->belongsToMany(Type::class);
        }

        public function setUnitsAttribute($array) {
            $this->attributes['units'] = json_encode($array);
        }
        public function getUnitsAttribute() {
            return json_decode($this->attributes['units'], true);
        }
    }

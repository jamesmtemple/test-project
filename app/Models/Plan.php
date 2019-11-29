<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Plan extends Model
    {
        public $fillable = ['name','type','response'];

        public function getTypeTextAttribute() {
            switch($this->type) {
              case 1:
                return "Fire & Rescue";
              case 2:
                return "Law Enforcement";
            }
        }
        
        public function setResponseAttribute($array) {
            $this->attributes['response'] = json_encode($array);
        }
        public function getResponseAttribute() {
            return json_decode($this->attributes['response'], true);
        }
    }

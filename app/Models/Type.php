<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Type extends Model
    {
        protected $fillable = ['name','abbr','type','department_id','division_id'];

        public function getTypeTextAttribute() {
            switch($this->type) {
                case 1:
                  return "Fire & Rescue";
                case 2:
                  return "Law Enforcement";
            }
        }

    }

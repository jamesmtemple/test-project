<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Department extends Model
    {
        protected $fillable = ['name','abbr','type'];

        public function roles() {
            return $this->hasMany(Role::class, "department_id", "id");
        }

        public function getTypeTextAttribute() {
            switch($this->type) {
              case 1:
                return "Civilian";
              case 2:
                return "Communications";
              case 3:
                return "Fire & Rescue";
              case 4:
                return "Law Enforcement";
            }
        }
    }

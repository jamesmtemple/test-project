<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Type extends Model
    {
        protected $fillable = ['name','abbr','type','department_id','division_id'];

        public function getScopeAttribute() {
            switch($this->type) {
                case 1:
                  return $this->department->name;
                case 2:
                  return $this->division->department->abbr . " - " . $this->division->name;
            }
        }

        public function department() {
            return $this->hasOne(Department::class,"id","department_id");
        }

        public function division() {
            return $this->hasOne(Division::class,"id","division_id");
        }
    }

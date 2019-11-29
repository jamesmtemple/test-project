<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Certification extends Model
    {
        protected $fillable = ['name','abbr','type','department_id','division_id'];

        public function getScopeAttribute() {
            switch($this->type) {
                case 1:
                  return $this->department->name;
                case 2:
                  return $this->division->name;
            }
        }

        public function department() {
            return $this->hasOne(Department::class,"id","department_id");
        }

        public function division() {
            return $this->hasOne(Division::class,"id","division_id");
        }

        public function permissions() {
          return $this->belongsToMany(Permission::class);
        }

        public function types() {
          return $this->belongsToMany(Type::class);
        }

        public function hasPermission($name) {
            $list = $this->permissions->map(function ($item, $key) use ($name ) {
                return $item->slug;
            });

            return $list->contains($name);
        }

        public function hasUnit($name) {
            return $this->types->pluck('name')->contains($name);
        }
    }

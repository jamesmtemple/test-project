<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Role extends Model
    {
        protected $fillable = ['name', 'type', 'department_id','division_id'];

        public function users() {
            return $this->belongsToMany(User::class);
        }

        public function getScopeAttribute() {
            switch($this->type) {
                case 1:
                  return "Global";
                case 2:
                  return $this->department->name;
                case 3:
                  return $this->division->name;
            }
        }

        public function permissions() {
            return $this->belongsToMany(Permission::class);
        }

        public function types() {
            return $this->belongsToMany(Type::class);
        }

        public function hasPermission($name) {
            $list = $this->permissions->map(function ($item, $key) {
                return $item->name;
            });

            return $list->contains($name);
        }

        public function department() {
            return $this->hasOne(Department::class,"id","department_id");
        }

        public function division() {
            return $this->hasOne(Division::class,"id","division_id");
        }

        public function hasUnit($name) {
            return $this->types->pluck('name')->contains($name);
        }
    }

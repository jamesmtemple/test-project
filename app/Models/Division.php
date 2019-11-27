<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Division extends Model
    {
        protected $fillable = ['department_id', 'name', 'abbr'];

        public function department() {
            return $this->hasOne(Department::class, "id", "department_id");
        }

        public function getDepartmentNameAttribute() {
            if(! $this->department_id) {
              return "All-Department";
            }

            return $this->department->name;
        }
    }

<?php namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Permission extends Model
    {
        protected $fillable = ['category', 'slug', 'description'];

        public function roles() {
            return $this->belongsToMany(Permission::class);
        }
    }

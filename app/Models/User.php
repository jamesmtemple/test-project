<?php namespace App\Models;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable
    {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name', 'discord_id', 'teamspeak_id',
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'remember_token',
        ];

        public function roles() {
            return $this->belongsToMany(Role::class);
        }

        public function certifications() {
            return $this->belongsToMany(Certification::class);
        }

        public function hasPermission($name) {
            $permissions = collect([]);

            foreach($this->roles as $role) {
                $permissions = $permissions->merge($role->permissions);
            }

            foreach($this->certifications as $certification) {
                $permissions = $permissions->merge($certification->permissions);
            }

            return $permissions->pluck('slug')->contains($name);
        }
    }

<?php namespace App\Http\Controllers\Account;
    use Illuminate\Http\Request;
    use RestCord\DiscordClient;
    use Illuminate\Support\Facades\Cache;
    use GuzzleHttp\Command\Exception\CommandClientException;
    use App\Models\User;
    use App\Models\Role;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Redirect;
    use App\Http\Controllers\Controller;

    class DiscordLoginController extends Controller
    {
        public function redirect() {
            return \Socialite::with('discord')
              ->redirect();
        }

        public function auth() {
            $user = \Socialite::with('discord')->user();

            $discord = new DiscordClient([
              'token' => config('services.discord.bot_key')
            ]);

            try {
              // The user is a Member of the MidWestRP Discord. We will now get a list roles the user has on the Discord,
              // and the convert them from their IDs (the default) to their name, which will be used to verify permissions in the CAD.
              $member = $discord
                ->guild
                ->getGuildMember(['guild.id' => (int) config('services.discord.guild_id'), 'user.id' => (int) $user->id]);

              $user = User::firstOrCreate([
                'discord_id' => $user->id,
                 'name' => \Str::before($member->user->username, " | ")
               ]);

              $user->roles()->sync($this->getUserRoles($discord, $member));

              Auth::login($user);

              return Redirect::home()
                ->with([
                  "msg.type"      => "success",
                  "msg.text"      => "You're now signed in. Welcome!"
                ]);

            } catch(CommandClientException $exception) {
              return Redirect::route('login')
                ->with([
                  "msg.type"      => "danger",
                  "msg.text"      => "You are not a Midwest RP Member."
                ]);
            } catch(\Exception $e) {
              return Redirect::route('login')
                ->with([
                  "msg.type"      => "danger",
                  "msg.text"      => "You are not permitted to access the CAD at this time. If you believe this is a mistake, please contact your Department COC."
                ]);
            }
        }

        public function logout() {
            Auth::logout();

            return Redirect::route("login")
              ->with([
                'msg.type'        => 'success',
                'msg.text'        => 'You are now signed out!'
              ]);
        }

        private function getUserRoles($discord, $member) {
            $serverRoles = Cache::remember("discord-roles", 10080, function() use ($discord){
                return $discord
                  ->guild
                  ->getGuildRoles(['guild.id' => (int) config('services.discord.guild_id')]);
            });

            $cadRoles = Cache::remember("roles", 10080, function() {
                return Role::all();
            });

            $roleNames = [];
            $userRoles = [];

            foreach($serverRoles as $role){
              if(in_array($role->id, $member->roles)) {
                $roleNames[] = $role->name;

                // The user has a role that is banned by the configuration. Using a trainee role.
                if(in_array($role->name, config('app.banned_roles'))) {
                  throw new \Exception;
                }
              }
            }

            foreach($cadRoles as $role) {
                if(in_array($role->name, $roleNames)) {
                    $userRoles[] = $role->id;
                }
            }

            return $userRoles;
        }
    }

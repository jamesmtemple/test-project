<?php namespace App\Http\Controllers\Account;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Auth;

    class SettingsController extends Controller
    {
        public function edit() {
            return view('account.settings');
        }

        public function update(Request $request) {
            Auth::user()
              ->update([
                'name'            => $request->name,
                'teamspeak_id'    => $request->teamspeak_id
              ]);

            return Redirect::home()
              ->with([
                'msg.type'        => 'success',
                'msg.text'        => 'Your account was edited successfully!'
              ]);
        }
    }

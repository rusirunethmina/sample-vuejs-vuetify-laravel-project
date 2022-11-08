<?php

namespace App\Http\Controllers;


use App\User;
use App\athlete_data_collection;
use App\Profile;
use App\Location;
use App\Event;
use App\Game;
use App\Helpers\UserSystemInfoHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class APIController extends Controller
{
    //---------------------------Check user login details-----------------------------------
    public function checkLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', '=', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                auth()->attempt(['email' => $email, 'password' => $password]);
                Auth::loginUsingId($user->id);
                auth()->user()->tokens->each(function ($token, $key) {
                    $token->delete();
                });
                $accessToken = auth()->user()->createToken('authToken')->accessToken;
                return response()->json(['http_status' => 'ok', 'validate' => 'success', 'user' => $user, 'access_token' => $accessToken], 200);
            } else {
                return response()->json(['http_status' => 'error', 'validate' => 'invalid_password'], 200);
            }
        } else {
            return response()->json(['http_status' => 'error', 'validate' => 'invalid_email'], 200);
        }
    }


    public function changePassword(Request $request)
    {
        $uid = $request->input('uid');
        $oldPW = $request->input('oldPW');
        $newPW = $request->input('newPW');

        $user = User::find($uid)->first();
        if ($user && Hash::check($oldPW, $user->password)) {
            $user->password = Hash::make($newPW);
            $user->save();
            return response()->json(['http_status' => 'success', 'message' => 'password updated successfully']);
        } else {
            return response()->json(['http_status' => 'error', 'message' => 'invalid password !']);
        }
    }

    public function getAlldataForCombobox(Request $request)
    {
        $eventCatagary = $request->input('eventCatagary');
        $values = athlete_data_collection::get();
        return response()->json(['http_status' => 'success', 'message' => 'Get All Mail Division Details', 'data' => $values], 200);
    }

    // public function getAlldataForCombobox()
    // {

    //     $event_data = athlete_data_collection::get();

    //     $game_data = athlete_data_collection::pluck('Game');
    //     $distric_data = athlete_data_collection::pluck('Distric');
    //     $gender_data = athlete_data_collection::pluck('Gender');

    //     if ($event_data) {
    //         return response()->json(['http_status' => 'success', 'message' => 'Get All Mail Division Details', 'data' => $event_data], 200);
    //         return response()->json(['http_status' => 'data is avalibale', 'event_data' => $event_data,'game_data' => $game_data, 'distric_data' => $distric_data, 'gender_data' => $gender_data], 200);
    //     } else {
    //         return response()->json(['http_status' => 'error']);
    //     }
    // }

    public function AllPlayers()
    {
        try {
            $total_players = athlete_data_collection::count();
            $secretariat = athlete_data_collection::where('D_Secretariat')->count();
            $game = athlete_data_collection::where('Game')->count();
            $male_players = athlete_data_collection::where('Gender', '=', 'Male')->count();
            $events = athlete_data_collection::where('Event')->count();
            $distric = athlete_data_collection::where('Distric')->count();
            return response()->json(['http_status' => 'success', 'total_players' => $total_players, 'secretariat' => $secretariat, 'game' => $game, 'male_players' => $male_players, 'events' => $events, 'distric' => $distric], 200);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $search_event = $request->input('search_event');
        $search_game = $request->input('search_game');
        $search_district = $request->input('search_district');
        $search_gender = $request->input('search_gender');

        try {
            if ($search_event) {
                $data = athlete_data_collection::where('Event', '=', $request->search_event)->count();
                $data = athlete_data_collection::where('D_Secretariat')->count();
                return $data;
            } else if ($search_game) {
                $data = athlete_data_collection::where('Game', '=', $request->search_game)->count();
                return $data;
            } else if ($search_district) {
                $data = athlete_data_collection::where('Distric', '=', $request->search_district)->count();
            } else if ($search_gender) {
                $data = athlete_data_collection::where('Gender', '=', $request->search_gender)->count();
            } else if ($search_event || $search_game) {
                $data = athlete_data_collection::where('Event', '=', $request->search_event)->where('Game', '=', $request->search_game)->count();
            } else if ($program_name || $status) {
                $data = athlete_data_collection::where('name', '=', $request->programName)->where('current_stage', '=', $request->projectStatus)->count();
            } else if ($distric || $status) {
                $data = athlete_data_collection::where('district_secretariat', '=', $request->district)->where('current_stage', '=', $request->projectStatus)->count();;
            } else if ($program_name || $distric || $status) {
                $data = athlete_data_collection::where('name', '=', $request->programName)->where('district_secretariat', '=', $request->district)->where('current_stage', '=', $request->projectStatus)->count();
            } else {
                $data = athlete_data_collection::where('status', '=', '4')->orderBy('id', 'desc')->get();
            }

            return response()->json(['http_status' => 'success', 'message' => 'Data avaiable', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function AddUsers(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $address = $request->input('address');
        $mobile = $request->input('mobile');
        $role = 'planing';
        $status = 'active';
        $password = '1234';
        $type = '';

        if ($id == "new") {
            $userProfile = new User();
            $type = "inserted";
        } else {
            $existing_user = User::where('id', '=', $id)->first();
            if ($existing_user) {
                $userProfile = User::find($existing_user->id);
                $type = "updated";
            }
        }

        $userProfile->name = $name;
        $userProfile->email = $email;
        $userProfile->address = $address;
        $userProfile->mobile = $mobile;
        $userProfile->role = $role;
        $userProfile->password = Hash::make($password);
        $userProfile->status = $status;

        if ($userProfile->save()) {

            return response()->json(['http_status' => 'success', 'message' => 'User ' . $type . ' successfully', 'user_id' => $userProfile->id], 200);
        } else {
            return response()->json(['http_status' => 'error', 'message' => 'User cannot be saved'], 200);
        }
    }

    public function GetUserData()
    {
        $data = User::all();
        if ($data) {
            return response()->json(['http_status' => 'success', 'message' => 'Data avaiable', 'data' => $data], 200);
        } else {
            return response()->json(['http_status' => 'error'], 400);
        }
    }

    public function GetAllDetails()
    {
        $data = DB::table('athlete_data_collection')->get();
        // $data = athlete_data_collection::all();
        if ($data) {
            return response()->json(['http_status' => 'success', 'message' => 'Data avaiable', 'data' => $data], 200);
        } else {
            return response()->json(['http_status' => 'error'], 400);
        }
    }

    public function savePlayerAllDetails(Request $request)
    {

        return $request;

        $image = $request->file('img');
        return $image;

        // $id = $request->input('id');
        $id_number = $request->input('id_number');
        $province = $request->input('province');
        $distric = $request->input('distric');
        $d_secretariat = $request->input('d_secretariat');
        $name = $request->input('name');
        $birthday = $request->input('birthday');
        $address = $request->input('address');
        $gender = $request->input('gender');
        $game = $request->input('game');
        $event = $request->input('event');
        $phone_no = $request->input('phone_no');
        $best_performance = $request->input('best_performance');
        // $type = '';

        // if ($id == "new") {
        //     $details = new athlete_data_collection();
        //     $type = "inserted";
        // } else {
        //     $existing_user = athlete_data_collection::where('ID_NO', '=', $id_number)->first();
        //     if ($existing_user) {
        //         $details = athlete_data_collection::find($existing_user->id);
        //         $type = "updated";
        //     }
        // }
        $details = new athlete_data_collection();

        $details->ID_NO = $id_number;
        $details->Province = $province;
        $details->Distric = $distric;
        $details->D_Secretariat = $d_secretariat;
        $details->Name = $name;
        $details->Birth_Day = $birthday;
        $details->Address = $address;
        $details->Gender = $gender;
        $details->Game = $game;
        $details->Event = $event;
        $details->Phone_NO = $phone_no;
        $details->Best_Performrnce = $best_performance;

        if ($details->save()) {
            return response()->json(['http_status' => 'success', 'user_id' => $details->id], 200);
        } else {
            return response()->json(['http_status' => 'error', 'message' => 'User cannot be saved'], 200);
        }
    }
}

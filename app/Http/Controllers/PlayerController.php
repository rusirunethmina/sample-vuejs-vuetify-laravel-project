<?php

namespace App\Http\Controllers;

use App\User;
use App\athlete_data_collection;
use App\Players;
use App\PlayersHasGame;
use App\GnDtails;
use App\Game;
use App\Event;
use App\GameHasEvent;
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
use Illuminate\Database\Eloquent\Builder;

class PlayerController extends Controller
{
    public function savePlayerAllDetails(Request $request)
    {

        $playerName = $request->input('playerName');
        $playerNIC = $request->input('playerNIC');
        $playerPhone = $request->input('playerPhone');
        $selectProvince = $request->input('selectProvince');
        $selectDistrict = $request->input('selectDistrict');
        $playerAddress = $request->input('playerAddress');
        $playerBrithDay = $request->input('playerBrithDay');
        $playerGender = $request->input('playerGender');

        $inputs = $request->input('inputs');
        // $selectGame = $request->input('selectGame');
        // $selectEvent = $request->input('selectEvent');
        // $selectBestPreformance = $request->input('selectBestPreformance');


        $savePlayerDetails = new Players();

        $savePlayerDetails->player_name = $playerName;
        $savePlayerDetails->nic_number = $playerNIC;
        $savePlayerDetails->phone_num = $playerPhone;
        $savePlayerDetails->province = $selectProvince;
        $savePlayerDetails->district = $selectDistrict;
        $savePlayerDetails->address = $playerAddress;
        $savePlayerDetails->player_birthday = $playerBrithDay;
        $savePlayerDetails->gender = $playerGender;


        if ($savePlayerDetails->save()) {

            foreach (json_decode($inputs) as $key => $value) {
                $savePlayerDetailsnew = new PlayersHasGame();
                $savePlayerDetailsnew->game_id = $value->selectGame;
                $savePlayerDetailsnew->event_id = $value->selectEvent;
                $savePlayerDetailsnew->best_performance = $value->selectBestPreformance;
                $savePlayerDetailsnew->player_id = $savePlayerDetails->id;
                $savePlayerDetailsnew->save();
            }


            return response()->json(['http_status' => 'success', 'message' => 'Save Details'], 200);


            // return response()->json(['http_status' => 'success', 'message' => 'Save  Details'], 200);
        } else {

            return response()->json(['http_status' => 'error', 'message' => 'Faild  Details'], 200);
        }
    }


    // Get All Province Details
    public function getAllProvince(Request $request)
    {
        $province = GnDtails::groupby('PROVINCE_N')->get();
        return response()->json(['http_status' => 'success', 'message' => 'Get All  Details', 'data' => $province], 200);
    }

    public function getAllDistrictAccProv(Request $request)
    {
        $province = $request->input('province');
        $District = GnDtails::where('PROVINCE_N', '=', $province)->groupby('District')->get();
        return response()->json(['http_status' => 'success', 'message' => 'Get All  Details', 'data' => $District], 200);
    }


    public function getAllGameDetails(Request $request)
    {
        $Games = Game::get();
        return response()->json(['http_status' => 'success', 'message' => 'Get All  Details', 'data' => $Games], 200);
    }

    public function getAllEvent(Request $request)
    {
        $Game = $request->input('Game');
        $Event = GameHasEvent::with('Event', 'Games')->where('game_id', '=', $Game)->get();
        return response()->json(['http_status' => 'success', 'message' => 'Get All  Details', 'data' => $Event], 200);
    }


    public function filterDetails(Request $request)
    {

        $gender = $request->input('gender');
        $selectGame = $request->input('selectGame');
        $event = $request->input('event');
        $selectProvince = $request->input('selectProvince');
        $selectDistrict = $request->input('selectDistrict');
        $selectFilterCategory = $request->input('selectFilterCategory');

        switch ($selectFilterCategory) {
            case 'Gender':
                $player = Players::with('playerGame')->where('gender', '=', $gender)->get();
                $playerProvinceWise = Players::with('playerGame')->where('gender', '=', $gender)->groupby('province')->get();
                $playerDirtrictWise = Players::with('playerGame')->where('gender', '=', $gender)->groupby('district')->get();
                $provinceArray = [];
                $districtArray = [];
                foreach ($playerProvinceWise as $key => $value) {
                    array_push($provinceArray, $value->province);
                }
                foreach ($playerDirtrictWise as $key => $value) {
                    array_push($districtArray, $value->province);
                }
                $totalPlayerCount = $player->count();
                return response()->json([
                    'http_status' => 'success',
                    'message' => 'Get Gender Wise Details',
                    'data' => $player,
                    'totalPlayer' => $totalPlayerCount,
                    'provinceCount' => $playerProvinceWise->count(),
                    'provinceList' => $provinceArray,
                    'districtCount' => $playerDirtrictWise->count(),
                    'districtList' => $districtArray,
                ], 200);
                break;

            case 'Game':
                $player = Players::with('playerGame', 'playerGame.Games')
                    ->whereHas('playerGame', function ($query) use ($selectGame) {
                        $query->where('game_id', '=', $selectGame);
                    })->get();

                $playerProvinceWise = PlayersHasGame::with('player')->where('game_id', '=', $selectGame)
                    ->whereHas('player', function ($query) use ($selectGame) {
                        $query->where('player_id');
                    })->where('province')
                    ->groupby('province')->get();
                // $playerDirtrictWise = Players::with('playerGame')->where('gender', '=', $gender)->groupby('district')->get();

                $provinceArray = [];
                $districtArray = [];
                foreach ($playerProvinceWise as $key => $value) {
                    array_push($provinceArray, $value->province);
                }
                // foreach ($playerDirtrictWise as $key => $value) {
                //     array_push($districtArray, $value->province);
                // }

                // $playerProvinceWise = Players::with('playerGame', 'playerGame.Games')
                // ->whereHas('playerGame', function ($query) use ($selectGame) {
                //     $query->where('player_id', '=', $selectGame);
                // })->get();

                // $playerDirtrictWise = Players::with('playerGame', 'playerGame.Games')->where('game_id', '=', $selectGame)->groupby('district')->get();
                // $provinceArray = [];
                // $districtArray = [];
                // foreach ($playerProvinceWise as $key => $value) {
                //     array_push($provinceArray, $value->province);
                // }
                // foreach ($playerDirtrictWise as $key => $value) {
                //     array_push($districtArray, $value->province);
                // }

                $totalPlayerCount = $player->count();


                $malePlayer = Players::with('playerGame', 'playerGame.Games')
                    ->whereHas('playerGame', function ($query) use ($selectGame) {
                        $query->where('game_id', '=', $selectGame);
                    })->where('gender', '=', 'Male')->get();
                $femalePlayer = Players::with('playerGame', 'playerGame.Games')
                    ->whereHas('playerGame', function ($query) use ($selectGame) {
                        $query->where('game_id', '=', $selectGame);
                    })->where('gender', '=', 'Female')->get();

                return response()->json([
                    'http_status' => 'success',
                    'message' => 'Get Game and Event Wise Details',
                    'data' => $player,
                    'totalPlayer' => $totalPlayerCount,
                    'maleCount' => $malePlayer->count(),
                    'femaleCount' => $femalePlayer->count(),
                    'provinceCount' => $playerProvinceWise->count(),
                    // 'provinceList' => $provinceArray,
                    // 'districtCount' => $playerDirtrictWise->count(),
                    // 'districtList' => $districtArray,

                ], 200);
                break;

            case 'Game and Event':
                $player = Players::with('playerGame', 'playerGame.Games', 'playerGame.Event')
                    ->whereHas('playerGame', function ($query) use ($selectGame) {
                        $query->where('game_id', '=', $selectGame);
                    })->whereHas('playerGame', function ($query) use ($event) {
                        $query->where('event_id', '=', $event);
                    })->get();

                $totalPlayerCount = $player->count();

                return response()->json([
                    'http_status' => 'success',
                    'message' => 'Get Game and Event Wise Details',
                    'data' => $player,
                    'totalPlayer' => $totalPlayerCount,
                ], 200);
                break;

            case 'Province':
                $player = Players::with('playerGame', 'playerGame.Games', 'playerGame.Event')->where([
                    ['province', '=', $selectProvince]
                ])->get();

                $playerHasGames = PlayersHasGame::with('player', 'Games')
                    ->whereHas('player', function ($query) use ($selectProvince) {
                        $query->where('province', '=', $selectProvince);
                    })->groupby('game_id')->get();

                $gameList = [];

                foreach ($playerHasGames as $key => $value) {
                    array_push($gameList, $value->games->game_name);
                }


                $totalPlayerCount = $player->count();
                $totalGame = $playerHasGames->count();
                $totalProvince = $player->count();
                $totalDistrict = $player->count();
                return response()->json([
                    'http_status' => 'success',
                    'message' => 'Get All  Details',
                    'data' => $player,
                    'totalPlayer' => $totalPlayerCount,
                    'totalGame' => $totalGame,
                    'totalProvince' => $totalProvince,
                    'totalDistrict' => $totalDistrict,
                    'gameList' => $gameList
                ], 200);
                break;

            case 'District':
                $player = Players::with('playerGame', 'playerGame.Games', 'playerGame.Event')->where([
                    ['district', '=', $selectDistrict]
                ])->get();

                $totalPlayerCount = $player->count();
                return response()->json([
                    'http_status' => 'success',
                    'message' => 'Get All  Details',
                    'data' => $player,
                    'totalPlayer' => $totalPlayerCount
                ], 200);
                break;

            case 'All':
                $player = Players::with('playerGame', 'playerGame.Games', 'playerGame.Event')->where([
                    ['gender', '=', $gender], ['province', '=', $selectProvince], ['district', '=', $selectDistrict]
                ])->whereHas('playerGame', function ($query) use ($selectGame) {
                    $query->where('game_id', '=', $selectGame);
                })->whereHas('playerGame', function ($query) use ($event) {
                    $query->where('event_id', '=', $event);
                })->get();


                $totalPlayerCount = $player->count();
                $playerProvinceWise = $player->count();
                $playerDirtrictWise = $player->count();
                $totalGame = $player->count();
                $totalEvent = $player->count();
                return response()->json([
                    'http_status' => 'success',
                    'message' => 'Get All  Details',
                    'data' => $player,
                    'totalPlayer' => $totalPlayerCount,
                    'provinceCount' => $playerProvinceWise,
                    'totalGame' => $totalGame,
                    'totalEvent' => $totalEvent,
                    'districtCount' => $playerDirtrictWise,

                ], 200);
                break;

            default:
                # code...
                break;
        }

        // if ($gender !== null) {
        //     $player = Players::with('playerGame')->where('gender', '=', $gender)->get();
        //     return response()->json([
        //         'http_status' => 'success',
        //         'message' => 'Get Gender Wise Details',
        //         'data' => $player
        //     ], 200);
        // } elseif ($selectGame && $event) {
        //     $player = Players::with('playerGame')->whereHas('playerGame', function ($query) use ($selectGame) {
        //         $query->where('game_id', '=', $selectGame);
        //     })->whereHas('playerGame', function ($query) use ($event) {
        //         $query->where('event_id', '=', $event);
        //     })->get();
        //     return response()->json([
        //         'http_status' => 'success',
        //         'message' => 'Get Game Wise Details',
        //         'data' => $player
        //     ], 200);
        // } else {

        // }
    }
}

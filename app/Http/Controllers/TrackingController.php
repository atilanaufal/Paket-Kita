<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require_once base_path('Helpers\TrackPaket.php');
use App\Models\TrackingData;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{

       public function storeTrackData($trackingData)
    {

        if (Auth::check()) {
             Auth::user()->TrackingData()->create([

                'awb' => $trackingData['summary']['awb'],
                'courier' => $trackingData['summary']['courier'],
                'status' => $trackingData['summary']['status'],
                'origin' => $trackingData['detail']['origin'],
                'destination' => $trackingData['detail']['destination'],
                'shipper' => $trackingData['detail']['shipper'],
                'receiver' => $trackingData['detail']['receiver'],
                'date' => json_encode(array_column($trackingData['history'], 'date')),
                'description' => json_encode(array_column($trackingData['history'], 'desc')),
                'location' => json_encode(array_column($trackingData['history'], 'location')),
            ]);
        }
    }


    public function getTrackData(){
        $trackingData = TrackingData::where('user_id', Auth::id())->get();
        return view('main.history', compact('trackingData'));
    }
    public function showTrackView($id)
{
    $trackingData = TrackingData::find($id);
    // Prepare the history array
    $history = [];
    // Create a history entry based on the available data
    $dates = json_decode($trackingData->date, true);
    $descriptions = json_decode($trackingData->description, true);
    $locations = json_decode($trackingData->location, true);
    if ($trackingData) {

        for ($i = 0; $i < count($dates); $i++) {
            $date = $dates[$i];
            $description = $descriptions[$i];
            $location = $locations[$i];
            $history[] = [
                'date' =>  $date,
                'description' => $description,
                'location' => $location
            ];
        }

    }
    return view('main.track_view', compact('trackingData', 'history'));
}

    public function eraseTrackData($id){
        TrackingData::find($id)->delete();
        return redirect()->route('history');
    }



}

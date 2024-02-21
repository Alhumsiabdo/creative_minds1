<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getProfileUser(Request $request)
    {
        try {
            $userId = Auth::guard()->user()->id;

            $profile = User::findOrFail($userId);

            $profileData = [
                'id' => $profile->id,
                'name' => $profile->name,
                'email' => $profile->email,
                'phone' => $profile->phone,
                'type' => $profile->type,
                'image' => $profile->image,
                'latitude' => $profile->latitude,
                'longitude' => $profile->longitude,
            ];

            return response()->json(['message' => 'User Profile retrieved successfully', 'profile' => $profileData, 'code' => 200], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function getNearestDelivery(Request $request)
    {
        $userId = Auth::guard()->user()->id;

        $user = User::findOrFail($userId);

        $userLatitude = $user->latitude;
        $userLongitude = $user->longitude;

        $deliveries = User::where('type', 'delivery')->get();

        $nearestRepresentatives = [];
        foreach ($deliveries as $delivery) {
            $distance = $this->calculateDistance($userLatitude, $userLongitude, $delivery->latitude, $delivery->longitude);

            if ($distance <= 1000.00) {
                $nearestRepresentatives[] = [
                    'id' => $delivery->id,
                    'name' => $delivery->name,
                    'distance' => $distance,
                ];
            }
        }

        usort($nearestRepresentatives, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        return response()->json($nearestRepresentatives);
    }


    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;
        return $distance;
    }

}

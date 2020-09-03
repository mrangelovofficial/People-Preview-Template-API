<?php

namespace App\Services\Users;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

#Service do handle API Request & Response

class GetUsersService
{
    #API Documentation
    #URL:https://randomuser.me/documentation
    #API Max generated people - 5000

    #Request Handler
    public static function fetchUsers(int $peopleNumber = 1000)
    {
        //Default checking | MAX number by API is 5000
        if(!is_int($peopleNumber) || $peopleNumber  < 1 || $peopleNumber > 5000){
            $peopleNumber = 1000;
        }

        //Caching the API response for 5 minutes
        Cache::remember('collection', '300', function () use ($peopleNumber) {

            $requestURL = env('API_USERS') . '?results=' . $peopleNumber;

            $response = Http::get($requestURL);
            $response = json_decode($response->body())->results;

            return (new self)->sanitize($response);
        });

        return Cache::get('collection');
    }

    #Response Handler
    public function sanitize(array $generatedUsers){

        foreach($generatedUsers as $user)
        {
            //fixing blank avatars
            $avatar = ( empty($user->picture->thumbnail) ? 'data:image/jpeg;base64,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' : $user->picture->thumbnail);

            //Generate Fields
            $name = $user->name->title ?? '' . ' ' . $user->name->first ?? '' . ' ' . $user->name->last ?? '';
            $address = $user->location->street->name ?? '' . ' ' . $user->location->street->number ?? '' . ' '. $user->location->street->city ?? ''. ', ' . $user->location->street->country ?? '';

            $Response[] = [
                'id' => $user->login->uuid ?? '',
                'name' => $name,
                'address' => $address,
                'avatar' => $avatar,
            ];
        }

        return $Response;
    }


}

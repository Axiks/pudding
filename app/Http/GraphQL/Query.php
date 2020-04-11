<?php

namespace App\Http\GraphQL;

use Illuminate\Database\Eloquent\Model;


class Query
{
    public function avatar_src(\App\Club $club, array $args, $context, $info)
    {
        if(!$club->avatar_src){
            $club->avatar_src = "default/default-avatar.jpg";
        }
        return $club->avatar_src;
    }

    public function cover_src(\App\Club $club, array $args, $context, $info)
    {
        if(!$club->cover_src){
            if($club->avatar_src != "default/default-avatar.jpg"){
                $club->cover_src = $club->avatar_src;
            }
            else{
                $club->cover_src = "default/default-cover.jpg";
            }
        }
        return $club->cover_src;
    }
}
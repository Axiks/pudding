<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\User;
use App\Club;
use App\User_Club;

class AddUserClub
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if (!Auth::check()) {
            return "User don't Auth";
        }
        try {
            $user_id =  Auth::id();
            $club_id = $args['club_id'];
            // Получить рейс по атрибутам или создать, если он не существует...
            $user_club = User_Club::firstOrCreate(['user_id' => $user_id, 'club_id' => $club_id]);
            // $user = User::find($user_id);
            // $user->clubs()->attach($club_id);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

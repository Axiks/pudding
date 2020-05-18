<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\User_Meet;

class AddUserMeet
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
        // TODO implement the resolver
        if (!Auth::check()) {
            return "User don't Auth";
        }
        try {
            $user_id =  Auth::id();
            $meet_id = $args['meet_id'];
            // Получить рейс по атрибутам или создать, если он не существует...
            $user_meet = User_Meet::firstOrCreate(['user_id' => $user_id, 'meet_id' => $meet_id]);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

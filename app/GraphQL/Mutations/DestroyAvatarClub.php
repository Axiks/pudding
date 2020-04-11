<?php
namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\File;
use App\Club;

class DestroyAvatarClub
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
        $id = $args['id'];

        try {
            $club = Club::find($id);
            $src = $club->avatar_src;
            $club->avatar_src = "";
            $club->save();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        try {
            Storage::delete($src);
        }catch (ModelNotFoundException $exception) {
            return $exception->getMessage();
        }

        try {
            $files = File::where('src', $src);
            $files->delete();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return "success";
    }
}
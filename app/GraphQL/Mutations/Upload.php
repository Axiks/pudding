<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\File;


class Upload
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
        //$id = $args['id'];
        //$entity = $args['entity'];
        if (!Auth::check()) {
            return "User don't Auth";
        }

        $file = $args['file'];
        try {
            $fileSrc = $file->storePublicly('uploads');//SAVE
        }catch (ModelNotFoundException $exception) {
            return $exception->getMessage();
        }

        $files = new File;
        $files->name = $file->getClientOriginalName();
        $files->type = $file->getMimeType();
        $files->src = $fileSrc;
        $files->size = $file->getSize();
        $files->upload_user = Auth::id();
        $files->save();

        return $files->id;
    }
}
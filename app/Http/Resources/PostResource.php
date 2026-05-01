<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'slug'         => $this->slug,
            'excerpt'      => $this->excerpt,
            'body'         => $this->when($request->routeIs('api.posts.show'), $this->body),
            'status'       => $this->status,
            'views'        => $this->views,
            'published_at' => $this->published_at?->toISOString(),
            'created_at'   => $this->created_at->toISOString(),
            // Nested resources (only loaded if relationship is loaded)
            'author'    => new UserResource($this->whenLoaded('user')),
            'category'  => new CategoryResource($this->whenLoaded('category')),
            'tags'      => TagResource::collection($this->whenLoaded('tags')),
            'comments_count' => $this->when(

                $this->relationLoaded('comments'),

                fn() => $this->comments->count()

            ),

        ];

    }

}


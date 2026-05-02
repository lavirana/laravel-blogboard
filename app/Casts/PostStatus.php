<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PostStatus implements CastsAttributes

{

    public function get($model, string $key, $value, array $attributes): string

    {

        // Return a human-readable label

        return match($value) {

            'draft'     => '📝 Draft',

            'published' => '✅ Published',

            'archived'  => '📦 Archived',

            default     => $value,

        };

    }

    public function set($model, string $key, $value, array $attributes): string

    {

        // Strip the emoji when saving to DB

        return str($value)->after(' ')->lower()->toString();

    }

}


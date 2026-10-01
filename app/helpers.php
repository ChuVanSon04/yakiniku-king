<?php

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

if (! function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return Setting::where('key', $key)->value('value') ?? $default;
    }
}

if (! function_exists('localized_text')) {
    function localized_text(Model $model, string $attribute): ?string
    {
        if (app()->getLocale() === 'en') {
            $translatedValue = $model->getAttribute($attribute.'_en');

            if (is_string($translatedValue) && trim($translatedValue) !== '') {
                return $translatedValue;
            }
        }

        $value = $model->getAttribute($attribute);

        return is_string($value) && $value !== '' ? __($value) : null;
    }
}

if (! function_exists('localized_setting')) {
    function localized_setting(string $key, mixed $default = null): mixed
    {
        $value = setting($key, $default);

        if (app()->getLocale() !== 'en') {
            return $value;
        }

        return setting($key.'_en') ?: __($value ?? '');
    }
}

if (! function_exists('localized_price')) {
    function localized_price(float|int|string $amount): string
    {
        if (app()->getLocale() === 'en') {
            return number_format((float) $amount, 0, '.', ',').' VND';
        }

        return number_format((float) $amount, 0, ',', '.').' đ';
    }
}

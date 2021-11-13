<?php

namespace App\Lib;


class IconList
{

    protected $additionalIcons = [];

    public function __construct()
    {
        $this->additionalIcons = config('toggen.icons.additional') ?? $this->additionalIcons;
    }

    protected function createIconDescriptions($arrayToConvert)
    {
        $iconDescriptions = array_map(function ($element) {
            $element = preg_replace('/^fa/', '', $element);
            return trim(preg_replace('/([A-Z])/', ' $1', $element));
        }, $arrayToConvert);

        return $iconDescriptions;
    }

    public function isValid($icon)
    {
        return in_array($icon, $this->getIconListFromJs());
    }

    protected function getIconListFromJs()
    {
        $js = file_get_contents(resource_path() . '/js/Shared/Icons/FaIcon.js');

        $pattern = '/\{([^\}]*)\}\sfrom\s\'@fortawesome\/free-solid-svg-icons/misU';

        preg_match_all($pattern, $js, $matches);

        $filter = array_filter(explode("\n", preg_replace(["/ /", '/,/'], '', $matches[1][0])));

        return $filter;
    }

    public function get()
    {
        $iconList = $this->getIconListFromJs();

        $iconDescriptions = $this->createIconDescriptions($iconList);

        $combined = array_combine($iconList, $iconDescriptions);

        $combined = $this->addAdditionalIcons($combined);

        return $this->format($combined);
    }

    protected function addAdditionalIcons($combined)
    {
        return array_merge($combined, $this->additionalIcons);
    }

    protected function addKeys($key, $value)
    {
        return [
            'key' => $key,
            'value' => $value
        ];
    }

    protected function format($format)
    {
        asort($format);

        $formatted = array_map([$this, 'addKeys'], array_keys($format), array_values($format));

        return $formatted;
    }
}

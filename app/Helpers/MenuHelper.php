<?php

namespace App\Helpers;

class MenuHelper
{
    public static function getMenuArray($idrol)
    {
        $menuArray = [];

        foreach ($idrol as $itemId) {
            $menus = app('menus')
                ->where('id', $itemId)
                ->first()
                ->toArray();
            if ($menus) {
                $menuArray[] = $menus;
            }
        }

        return $menuArray;
    }

    public static function getChildren($data, $line)
    {
        $children = [];
        foreach ($data as $line1) {
            if ($line['id'] == $line1['id_parent']) {
                $children[] = array_merge($line1, ['submenu' => self::getChildren($data, $line1)]);
            }
        }
        return $children;
    }

    public static function buildMenu($data)
    {
        $menu = [];
        foreach ($data as $line) {
            if ($line['id_parent'] == null) {
                $menu[] = array_merge($line, ['submenu' => self::getChildren($data, $line)]);
            }
        }
        return $menu;
    }
}

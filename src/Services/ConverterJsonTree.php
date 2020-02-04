<?php


namespace App\Services;


class ConverterJsonTree
{
    public static $listJson;

    public static function convert(&$treeJson, $listJson)
    {
        self::$listJson = $listJson;
        self::recursiveTree($treeJson);
        dump($treeJson);
    }

    public static function recursiveTree(array &$treeJson)
    {
        foreach ($treeJson as $k=>$tj) {
            self::setNameFromList($treeJson, $treeJson[$k]["id"]);
            self::recursiveTree($treeJson[$k]["children"]);
        }
    }

    public static function setNameFromList(array &$treeJson, $number)
    {
        foreach (self::$listJson as $k=>$jl) {
            $translations = self::$listJson[$k]["translations"];
            if($jl["category_id"] == $number)
            {
                $translations = $jl["translations"];
                $lang = ["pl_PL", "en_US"];
                foreach ($lang as $l)
                {
                    if(isset($translations[$l]))
                    {
                        $languagesProduct = $translations[$l];
                        $treeJson["name_".$l] = $languagesProduct["name"];
                    }
                }
            }
        }
    }
}
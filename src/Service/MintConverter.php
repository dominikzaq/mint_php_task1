<?php


namespace App\Service;


class MintConverter
{
    private $listJson;

    public function convert(array $treeJson, array $listJson): array
    {
        $this->listJson = $listJson;
        $this->recursiveTree($treeJson);
        return $treeJson;
    }

    private function recursiveTree(array &$treeJson): void
    {
        foreach ($treeJson as $k=>$tj) {
            $this->setNameFromList($treeJson[$k], $treeJson[$k]["id"]);
            $this->recursiveTree($treeJson[$k]["children"]);
        }
    }

    private function setNameFromList(array &$treeJson, int $number): void
    {
        foreach ($this->listJson as $k=>$jl) {
            if($jl["category_id"] == $number)
            {
                dump($jl["category_id"]);
                dump($$number);
                $translations = $this->listJson[$k]["translations"];
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
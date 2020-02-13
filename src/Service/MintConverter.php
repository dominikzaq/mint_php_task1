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
        for($i = 0; $i < count($treeJson); $i++) {
            $this->setNameFromList($treeJson[$i], $treeJson[$i]["id"]);
            $this->recursiveTree($treeJson[$i]["children"]);
        }
    }

    private function setNameFromList(array &$treeJson, int $idList): void
    {
        foreach ($this->listJson as $key => $value) {
            if($value["category_id"] == $idList)
            {
                $translations = $this->listJson[$key]["translations"];
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
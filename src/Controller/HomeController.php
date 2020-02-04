<?php

namespace App\Controller;

use App\Services\ConverterJsonTree;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="json")
     */
    public function jsonConverter()
    {
        $listString = file_get_contents("list.json");
        $listJson = json_decode($listString, true);

        $treeString = file_get_contents("tree.json");
        $treeJson = json_decode($treeString, true);

        ConverterJsonTree::convert($treeJson, $listJson);

        return $this->render('home/index.html.twig', [
            "treeJson" => json_encode($treeJson),
        ]);
    }
}
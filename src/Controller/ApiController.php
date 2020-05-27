<?php

namespace App\Controller;

use App\Entity\Chapitre;
use App\Entity\Cours;
use App\Entity\Section;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/api2")
*/
class ApiController extends AbstractController
{
    /**
     * @Route("/chaps/{id}", name="chap_by_cours", methods={"GET"})
     */
    public function getChaps(Cours $cours)
    {
        /**
         * @var Cours $cours
         */
        $cours = $this->getDoctrine()->getRepository(Cours::class)->find($cours);
        $chapitres = $cours->getChapitres();
        $courx = array();

        foreach($chapitres as $chap){
            $cou["id"] = $chap->getId();
            $cou["titre"] = $chap->getTitre();
            $courx[] = $cou;
        }
        return new JsonResponse($courx);
    }

    /**
     * @Route("/tests/{id}", name="tests_by_cours", methods={"GET"})
     */
    public function getTests(Cours $cours)
    {
        /**
         * @var Cours $cours
         */
        $cours = $this->getDoctrine()->getRepository(Cours::class)->find($cours);

            $cou["id"] = $cours->getTest()->getId();
            $cou["titre"] = $cours->getTest()->getTitre();
            $cou["testfilename"] = $cours->getTest()->gettestfilename();

        return new JsonResponse([$cou]);
    }

    /**
     * @Route("/section/{id}", name="sections_by_chaps", methods={"GET"})
     */
    public function getSection(Chapitre $chapitre)
    {
        /**
         * @var Chapitre $chapitre
         */
        $chapitre = $this->getDoctrine()->getRepository(Chapitre::class)->find($chapitre);

        $sections = $chapitre->getSections();
        $courx = array();

        foreach($sections as $sec){
            $cou["id"] = $sec->getId();
            $cou["titre"] = $sec->getTitre();
            $cou["descr"] = $sec->getDescr();
            $cou["sectionfilename"] = $sec->getSectionfilename();
            $cou["sectionfilename2"] = $sec->getSectionfilename2();
            $cou["sectionfilename3"] = $sec->getSectionfilename3();


            $courx[] = $cou;
        }
        return new JsonResponse($courx);
    }
}

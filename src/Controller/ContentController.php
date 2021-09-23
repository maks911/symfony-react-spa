<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PageRepository;
use App\Repository\MetaRepository;

class ContentController extends AbstractController
{
    private $currentPage;

    /**
     * @Route("/content", name="content")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'ContentController',
        ]);
    }

    /**
     * @Route("/api/top", name="content")
     */
    public function getTopScreen(): Response
    {
        $topScreenContent = [
            'title' => '<p><b>White Label </b></p><p><b>MetaTrader 4/5</b></p>',
            'subtitle' => 'Our white label solutions enable to launch your business quickly,
                            incorporating a variety of options, complete with own-branding, to create a highly
                            customized environment for their clients.'
        ];

        return $this->jsonResponse($topScreenContent);
    }

    /**
     * @Route("/api/benefits", name="content")
     */
    public function getBenefits(PageRepository $pageRepository, MetaRepository $metaRepository): Response
    {
        $this->currentPage = $pageRepository->findOneBy(['url' => '/benefits/']);
        //$meta = $this->getMetaData($metaRepository, 'features');

        $meta = [
            'benefits' => [
                [
                    'id' => 1,
                    'title' => 'Full environment integration',
                    'description' => 'The WL MT as a part of the complex solution includes Liquidity, Trading platform, Traders Room, IB Program and PAMM/MAM/Copy trading systems.'
                ],
                [
                    'id' => 2,
                    'title' => 'Third-party integrations',
                    'description' => 'B2Core TR, Payment systems, IB Software Solution, PAMM/MAM/Copy Trading solutions are available.'
                ],
                [
                    'id' => 3,
                    'title' => 'No additional costs for the MT platform',
                    'description' => 'Prices for MT platform components come directly from MetaQuotes.'
                ],
                [
                    'id' => 4,
                    'title' => 'Various balance and credit operations',
                    'description' => 'Allows for the separation of different types of financial transactions.'
                ],
                [
                    'id' => 5,
                    'title' => 'Training sessions  for WL staff',
                    'description' => 'Comprehensive education for MT Manager and Trading Platform  interfaces and functionalities.'
                ],
                [
                    'id' => 6,
                    'title' => 'Fast changes on request',
                    'description' => 'All necessary changes for the completed WL in 24 hours.'
                ],
                [
                    'id' => 7,
                    'title' => 'Legal support',
                    'description' => 'We take care of all the legal aspects involved during setup to ensure your brokerage operations are completely legitimate.'
                ],
                [
                    'id' => 8,
                    'title' => 'Technical support',
                    'description' => 'We provide 24/7 fast and reliable multilingual technical support through multiple channels.'
                ],
                [
                    'id' => 9,
                    'title' => 'Demo environment',
                    'description' => 'A demo environment is available for training and testing purposes.'
                ],
            ]
        ];

        return $this->jsonResponse($meta);
    }

    /**
     * @Route("/api/features")
     * @param PageRepository $pageRepository
     * @param MetaRepository $metaRepository
     * @return Response
     */
    public function getFeatures(PageRepository $pageRepository, MetaRepository $metaRepository): Response
    {
        $this->currentPage = $pageRepository->findOneBy(['url' => '/features/']);
        $pageMetaTitle = $metaRepository->findOneBy(
            [
                'page_id' => $this->currentPage,
                'metakey' => 'title'
            ]
        );

        $features = [
            'title' => $pageMetaTitle->getMetavalue()
        ];

        $meta = $this->getMetaData($metaRepository,'features',  $features);

        return $this->jsonResponse($meta);
    }


    /**
     * @Route("/api/menu")
     * @return Response
     */
    public function getMenu(): Response
    {
        $menuItems = [
            [
                'id' => 1,
                'name' => 'Features',
                'link' => '/features/'
            ],
            [
                'id' => 2,
                'name' => 'Benefits',
                'link' => '/benefits/'
            ],
            [
                'id' => 3,
                'name' => 'Proxy',
                'link' => '/proxy/'
            ],
            [
                'id' => 4,
                'name' => 'FAQ',
                'link' => 'https://b2broker.com/products/mt5-white-label/'
            ],
            [
                'id' => 5,
                'name' => 'Contact Us',
                'link' => 'https://b2broker.com/?roistat_visit=300905'
            ]
        ];

        return $this->jsonResponse($menuItems);
    }

    /**
     * @return Response
     * @Route("/api/proxy", name="content")
     */
    public function getProxy(): Response
    {
        $menuItems = [
            'title' => 'Proxy-Servers all around the world',
            'description' => 'Stable connectivity with minimal latency from every point of the world.',
            'link' => '#',
            'link_text' => 'Explore',
            'image' => 'https://mtwhitelabels.com/app/uploads/2021/07/planet.png',
        ];

        return $this->jsonResponse($menuItems);
    }

    /**
     * @param array $data
     * @return Response
     */
    private function jsonResponse(array $data)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*'); //Not secure - change to current site domain
        $response->setContent(json_encode($data));
        $response->setSharedMaxAge(3600);
        return $response;
    }

    /**
     * @param MetaRepository $metaRepository
     * @param array $meta
     * @param string $pageKey
     * @return array
     */
    private function getMetaData(MetaRepository $metaRepository, string $pageKey = 'default', array &$meta = []) : array
    {
        $allFeatures = $metaRepository->findAllFeatures($this->currentPage->getId());

        foreach ($allFeatures as $key => $feature) {
            $key++;
            if ($key <= count($allFeatures) / $metaRepository->getFieldsCount()) {
                $title = $metaRepository->findOneBy(['metakey' => "features_{$key}_title"])->getMetavalue();
                $description = $metaRepository->findOneBy(['metakey' => "features_{$key}_description"])->getMetavalue();
                $icon = $metaRepository->findOneBy(['metakey' => "features_{$key}_icon"])->getMetavalue();
                $meta[$pageKey][] = [
                    'id' => $key,
                    'title' => $title,
                    'description' => $description,
                    'icon' => $icon
                ];
            }
        }

        return  $meta;
    }
}

<?php

namespace App\Action;

use Redis;
use App\Services\Authorise\UserBuilder;
use App\Services\Authorise\AuthInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as AbstractControllerAlias;

class Auth extends AbstractControllerAlias
{
    /**
     * @var UserBuilder
     */
    private UserBuilder $userBuilder;
    /**
     * @var AuthInterface
     */
    private AuthInterface $authoriseProcessor;

    /**
     * Auth constructor.
     *
     * @param UserBuilder $userBuilder
     * @param AuthInterface $authoriseProcessor
     */
    public function __construct(UserBuilder $userBuilder, AuthInterface $authoriseProcessor)
    {
        $this->userBuilder = $userBuilder;
        $this->authoriseProcessor = $authoriseProcessor;
    }

    /**
     * @param Request $request
     * @Route( path="auth", methods={"POST", "GET"})
     * @return Response
     */
    public function __invoke(Request $request)
    {
//        $a = new Redis();
//        $a->connect('redis');
//        echo $a->ping('asdasd');
//        die();

        $reqParams = [
            'name',
            'password',
            'skin',
            'network'
        ];

        $params = [];

        foreach ($reqParams as $reqParam) {
            $params[$reqParam] = $request->get($reqParam);
        }

        $user = $this->createUser($params);

        $token = $this->authoriseProcessor->authorise($user);

        return new Response($token);
    }

    private function createUser($params)
    {
        return $this->userBuilder->void()
            ->setName($params['name'])
            ->setPass($params['password'])
            ->setNet($params['skin'])
            ->setSkin($params['network'])
        ->build();
    }
}
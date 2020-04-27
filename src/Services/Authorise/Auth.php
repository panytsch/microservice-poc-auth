<?php

namespace App\Services\Authorise;

use App\Storage\StorageAdapterInterface;

class Auth implements AuthInterface
{
    private StorageAdapterInterface $services;
    private StorageAdapterInterface $redis;
    private StorageAdapterInterface $db;

    /**
     * @var UserBuilder
     */
    private UserBuilder $userBuilder;
    /**
     * @var TokenGenerator
     */
    private TokenGenerator $tokenGenerator;

    /**
     * Auth constructor.
     *
     * @param StorageAdapterInterface $services
     * @param StorageAdapterInterface $redis
     * @param StorageAdapterInterface $db
     * @param UserBuilder $userBuilder
     * @param TokenGenerator $tokenGenerator
     */
    public function __construct(
        StorageAdapterInterface $services,
        StorageAdapterInterface $redis,
        StorageAdapterInterface $db,
        UserBuilder $userBuilder,
        TokenGenerator $tokenGenerator
    ) {
        $this->services = $services;
        $this->redis = $redis;
        $this->db = $db;
        $this->userBuilder = $userBuilder;
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * @param BaseUserInterface $user
     *
     * @return UserInterface|null
     */
    public function authorise(BaseUserInterface $user): ?string
    {
        $cacheToken = $this->tokenGenerator->generateRedisToken($user);
        $userDataFromCache = $this->redis->loadUser($cacheToken);

        if(!$userDataFromCache) {

            /** just for example*/
            $user->setAdditionalData(
                UserInterface::SERVICES_DATA,
                $this->services->loadUser($this->tokenGenerator->generateServicesToken($user))
            );
            $user->setAdditionalData(
                UserInterface::SERVICES_DATA,
                $this->db->loadUser($this->tokenGenerator->generateDbToken($user))
            );

            $cacheDataOptions = UserInterface::BASE_DATA + UserInterface::DB_DATA + UserInterface::SERVICES_DATA;

            $this->redis->saveUser($cacheToken, json_encode($user->get($cacheDataOptions)));
        }

        return $cacheToken;
    }

    /**
     * @param UserInterface $user
     *
     * @throws \Exception
     */
    public function unAuthorise(BaseUserInterface $user): void
    {
        throw new \Exception('NOT YET');
    }
}
<?php
namespace App\Services\Authorise;

class  TokenGenerator
{
    public const REDIS_STORAGE_PATTERN = 'session_n:%s_s:%s_n:%s_p%s';

    /**
     * @param BaseUserInterface $user
     *
     * @return string
     */
    public function generateRedisToken(BaseUserInterface $user): string
    {
        return md5(
            sprintf(static::REDIS_STORAGE_PATTERN,
                $user->getNet(), $user->getSkin(), $user->getName(), $user->getPass()
            )
        );
    }

    /**
     * @param BaseUserInterface $user
     *
     * @return string
     */
    public function generateServicesToken(BaseUserInterface $user): string
    {
        return md5(
            sprintf(static::REDIS_STORAGE_PATTERN,
                $user->getNet(), $user->getSkin(), $user->getName(), $user->getPass()
            )
        );
    }

    /**
     * @param BaseUserInterface $user
     *
     * @return string
     */
    public function generateDbToken(BaseUserInterface $user): string
    {
        return md5(
            sprintf(static::REDIS_STORAGE_PATTERN,
                $user->getNet(), $user->getSkin(), $user->getName(), $user->getPass()
            )
        );
    }
}
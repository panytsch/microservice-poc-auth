<?php

namespace App\Services\Authorise;

class User implements UserInterface
{

    private string $name;
    private string $pass;
    private string $net;
    private string $skin;

    private array $additionalData;

    private int $authorisationInfo = 0;

    /**
     * User constructor.
     *
     * @param $name
     * @param $pass
     * @param $net
     * @param $skin
     */
    public function __construct(string $name, string $pass, int $net, int $skin)
    {
        $this->name = $name;
        $this->pass = $pass;
        $this->net = $net;
        $this->skin = $skin;
    }

    /**
     * @return int
     */
    public function getAuthInfo(): int
    {
        return $this->authorisationInfo;
    }

    /**
     * @param int $type
     *
     * @return bool
     */
    public function isAuthorisedIn(int $type): bool
    {
        return (bool)($this->authorisationInfo && $type);
    }

    /**
     * @param int $type
     *
     * @return mixed
     */
    public function authoriseIn(int $type): void
    {
        $this->authorisationInfo |= $type;
    }

    /**
     * @param int $type
     *
     * @return mixed
     */
    public function unAuthoriseIn(int $type): void
    {
        $this->authorisationInfo &= ~$type;
    }

    /**
     * @param int $type
     * @param array $data
     */
    public function setAdditionalData(int $type, array $data): void
    {
        foreach (static::TYPES as $baseType) {
            if($baseType & $type) {
                $this->authoriseIn($type);
                $this->additionalData[$type] = $data;
            }
        }
    }

    /**
     * @param int $type
     * @param string|null $field
     *
     * @return array
     */
    public function get(int $type, string $field = null): array
    {
        $result = [];

        foreach (static::TYPES as $baseType) {
            if($baseType & $type) {
                if (null === $field) {
                    $result[$baseType] = $this->additionalData[$baseType] ?? null;
                } else {
                    $result[$baseType][$field] = $this->additionalData[$baseType][$field] ?? null;
                }
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }

    /**
     * @return int
     */
    public function getNet(): int
    {
        return $this->net;
    }

    /**
     * @return int
     */
    public function getSkin(): int
    {
        return $this->skin;
    }

}
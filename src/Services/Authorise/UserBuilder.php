<?php

namespace App\Services\Authorise;

class UserBuilder
{

    /**
     * @var array
     */
    private array $data = [];

    /**
     * @param $d
     *
     * @return $this
     */
    public function void(): self
    {
        $this->data = [];
        return $this;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->data[0] = $name;
        return $this;
    }

    /**
     * @param $pass
     *
     * @return $this
     */
    public function setPass(string $pass): self
    {
        $this->data[1] = $pass;
        return $this;
    }

    /**
     * @param $net
     *
     * @return $this
     */
    public function setNet(int $net): self
    {
        $this->data[2] = $net;
        return $this;
    }

    /**
     * @param $skin
     *
     * @return $this
     */
    public function setSkin(int $skin): self
    {
        $this->data[3] = $skin;
        return $this;
    }


    /**
     * @return UserInterface
     */
    public function build(): UserInterface
    {
        ksort($this->data);
        return new User(...$this->data);
    }
}
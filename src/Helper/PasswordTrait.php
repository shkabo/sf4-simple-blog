<?php


namespace App\Helper;


use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

trait PasswordTrait
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @required
     */
    public function setEncoder(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function hash(UserInterface $user, string $password)
    {
        return $this->encoder->encodePassword($user, $password);
    }
}
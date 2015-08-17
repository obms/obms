<?php
namespace AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Administrator
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AdministrationBundle\Entity\AdministratorRepository")
 */
class Administrator implements UserInterface
{

    /**
     *
     * @var integer @ORM\Column(type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @var string @ORM\Column(type="string",
     *      length=255)
     */
    private $username;

    /**
     *
     * @var string @ORM\Column(type="string",
     *      length=255)
     */
    private $email;

    /**
     *
     * @var string @ORM\Column(type="string",
     *      length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $salt;

    /**
     * Constructor de la clase.
     */
    public function __construct()
    {}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Administrador
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Administrador
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Administrador
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array(
            'ROLE_MASTER'
        );
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {}

    /**
     * Set salt
     *
     * @param string $salt
     * @return Administrador
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }
}

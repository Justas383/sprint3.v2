<?php
namespace Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tweet")
 */
class Tweet
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** 
     * @ORM\Column(type="string")
     */
    private $userName;

     /** 
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $content;

    public function getId()
    {
        return $this->id;
    }
    public function getUserName()
    {
        return $this->userName;
    }
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    public function getContent()
    {
        return $this->content;
    }
    /**
     * Set the value of Content
     *
     * @return  self
     */
    public function setContent($content)
    {
        return $this->content = $content;
    }
}


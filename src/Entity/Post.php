<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post
 *
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="post")
 */
class Post
{
    const PUBLISHED_NO = 0;
    const PUBLISHED_DEMO = 1;
    const PUBLISHED_LIVE = 2;

	/**
	 * @var int
	 *
	 * @ORM\Id()
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue()
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 */
	private $title = '';

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
	private $published = 0;

	/**
	 * @var Collection
	 *
	 * @ORM\ManyToMany(targetEntity="Post")
	 * @ORM\JoinTable(name="related",
	 *      joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="related_post_id", referencedColumnName="id")}
     * )
	 */
	private $relatedPosts;

	/**
	 * Post constructor.
	 */
	public function __construct()
	{
		$this->relatedPosts = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 *
	 * @return Post
	 */
	public function setTitle(string $title): Post
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * @return Collection
	 */
	public function getRelatedPosts(): Collection
	{
		return $this->relatedPosts;
	}

	/**
	 * @param Collection $relatedPosts
	 *
	 * @return Post
	 */
	public function setRelatedPosts(Collection $relatedPosts): Post
	{
		$this->relatedPosts = $relatedPosts;

		return $this;
	}

    /**
     * @return int
     */
    public function getPublished(): int
    {
        return $this->published;
    }

    /**
     * @param int $published
     * @return Post
     */
    public function setPublished(int $published): Post
    {
        $this->published = $published;
        return $this;
    }

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->title;
	}
}
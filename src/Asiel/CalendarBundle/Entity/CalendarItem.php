<?php

namespace Asiel\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarItem
 *
 * @ORM\Table(name="calendar_item")
 * @ORM\Entity(repositoryClass="Asiel\CalendarBundle\Repository\CalendarItemRepository")
 */
class CalendarItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="date")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDue", type="datetime")
     */
    private $dateDue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_due_end", type="datetime")
     */
    private $dateDueEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="start", type="string", length=255)
     */
    private $start;

    /**
     * @var string
     *
     * @ORM\Column(name="end", type="string", length=255)
     */
    private $end;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return CalendarItem
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateDue
     *
     * @param \DateTime $dateDue
     *
     * @return CalendarItem
     */
    public function setDateDue($dateDue)
    {
        $this->dateDue = $dateDue;
        $this->start = $dateDue->format('Y-m-d H:i');

        return $this;
    }

    /**
     * Get dateDue
     *
     * @return \DateTime
     */
    public function getDateDue()
    {
        return $this->dateDue;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CalendarItem
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CalendarItem
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set start
     *
     * @param string $start
     *
     * @return CalendarItem
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return \DateTime
     */
    public function getDateDueEnd()
    {
        return $this->dateDueEnd;
    }

    /**
     * @param \DateTime $dateDueEnd
     */
    public function setDateDueEnd($dateDueEnd)
    {
        $this->dateDueEnd = $dateDueEnd;
        $this->end = $dateDueEnd->format('Y-m-d H:i');
    }


}


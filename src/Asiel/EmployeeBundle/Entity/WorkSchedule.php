<?php

namespace Asiel\EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkSchedule
 *
 * @ORM\Table(name="user_work_schedule")
 * @ORM\Entity(repositoryClass="Asiel\EmployeeBundle\Repository\WorkScheduleRepository")
 */
class WorkSchedule
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
     * @ORM\Column(name="mon_start", type="time")
     */
    private $monStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mon_end", type="time")
     */
    private $monEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tue_start", type="time")
     */
    private $tueStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tue_end", type="time")
     */
    private $tueEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="wed_start", type="time")
     */
    private $wedStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="wed_end", type="time")
     */
    private $wedEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="thu_start", type="time")
     */
    private $thuStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="thu_end", type="time")
     */
    private $thuEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fri_start", type="time")
     */
    private $friStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fri_end", type="time")
     */
    private $friEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sat_start", type="time")
     */
    private $satStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sat_end", type="time")
     */
    private $satEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sun_start", type="time")
     */
    private $sunStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sun_end", type="time")
     */
    private $sunEnd;

    /**
     * @ORM\OneToOne(targetEntity="Asiel\EmployeeBundle\Entity\User")
     */
    private $user;


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
     * Set monStart
     *
     * @param \DateTime $monStart
     *
     * @return WorkSchedule
     */
    public function setMonStart($monStart)
    {
        $this->monStart = $monStart;

        return $this;
    }

    /**
     * Get monStart
     *
     * @return \DateTime
     */
    public function getMonStart()
    {
        return $this->monStart;
    }

    /**
     * Set monEnd
     *
     * @param \DateTime $monEnd
     *
     * @return WorkSchedule
     */
    public function setMonEnd($monEnd)
    {
        $this->monEnd = $monEnd;

        return $this;
    }

    /**
     * Get monEnd
     *
     * @return \DateTime
     */
    public function getMonEnd()
    {
        return $this->monEnd;
    }

    /**
     * Set tueStart
     *
     * @param \DateTime $tueStart
     *
     * @return WorkSchedule
     */
    public function setTueStart($tueStart)
    {
        $this->tueStart = $tueStart;

        return $this;
    }

    /**
     * Get tueStart
     *
     * @return \DateTime
     */
    public function getTueStart()
    {
        return $this->tueStart;
    }

    /**
     * Set tueEnd
     *
     * @param \DateTime $tueEnd
     *
     * @return WorkSchedule
     */
    public function setTueEnd($tueEnd)
    {
        $this->tueEnd = $tueEnd;

        return $this;
    }

    /**
     * Get tueEnd
     *
     * @return \DateTime
     */
    public function getTueEnd()
    {
        return $this->tueEnd;
    }

    /**
     * Set wedStart
     *
     * @param \DateTime $wedStart
     *
     * @return WorkSchedule
     */
    public function setWedStart($wedStart)
    {
        $this->wedStart = $wedStart;

        return $this;
    }

    /**
     * Get wedStart
     *
     * @return \DateTime
     */
    public function getWedStart()
    {
        return $this->wedStart;
    }

    /**
     * Set wedEnd
     *
     * @param \DateTime $wedEnd
     *
     * @return WorkSchedule
     */
    public function setWedEnd($wedEnd)
    {
        $this->wedEnd = $wedEnd;

        return $this;
    }

    /**
     * Get wedEnd
     *
     * @return \DateTime
     */
    public function getWedEnd()
    {
        return $this->wedEnd;
    }

    /**
     * Set thuStart
     *
     * @param \DateTime $thuStart
     *
     * @return WorkSchedule
     */
    public function setThuStart($thuStart)
    {
        $this->thuStart = $thuStart;

        return $this;
    }

    /**
     * Get thuStart
     *
     * @return \DateTime
     */
    public function getThuStart()
    {
        return $this->thuStart;
    }

    /**
     * Set thuEnd
     *
     * @param \DateTime $thuEnd
     *
     * @return WorkSchedule
     */
    public function setThuEnd($thuEnd)
    {
        $this->thuEnd = $thuEnd;

        return $this;
    }

    /**
     * Get thuEnd
     *
     * @return \DateTime
     */
    public function getThuEnd()
    {
        return $this->thuEnd;
    }

    /**
     * Set friStart
     *
     * @param \DateTime $friStart
     *
     * @return WorkSchedule
     */
    public function setFriStart($friStart)
    {
        $this->friStart = $friStart;

        return $this;
    }

    /**
     * Get friStart
     *
     * @return \DateTime
     */
    public function getFriStart()
    {
        return $this->friStart;
    }

    /**
     * Set friEnd
     *
     * @param \DateTime $friEnd
     *
     * @return WorkSchedule
     */
    public function setFriEnd($friEnd)
    {
        $this->friEnd = $friEnd;

        return $this;
    }

    /**
     * Get friEnd
     *
     * @return \DateTime
     */
    public function getFriEnd()
    {
        return $this->friEnd;
    }

    /**
     * Set satStart
     *
     * @param \DateTime $satStart
     *
     * @return WorkSchedule
     */
    public function setSatStart($satStart)
    {
        $this->satStart = $satStart;

        return $this;
    }

    /**
     * Get satStart
     *
     * @return \DateTime
     */
    public function getSatStart()
    {
        return $this->satStart;
    }

    /**
     * Set satEnd
     *
     * @param \DateTime $satEnd
     *
     * @return WorkSchedule
     */
    public function setSatEnd($satEnd)
    {
        $this->satEnd = $satEnd;

        return $this;
    }

    /**
     * Get satEnd
     *
     * @return \DateTime
     */
    public function getSatEnd()
    {
        return $this->satEnd;
    }

    /**
     * Set sunStart
     *
     * @param \DateTime $sunStart
     *
     * @return WorkSchedule
     */
    public function setSunStart($sunStart)
    {
        $this->sunStart = $sunStart;

        return $this;
    }

    /**
     * Get sunStart
     *
     * @return \DateTime
     */
    public function getSunStart()
    {
        return $this->sunStart;
    }

    /**
     * Set sunEnd
     *
     * @param \DateTime $sunEnd
     *
     * @return WorkSchedule
     */
    public function setSunEnd($sunEnd)
    {
        $this->sunEnd = $sunEnd;

        return $this;
    }

    /**
     * Get sunEnd
     *
     * @return \DateTime
     */
    public function getSunEnd()
    {
        return $this->sunEnd;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return WorkSchedule
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}

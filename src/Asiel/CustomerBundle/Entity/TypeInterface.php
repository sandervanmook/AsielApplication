<?php

namespace Asiel\CustomerBundle\Entity;


/**
 * Implement this class to all the customer type entities. The methods are used in the controllers.
 */

interface TypeInterface
{

    /**
     * Be sure to return parent::getId() otherwise it will return null
     * @return integer
     */
    public function getId();

    /**
     * Used in the controllers, for \Model\ValueType\Type.php, and to get the Discriminator Column value.
     * Just return the class name not the fully qualified name.
     * @return string
     */
    public function getClassName();

}
<?php


namespace Asiel\LocationBundle\Security;


use Asiel\EmployeeBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class LocationVoter extends Voter
{
    const CREATE = 'create';
    const DELETE = 'delete';

    private $accessDecisionManager;

    public function __construct(AccessDecisionManagerInterface $accessDecisionManager)
    {
        $this->accessDecisionManager = $accessDecisionManager;
    }

    protected function supports($attribute, $subject)
    {
        // Check if the attribute is known
        if (!in_array($attribute, [self::CREATE, self::DELETE])) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        // The user must be logged in
        if (!$user instanceof User) {
            return false;
        }

        switch ($attribute) {
            case self::CREATE:
                // All users can create
                if ($this->accessDecisionManager->decide($token, ['ROLE_USER'])) {
                    return true;
                } else {
                    return false;
                }
            case self::DELETE:
                // Only the admins can delete
                if ($this->accessDecisionManager->decide($token, ['ROLE_ADMIN'])) {
                    return true;
                } else {
                    return false;
                }
        }

        throw new \LogicException('This code should not be reached!');
    }

}
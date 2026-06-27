<?php

declare(strict_types=1);

namespace App\Security;

use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\InMemoryUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Loads the single admin user from environment variables.
 * No database involved — credentials live in APP_ADMIN_EMAIL / APP_ADMIN_PASSWORD_HASH.
 *
 * @implements UserProviderInterface<InMemoryUser>
 */
final class AdminUserProvider implements UserProviderInterface
{
    public function __construct(
        private readonly string $adminEmail,
        private readonly string $adminPasswordHash,
    ) {}

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        if ($identifier !== $this->adminEmail) {
            throw new UserNotFoundException(sprintf('User "%s" not found.', $identifier));
        }

        return new InMemoryUser($this->adminEmail, $this->adminPasswordHash, ['ROLE_USER']);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return InMemoryUser::class === $class;
    }
}

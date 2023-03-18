<?php

namespace App\CommonBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_access_tokens")
 */
class UserAccessToken
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $user;

    /**
     * Тут мы будем хранить наш токен. Токен необходимо генерировать самому и как можно сложнее и длиннее, чтобы исключить возможность подбора
     *
     * @ORM\Column(name="access_token", type="string")
     */
    protected $accessToken;

    /**
     * Дата, после которой токен будет считаться не активным
     *
     * @ORM\Column(name="expired_at", type="datetime")
     */
    protected $expiredAt;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

}
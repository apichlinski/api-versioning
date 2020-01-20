<?php


namespace App\Tests\Controller;

use App\DataFixtures\UserFixtures;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use App\Entity\User;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class UserControllerTest extends WebTestCase
{
    private $entityManager;

    use FixturesTrait;

    /**
     * Test [GET] /api/{version}/user/{id}.
     */
    public function testGetUser()
    {
        $user = $this->getOneUser();

        $client = static::createClient();
        $client->request('GET', '/api/1/user/'.$user->getId());

        // Response is OK
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $result = $client->getResponse()->getContent();
        $content = json_decode($result, true);

        // All key are presents
        $keys = [
            'id',
            'username',
            'email',
            'firstname',
            'lastname',
            'birthday',
        ];
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $content);
        }

        // There is no extra key
        foreach ($content as $key => $value) {
            $this->assertContains($key, $keys);
        }

        // all values are valid
        $this->assertEquals($user->getId(), $content['id']);
        $this->assertEquals($user->getUsername(), $content['username']);
        $this->assertEquals($user->getEmail(), $content['email']);
        $this->assertEquals($user->getBirthday()->format('Y-m-d'), $content['birthday']);
    }

    // Setup and getOneUser methods
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    private function getOneUser(): User
    {
        $this->loadFixtures([
            'App\DataFixtures\UserFixtures',
        ]);
        return $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'phpteam@makolab.com']);
    }
}
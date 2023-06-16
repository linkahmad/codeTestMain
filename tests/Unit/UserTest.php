<?php
use Tests\TestCase;
use App\Models\Town;
use App\Models\Type;
use App\Models\User;
use App\Models\Company;
use App\Models\UserMeta;
use App\Models\UserTowns;
use App\Models\Department;
use App\Models\UserLanguages;
use App\Models\UsersBlacklist;
use DTApi\Repository\UserRepository;

class UserTest extends TestCase
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * BookingController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }
    
    public function testCreateOrUpdate()
    {
        // Arrange
        $request = [
            'role' => 'customer',
            'name' => 'John Doe',
            // ... provide other necessary request parameters
        ];

        // Act
        $user = $this->repository->createOrUpdate(null, $request);

        // Assert
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($request['role'], $user->user_type);
        $this->assertEquals($request['name'], $user->name);
        // ... assert other attributes and relationships of the user model
    }
}
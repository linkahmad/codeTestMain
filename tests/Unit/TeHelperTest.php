<?php
use Carbon\Carbon;
use DTApi\Helpers\TeHelper;
use PHPUnit\Framework\TestCase;
class TeHelperTest extends TestCase
{
    public function testWillExpireAt()
    {
        // Arrange
        $dueTime = Carbon::now()->addHours(10)->format('Y-m-d H:i:s');
        $createdAt = Carbon::now()->subHours(2)->format('Y-m-d H:i:s');

        // Act
        $expiryTime = YourClass::willExpireAt($dueTime, $createdAt);

        // Assert
        $expectedExpiryTime = Carbon::parse($dueTime)->format('Y-m-d H:i:s');
        $this->assertEquals($expectedExpiryTime, $expiryTime);
    }

    public function testWillExpireAtWithin24Hours()
    {
        // Arrange
        $dueTime = Carbon::now()->addHours(5)->format('Y-m-d H:i:s');
        $createdAt = Carbon::now()->subHours(2)->format('Y-m-d H:i:s');

        // Act
        $expiryTime = TeHelper::willExpireAt($dueTime, $createdAt);

        // Assert
        $expectedExpiryTime = Carbon::parse($createdAt)->addMinutes(90)->format('Y-m-d H:i:s');
        $this->assertEquals($expectedExpiryTime, $expiryTime);
    }

    public function testWillExpireAtWithin72Hours()
    {
        // Arrange
        $dueTime = Carbon::now()->addHours(80)->format('Y-m-d H:i:s');
        $createdAt = Carbon::now()->subHours(30)->format('Y-m-d H:i:s');

        // Act
        $expiryTime = TeHelper::willExpireAt($dueTime, $createdAt);

        // Assert
        $expectedExpiryTime = Carbon::parse($createdAt)->addHours(16)->format('Y-m-d H:i:s');
        $this->assertEquals($expectedExpiryTime, $expiryTime);
    }

    public function testWillExpireAtGreaterThan72Hours()
    {
        // Arrange
        $dueTime = Carbon::now()->addHours(120)->format('Y-m-d H:i:s');
        $createdAt = Carbon::now()->subHours(80)->format('Y-m-d H:i:s');

        // Act
        $expiryTime = TeHelper::willExpireAt($dueTime, $createdAt);

        // Assert
        $expectedExpiryTime = Carbon::parse($dueTime)->subHours(48)->format('Y-m-d H:i:s');
        $this->assertEquals($expectedExpiryTime, $expiryTime);
    }
}
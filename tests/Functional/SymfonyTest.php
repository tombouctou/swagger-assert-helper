<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace Tests\Functional;

use Ovr\Swagger\SymfonyTrait;
use Symfony\Component\HttpFoundation\Response;
use Tests\App\SymfonyApp;

class SymfonyTest extends \PHPUnit_Framework_TestCase
{
    use SymfonyTrait;

    public function testGetUserById()
    {
        $operation = $this->getSwaggerWrapper()->getOperationByName('getUserById');
        $response = $this->getApp()->handle(
            $this->makeRequestByOperation(
                $operation,
                [
                    'id' => 1
                ]
            )
        );
        $this->getSwaggerWrapper()
            ->assertHttpResponseForOperation($response, $operation, Response::HTTP_OK);
    }

    public function testGetUserFriendsById()
    {
        $operation = $this->getSwaggerWrapper()->getOperationByName('getUserFriendsById');
        $response = $this->getApp()->handle(
            $this->makeRequestByOperation(
                $operation,
                [
                    'id' => 1
                ]
            )
        );
        $this->getSwaggerWrapper()
            ->assertHttpResponseForOperation($response, $operation, Response::HTTP_OK);
    }

    /**
     * @return SymfonyApp
     */
    protected function getApp()
    {
        return new SymfonyApp();
    }

    /**
     * @return \Ovr\Swagger\SwaggerWrapper
     */
    protected function getSwaggerWrapper()
    {
        return new \Ovr\Swagger\SwaggerWrapper(
            \Swagger\scan(
                __DIR__ . '/../../examples'
            )
        );
    }
}
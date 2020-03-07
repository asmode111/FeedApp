<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\WordService;
use App\Services\Contracts\FetchServiceInterface;

/**
 * @group service
 */
class WordServiceTest extends TestCase
{
    /**
     * @return void
     * @dataProvider providerFetch
     */
    public function testFetch(array $data, string $expected): void
    {
        $fetchService = $this->getMockBuilder(FetchServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $fetchService->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue($data['isFetched']));
            
        $fetchService->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue($data['body']));

        $wordService = new WordService($fetchService);
        $response = $wordService->fetch();

        $this->assertEquals($response, $expected);
    }

    public function providerFetch(): array
    {
        return [
            [
                [
                    'isFetched' => true,
                    'body' => 'foo'
                ],
                'foo'
            ],
            [
                [
                    'isFetched' => false,
                    'body' => ''
                ],
                ''
            ],
        ];
    }
}

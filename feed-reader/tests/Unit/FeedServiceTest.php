<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\FeedService;
use App\Services\Contracts\FetchServiceInterface;

/**
 * @group service2
 */
class FeedServiceTest extends TestCase
{
    private const WORDS = ['the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'I', 'it', 'for', 'not', 'on', 'with', 'he', 'as', 'you', 'do', 'at', 'this', 'but', 'his', 'by', 'from', 'they', 'we', 'say', 'her', 'she', 'or', 'an', 'will', 'my', 'one', 'all', 'would', 'there', 'their', 'what', 'so', 'up', 'out', 'if', 'about', 'who', 'get', 'which', 'go', 'me'];

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

        $feedService = new FeedService($fetchService);
        $response = $feedService->fetch();

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

    /**
     * @return void
     * @dataProvider providerConvert
     */
    public function testConvert(string $body, array $expected): void
    {
        $fetchService = $this->getMockBuilder(FetchServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $feedService = new FeedService($fetchService);
        $response = $feedService->convert($body);

        $this->assertEquals($response, $expected);
    }

    public function providerConvert(): array 
    {
        return [
            [
                '',
                [],
            ],
            [
<<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en">
    <id>tag:theregister.co.uk,2005:feed/theregister.co.uk/software/</id>
    <title>The Register - Software</title>
    <link rel="self" type="application/atom+xml" href="https://www.theregister.co.uk/software/headlines.atom"/>
    <link rel="alternate" type="text/html" href="https://www.theregister.co.uk/software/"/>
    <rights>Copyright © 2020, Situation Publishing</rights>
    <author>
    <name>Team Register</name>
    <email>webmaster@theregister.co.uk</email>
    <uri>https://www.theregister.co.uk/odds/about/contact/</uri>
    </author>
    <icon>https://www.theregister.co.uk/Design/graphics/icons/favicon.png</icon>
    <subtitle>Biting the hand that feeds IT — sci/tech news and views for the world</subtitle>
    <logo>https://www.theregister.co.uk/Design/graphics/Reg_default/The_Register_r.png</logo>
    <updated>2020-03-06T22:58:05Z</updated>
    <entry>
    <id>tag:theregister.co.uk,2005:story207383</id>
    <updated>2020-03-06T22:58:05Z</updated>
    <author>
        <name>Shaun Nichols</name>
        <uri>https://search.theregister.co.uk/?author=Shaun%20Nichols</uri>
    </author>
    <link rel="alternate" type="text/html" href="https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/06/dhs_ig_stealing_software/"/>
    <title type="html">Former US Homeland Security Inspector General accused of stealing govt code and trying to resell it to... the US govt</title>
    <summary type="html" xml:base="https://www.theregister.co.uk/">&lt;h4&gt;That's one way to pad your pension pot, allegedly&lt;/h4&gt; &lt;p&gt;A former acting Inspector General at the US Department of Homeland Security was today indicted for allegedly stealing internal software and data and attempting to sell it all back to his then-employer.…&lt;/p&gt;</summary>
    </entry>
    <entry>
    <id>tag:theregister.co.uk,2005:story207368</id>
    <updated>2020-03-06T12:16:34Z</updated>
    <author>
        <name>Richard Speed</name>
        <uri>https://search.theregister.co.uk/?author=Richard%20Speed</uri>
    </author>
    <link rel="alternate" type="text/html" href="https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/06/windows_10_insider_preview_19577/"/>
    <title type="html">'Optional' is the new 'Full' in Windows 10: Microsoft mucks about with diagnostic slurpage levels for Fast Ring Insiders</title>
    <summary type="html" xml:base="https://www.theregister.co.uk/">&lt;h4&gt;That won't cause any confusion&lt;/h4&gt; &lt;p&gt;Having fixed the &lt;a target="_blank" href="https://www.theregister.co.uk/2020/02/27/20h1_wsus/"&gt;mystery blocking bug of last week&lt;/a&gt;, Microsoft dropped a fresh Fast Ring build of Windows 10 and announced plans to clear the waters of the privacy pond by fiddling with the names given to diagnostic data slurpage.…&lt;/p&gt;</summary>
    </entry>
    <entry>
    <id>tag:theregister.co.uk,2005:story207328</id>
    <updated>2020-03-06T10:00:09Z</updated>
    <author>
        <name>Richard Speed</name>
        <uri>https://search.theregister.co.uk/?author=Richard%20Speed</uri>
    </author>
    <link rel="alternate" type="text/html" href="https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/06/bork_bork_bork/"/>
    <title type="html">Your opinion does matter to this Jordanian telco... only it's experiencing some technical difficulties right now</title>
    <summary type="html" xml:base="https://www.theregister.co.uk/">&lt;h4&gt;It's the triple! Internet Explorer, McAfee and... is that Windows 8.1 flashing its privates?&lt;/h4&gt; &lt;p&gt;&lt;strong&gt;Bork!Bork!Bork!&lt;/strong&gt;  It's been a few days and there have been a few borks. Today's entry in the hall of infamy takes us far from London's Vulture Central all the way to Amman, Jordan.…&lt;/p&gt; &lt;p&gt;&lt;!--#include virtual='/data_centre/_whitepaper_textlinks_top.html' --&gt;&lt;/p&gt;</summary>
    </entry>
    <entry>
    <id>tag:theregister.co.uk,2005:story207342</id>
    <updated>2020-03-05T15:30:11Z</updated>
    <author>
        <name>Richard Speed</name>
        <uri>https://search.theregister.co.uk/?author=Richard%20Speed</uri>
    </author>
    <link rel="alternate" type="text/html" href="https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/05/bork/"/>
    <title type="html">You'll get your money – when this bank has upgraded Windows 7... or bought extended support</title>
    <summary type="html" xml:base="https://www.theregister.co.uk/">&lt;h4&gt;The return of the cashpoint bork as support dries up&lt;/h4&gt; &lt;p&gt;&lt;strong&gt;Bork!Bork!Bork!&lt;/strong&gt;  ATM customers have been treated to that most special of sights, a refusal to dispense cash unless Windows 7 gets the update goodness it craves.…&lt;/p&gt;</summary>
    </entry>
</feed>
EOF,
                [
                    "id" => "tag:theregister.co.uk,2005:feed/theregister.co.uk/software/",
                    "title" => "The Register - Software",
                    "link" => [
                        [
                            "@attributes" => [
                                "rel" => "self",
                                "type" => "application/atom+xml",
                                "href" => "https://www.theregister.co.uk/software/headlines.atom",
                            ]
                        ],
                        [
                            "@attributes" => [
                                "rel" => "alternate",
                                "type" => "text/html",
                                "href" => "https://www.theregister.co.uk/software/",
                            ]
                        ],
                    ],
                    "rights" => "Copyright © 2020, Situation Publishing",
                    "author" => [
                        "name" => "Team Register",
                        "email" => "webmaster@theregister.co.uk",
                        "uri" => "https://www.theregister.co.uk/odds/about/contact/",
                    ],
                    "icon" => "https://www.theregister.co.uk/Design/graphics/icons/favicon.png",
                    "subtitle" => "Biting the hand that feeds IT — sci/tech news and views for the world",
                    "logo" => "https://www.theregister.co.uk/Design/graphics/Reg_default/The_Register_r.png",
                    "updated" => "2020-03-06T22:58:05Z",
                    "entry" => [
                        [
                            "id" => "tag:theregister.co.uk,2005:story207383",
                            "updated" => "2020-03-06T22:58:05Z",
                            "author" => [
                                "name" => "Shaun Nichols",
                                "uri" => "https://search.theregister.co.uk/?author=Shaun%20Nichols",
                            ],
                            "link" => [
                                "@attributes" => [
                                    "rel" => "alternate",
                                    "type" => "text/html",
                                    "href" => "https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/06/dhs_ig_stealing_software/",
                                ],
                            ],
                            "title" => "Former US Homeland Security Inspector General accused of stealing govt code and trying to resell it to... the US govt",
                            "summary" => "<h4>That's one way to pad your pension pot, allegedly</h4> <p>A former acting Inspector General at the US Department of Homeland Security was today indicted for allegedly stealing internal software and data and attempting to sell it all back to his then-employer.…</p>",
                        ],
                        [
                            "id" => "tag:theregister.co.uk,2005:story207368",
                            "updated" => "2020-03-06T12:16:34Z",
                            "author" => [
                                "name" => "Richard Speed",
                                "uri" => "https://search.theregister.co.uk/?author=Richard%20Speed",
                            ],
                            "link" => [
                                "@attributes" => [
                                    "rel" => "alternate",
                                    "type" => "text/html",
                                    "href" => "https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/06/windows_10_insider_preview_19577/",
                                ],
                            ],
                            "title" => "'Optional' is the new 'Full' in Windows 10: Microsoft mucks about with diagnostic slurpage levels for Fast Ring Insiders",
                            "summary" => "<h4>That won't cause any confusion</h4> <p>Having fixed the <a target=\"_blank\" href=\"https://www.theregister.co.uk/2020/02/27/20h1_wsus/\">mystery blocking bug of last week</a>, Microsoft dropped a fresh Fast Ring build of Windows 10 and announced plans to clear the waters of the privacy pond by fiddling with the names given to diagnostic data slurpage.…</p>",
                        ],
                        [
                            "id" => "tag:theregister.co.uk,2005:story207328",
                            "updated" => "2020-03-06T10:00:09Z",
                            "author" => [
                                "name" => "Richard Speed",
                                "uri" => "https://search.theregister.co.uk/?author=Richard%20Speed",
                            ],
                            "link" => [
                                "@attributes" => [
                                    "rel" => "alternate",
                                    "type" => "text/html",
                                    "href" => "https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/06/bork_bork_bork/",
                                ],
                            ],
                            "title" => "Your opinion does matter to this Jordanian telco... only it's experiencing some technical difficulties right now",
                            "summary" => "<h4>It's the triple! Internet Explorer, McAfee and... is that Windows 8.1 flashing its privates?</h4> <p><strong>Bork!Bork!Bork!</strong>  It's been a few days and there have been a few borks. Today's entry in the hall of infamy takes us far from London's Vulture Central all the way to Amman, Jordan.…</p> <p><!--#include virtual='/data_centre/_whitepaper_textlinks_top.html' --></p>",
                        ],
                        [
                            "id" => "tag:theregister.co.uk,2005:story207342",
                            "updated" => "2020-03-05T15:30:11Z",
                            "author" => [
                                "name" => "Richard Speed",
                                "uri" => "https://search.theregister.co.uk/?author=Richard%20Speed",
                            ],
                            "link" => [
                                "@attributes" => [
                                    "rel" => "alternate",
                                    "type" => "text/html",
                                    "href" => "https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/05/bork/",
                                ],
                            ],
                            "title" => "You'll get your money – when this bank has upgraded Windows 7... or bought extended support",
                            "summary" => "<h4>The return of the cashpoint bork as support dries up</h4> <p><strong>Bork!Bork!Bork!</strong>  ATM customers have been treated to that most special of sights, a refusal to dispense cash unless Windows 7 gets the update goodness it craves.…</p>",
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return void
     * @dataProvider providerFindFrequency
     */
    public function testFindFrequency(array $feed, array $expected): void
    {
        $fetchService = $this->getMockBuilder(FetchServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $feedService = new FeedService($fetchService);
        $response = $feedService->findFrequency($feed, self::WORDS);

        $this->assertEquals($response, $expected);
    }

    public function providerFindFrequency(): array 
    {
        return [
            [
                [],
                [],
            ],
            [
                [
                    "rights" => "Copyright © 2020, Situation Publishing",
                    "author" => [
                        "name" => "Team Register",
                        "email" => "webmaster@theregister.co.uk",
                        "uri" => "https://www.theregister.co.uk/odds/about/contact/",
                    ],
                    "icon" => "https://www.theregister.co.uk/Design/graphics/icons/favicon.png",
                ],
                [],
            ],
            [
                [
                    "rights" => "Copyright © 2020, Situation Publishing",
                    "author" => [
                        "name" => "Team Register",
                        "email" => "webmaster@theregister.co.uk",
                        "uri" => "https://www.theregister.co.uk/odds/about/contact/",
                    ],
                    "icon" => "https://www.theregister.co.uk/Design/graphics/icons/favicon.png",
                    "entry" => []
                ],
                [],
            ],
            [
                [
                    "rights" => "Copyright © 2020, Situation Publishing",
                    "author" => [
                        "name" => "Team Register",
                        "email" => "webmaster@theregister.co.uk",
                        "uri" => "https://www.theregister.co.uk/odds/about/contact/",
                    ],
                    "icon" => "https://www.theregister.co.uk/Design/graphics/icons/favicon.png",
                    "entry" => ['sfasdf'],
                ],
                [],
            ],
            [
                [
                    "id" => "tag:theregister.co.uk,2005:feed/theregister.co.uk/software/",
                    "title" => "The Register - Software",
                    "link" => [
                        [
                            "@attributes" => [
                                "rel" => "self",
                                "type" => "application/atom+xml",
                                "href" => "https://www.theregister.co.uk/software/headlines.atom",
                            ]
                        ],
                        [
                            "@attributes" => [
                                "rel" => "alternate",
                                "type" => "text/html",
                                "href" => "https://www.theregister.co.uk/software/",
                            ]
                        ],
                    ],
                    "rights" => "Copyright © 2020, Situation Publishing",
                    "author" => [
                        "name" => "Team Register",
                        "email" => "webmaster@theregister.co.uk",
                        "uri" => "https://www.theregister.co.uk/odds/about/contact/",
                    ],
                    "icon" => "https://www.theregister.co.uk/Design/graphics/icons/favicon.png",
                    "subtitle" => "Biting the hand that feeds IT — sci/tech news and views for the world",
                    "logo" => "https://www.theregister.co.uk/Design/graphics/Reg_default/The_Register_r.png",
                    "updated" => "2020-03-06T22:58:05Z",
                    "entry" => [
                        [
                            "id" => "tag:theregister.co.uk,2005:story207383",
                            "updated" => "2020-03-06T22:58:05Z",
                            "author" => [
                                "name" => "Shaun Nichols",
                                "uri" => "https://search.theregister.co.uk/?author=Shaun%20Nichols",
                            ],
                            "link" => [
                                "@attributes" => [
                                    "rel" => "alternate",
                                    "type" => "text/html",
                                    "href" => "https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/06/dhs_ig_stealing_software/",
                                ],
                            ],
                            "title" => "Former US Homeland Security Inspector General accused of stealing govt code and trying to resell it to... the US govt",
                            "summary" => "<h4>That's one way to pad your pension pot, allegedly</h4> <p>A former acting Inspector General at the US Department of Homeland Security was today indicted for allegedly stealing internal software and data and attempting to sell it all back to his then-employer.…</p>",
                        ],
                        [
                            "id" => "tag:theregister.co.uk,2005:story207368",
                            "updated" => "2020-03-06T12:16:34Z",
                            "author" => [
                                "name" => "Richard Speed",
                                "uri" => "https://search.theregister.co.uk/?author=Richard%20Speed",
                            ],
                            "link" => [
                                "@attributes" => [
                                    "rel" => "alternate",
                                    "type" => "text/html",
                                    "href" => "https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/06/windows_10_insider_preview_19577/",
                                ],
                            ],
                            "title" => "'Optional' is the new 'Full' in Windows 10: Microsoft mucks about with diagnostic slurpage levels for Fast Ring Insiders",
                            "summary" => "<h4>That won't cause any confusion</h4> <p>Having fixed the <a target=\"_blank\" href=\"https://www.theregister.co.uk/2020/02/27/20h1_wsus/\">mystery blocking bug of last week</a>, Microsoft dropped a fresh Fast Ring build of Windows 10 and announced plans to clear the waters of the privacy pond by fiddling with the names given to diagnostic data slurpage.…</p>",
                        ],
                        [
                            "id" => "tag:theregister.co.uk,2005:story207328",
                            "updated" => "2020-03-06T10:00:09Z",
                            "author" => [
                                "name" => "Richard Speed",
                                "uri" => "https://search.theregister.co.uk/?author=Richard%20Speed",
                            ],
                            "link" => [
                                "@attributes" => [
                                    "rel" => "alternate",
                                    "type" => "text/html",
                                    "href" => "https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/06/bork_bork_bork/",
                                ],
                            ],
                            "title" => "Your opinion does matter to this Jordanian telco... only it's experiencing some technical difficulties right now",
                            "summary" => "<h4>It's the triple! Internet Explorer, McAfee and... is that Windows 8.1 flashing its privates?</h4> <p><strong>Bork!Bork!Bork!</strong>  It's been a few days and there have been a few borks. Today's entry in the hall of infamy takes us far from London's Vulture Central all the way to Amman, Jordan.…</p> <p><!--#include virtual='/data_centre/_whitepaper_textlinks_top.html' --></p>",
                        ],
                        [
                            "id" => "tag:theregister.co.uk,2005:story207342",
                            "updated" => "2020-03-05T15:30:11Z",
                            "author" => [
                                "name" => "Richard Speed",
                                "uri" => "https://search.theregister.co.uk/?author=Richard%20Speed",
                            ],
                            "link" => [
                                "@attributes" => [
                                    "rel" => "alternate",
                                    "type" => "text/html",
                                    "href" => "https://go.theregister.co.uk/feed/www.theregister.co.uk/2020/03/05/bork/",
                                ],
                            ],
                            "title" => "You'll get your money – when this bank has upgraded Windows 7... or bought extended support",
                            "summary" => "<h4>The return of the cashpoint bork as support dries up</h4> <p><strong>Bork!Bork!Bork!</strong>  ATM customers have been treated to that most special of sights, a refusal to dispense cash unless Windows 7 gets the update goodness it craves.…</p>",
                        ],
                    ],
                ],
                [
                    'the' => 13,
                    'to' => 11,
                    'of' => 8,
                    'and' => 6,
                    'it' => 6,
                    'a' => 5,
                    'that' => 4,
                    'have' => 2,
                    'this' => 2,
                    'with' => 2,
                ],
            ]
        ];
    }
}
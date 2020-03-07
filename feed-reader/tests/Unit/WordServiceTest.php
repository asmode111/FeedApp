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

    /**
     * @return void
     * @dataProvider providerExtract
     */
    public function testExtract(string $body, array $expected): void
    {
        $fetchService = $this->getMockBuilder(FetchServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $wordService = new WordService($fetchService);
        $response = $wordService->extract($body);

        $this->assertEquals($response, $expected);
    }

    public function providerExtract(): array
    {
        return [
            [
                'foo',
                [],
            ],
            [
                '<table class="wikitable sortable jquery-tablesorter">
<thead><tr>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending">Word</th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending">Parts of speech</th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending"><abbr title="Oxford English Corpus">OEC</abbr> rank</th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending"><a href="/wiki/Corpus_of_Contemporary_American_English" title="Corpus of Contemporary American English">COCA</a> rank<sup id="cite_ref-8" class="reference"><a href="#cite_note-8">[8]</a></sup></th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending"><a href="/wiki/Dolch_word_list" title="Dolch word list">Dolch level</a></th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending"><a href="/wiki/Polysemy" title="Polysemy">Polysemy</a>
</th></tr></thead><tbody>
<tr>
<td><a href="https://en.wiktionary.org/wiki/the#English" class="extiw" title="wikt:the">the</a></td>
<td><a href="/wiki/Article_(grammar)" title="Article (grammar)">Article</a></td>
<td>1</td>
<td>1</td>
<td>Pre-primer
</td>
<td>12
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/be#English" class="extiw" title="wikt:be">be</a></td>
<td><a href="/wiki/Verb" title="Verb">Verb</a></td>
<td>2</td>
<td>2</td>
<td>primer
</td>
<td>21
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/to#English" class="extiw" title="wikt:to">to</a></td>
<td><a href="/wiki/Preposition" class="mw-redirect" title="Preposition">Preposition</a></td>
<td>3</td>
<td>7, 9</td>
<td>Pre-primer
</td>
<td>17
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/of#English" class="extiw" title="wikt:of">of</a></td>
<td>Preposition</td>
<td>4</td>
<td>4</td>
<td>Grade 1
</td>
<td>12
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/and#English" class="extiw" title="wikt:and">and</a></td>
<td><a href="/wiki/Conjunction_(grammar)" title="Conjunction (grammar)">Conjunction</a></td>
<td>5</td>
<td>3</td>
<td>Pre-primer
</td>
<td>16
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/a#English" class="extiw" title="wikt:a">a</a></td>
<td>Article</td>
<td>6</td>
<td>5</td>
<td>Pre-primer
</td>
<td>20
</td></tr>
</tbody><tfoot></tfoot></table>',
                ['the', 'be', 'to', 'of', 'and', 'a'],
            ],
            [
                '<table class="wikitable sortable jquery-tablesorter">
<thead><tr>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending">Word</th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending">Parts of speech</th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending"><abbr title="Oxford English Corpus">OEC</abbr> rank</th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending"><a href="/wiki/Corpus_of_Contemporary_American_English" title="Corpus of Contemporary American English">COCA</a> rank<sup id="cite_ref-8" class="reference"><a href="#cite_note-8">[8]</a></sup></th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending"><a href="/wiki/Dolch_word_list" title="Dolch word list">Dolch level</a></th>
<th scope="col" class="headerSort" tabindex="0" role="columnheader button" title="Sort ascending"><a href="/wiki/Polysemy" title="Polysemy">Polysemy</a>
</th></tr></thead><tbody>
<tr>
<td><a href="https://en.wiktionary.org/wiki/the#English" title="wikt:the">the</a></td>
<td><a href="/wiki/Article_(grammar)" title="Article (grammar)">Article</a></td>
<td>1</td>
<td>1</td>
<td>Pre-primer
</td>
<td>12
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/be#English" title="wikt:be">be</a></td>
<td><a href="/wiki/Verb" title="Verb">Verb</a></td>
<td>2</td>
<td>2</td>
<td>primer
</td>
<td>21
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/to#English" title="wikt:to">to</a></td>
<td><a href="/wiki/Preposition" class="mw-redirect" title="Preposition">Preposition</a></td>
<td>3</td>
<td>7, 9</td>
<td>Pre-primer
</td>
<td>17
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/of#English" title="wikt:of">of</a></td>
<td>Preposition</td>
<td>4</td>
<td>4</td>
<td>Grade 1
</td>
<td>12
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/and#English" title="wikt:and">and</a></td>
<td><a href="/wiki/Conjunction_(grammar)" title="Conjunction (grammar)">Conjunction</a></td>
<td>5</td>
<td>3</td>
<td>Pre-primer
</td>
<td>16
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/a#English" title="wikt:a">a</a></td>
<td>Article</td>
<td>6</td>
<td>5</td>
<td>Pre-primer
</td>
<td>20
</td></tr>
</tbody><tfoot></tfoot></table>',
                [],
            ],
            [
                '<table class="wikitable sortable jquery-tablesorter"><tbody>
<tr>
<td><a href="https://en.wiktionary.org/wiki/the#English" class="extiw" title="wikt:the">the</a></td>
<td><a href="/wiki/Article_(grammar)" title="Article (grammar)">Article</a></td>
<td>1</td>
<td>1</td>
<td>Pre-primer
</td>
<td>12
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/be#English" class="extiw" title="wikt:be">be</a></td>
<td><a href="/wiki/Verb" title="Verb">Verb</a></td>
<td>2</td>
<td>2</td>
<td>primer
</td>
<td>21
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/to#English" class="extiw" title="wikt:to">to</a></td>
<td><a href="/wiki/Preposition" class="mw-redirect" title="Preposition">Preposition</a></td>
<td>3</td>
<td>7, 9</td>
<td>Pre-primer
</td>
<td>17
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/of#English" class="extiw" title="wikt:of">of</a></td>
<td>Preposition</td>
<td>4</td>
<td>4</td>
<td>Grade 1
</td>
<td>12
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/and#English" class="extiw" title="wikt:and">and</a></td>
<td><a href="/wiki/Conjunction_(grammar)" title="Conjunction (grammar)">Conjunction</a></td>
<td>5</td>
<td>3</td>
<td>Pre-primer
</td>
<td>16
</td></tr>
<tr>
<td><a href="https://en.wiktionary.org/wiki/a#English" class="extiw" title="wikt:a">a</a></td>
<td>Article</td>
<td>6</td>
<td>5</td>
<td>Pre-primer
</td>
<td>20
</td></tr>
</tbody><tfoot></tfoot></table>',
                ['the', 'be', 'to', 'of', 'and', 'a'],
            ],
        ];
    }
}

<?php
namespace App\Services\Builder;

class WordFrequencyBuilder
{
    /**
     * @var string
     */
    public $word = '';
    
    /**
     * @var int
     */
    public $frequency = 0;

    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function setFrequency(int $frequency): self
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function toArray()
    {
        return [
            'word' => $this->word,
            'frequency' => $this->frequency,
        ];
    }
}
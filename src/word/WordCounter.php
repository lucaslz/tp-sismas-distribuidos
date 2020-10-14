<?php

namespace app\word;

class WordCounter
{
    /**
     * Word to be counted
     *
     * @var string
     */
    private $word;

    public function __construct($word)
    {
        $this->setWord($word);
    }

    /**
     * Return total words
     *
     * @return string
     */
    public function totalWords()
    {
       return count(str_word_count($this->getWord(), 1));
    }

    public function totalCharactersInEachWord()
    {
        $arrayWords = str_word_count($this->getWord(), 1);
        $newArrayWords = [];

        foreach ($arrayWords as $value) {
            array_push(
                $newArrayWords,
                "A palavra: $value, tem " . strlen ($value) . " caracteres"
            );
        }
        return $newArrayWords;
    }

    /**
     * Get word to be counted
     *
     * @return  string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set word to be counted
     *
     * @param  string  $word  Word to be counted
     *
     * @return  self
     */
    public function setWord(string $word)
    {
        $this->word = $word;

        return $this;
    }
}
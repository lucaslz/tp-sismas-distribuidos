<?php

namespace app\word;

class WordCounter
{
    public function formatResultWordCount($resultWordCount)
    {
        $string = sprintf("
        ####################################
        #     Total de palavras: %s
        ####################################
        ", $resultWordCount);

        return $string;
    }
}
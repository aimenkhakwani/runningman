<?php
    class Hangman
    {
        private $word_to_guess;
        private $correct = array();
        private $incorrect = array();

        function __construct()
        {
            $dictionary = array("hangman", "grapefruit", "epicodus");
            $this->word_to_guess = $dictionary[rand(0, count($dictionary) - 1)];
        }

        function getGuessWord()
        {
            return $this->word_to_guess;
        }

        function save()
        {
            $_SESSION['guesses'] = $this;
        }

        function compare($guessLetter)
        {
            $letters_to_guess =  str_split($this->word_to_guess);
            foreach ($letters_to_guess as $letter) {
                if ($letter == $guessLetter) {
                    array_push($this->correct, $guessLetter)
                    return "Correct Guess";
                }
            }
            array_push($this->incorrect, $guessLetter);
            if (count($this->incorrect) == 6) {
                return "Game Over";
            }
            return "Wrong Guess";
        }
    }
?>

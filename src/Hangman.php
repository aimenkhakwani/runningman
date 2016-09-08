<?php
    class Hangman
    {
        private $word_to_guess;
        private $word_in_progress;
        private $correct = array();
        private $incorrect = array();

        function __construct()
        {
            $dictionary = array("hangman", "grapefruit", "epicodus");
            $this->word_to_guess = $dictionary[rand(0, count($dictionary) - 1)];
            $this->word_in_progress = $this->word_to_guess;
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
                    array_push($this->correct, $guessLetter);
                    $this->word_in_progress = str_replace($guessLetter, "", $this->word_in_progress);
                    if (strlen($this->word_in_progress) == 0) {
                        return "You Win! Your man just ran away." . $this->word_to_guess;
                    }
                    return "Correct Guess:  " . $guessLetter;
                }
            }
            array_push($this->incorrect, $guessLetter);
            if (count($this->incorrect) == 6) {
                return "Game Over. Run away please.";
            }
            return "Wrong Guess: " . $guessLetter;
        }
    }
?>

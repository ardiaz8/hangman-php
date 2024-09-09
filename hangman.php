<?php

// Function to clear the screen based on the operating system
function clear() {
    if (PHP_OS === "WINNT") {
        system("cls"); // For Windows
    }
    else {
        system("clear"); // For Unix/Linux/MacOS
    }
}

// List of possible words for the game
$possible_words = ["Beverage", "Prism", "Wing", "Pain", "Pilot", "Tile", "Earthquake", "Asteroid", "Rooster", "Laptop"];

// Define the maximum number of attempts
define("MAX_ATTEMPS", 6);

echo "🪢 Hangman Game! \n\n";

// Initialize the game
$choosen_word = $possible_words[ rand(0, 9) ]; // Choose a random word from the list
$choosen_word = strtolower($choosen_word); // Convert the word to lowercase
$word_length = strlen($choosen_word); // Get the length of the word
$discovered_letters = str_pad("", $word_length, "_"); // Initialize discovered letters with underscores
$attempts = 0; // Initialize the attempt counter

do {
    echo "Word with $word_length letters \n\n";
    echo $discovered_letters . "\n\n";

    // Ask the user to type a letter
    $player_letter = readline("Type a letter: ");
    $player_letter = strtolower($player_letter); // Convert the letter to lowercase

    if ( str_contains($choosen_word, $player_letter) ) {
        // Check all occurrences of this letter to replace it in the discovered word
        $offset = 0;
        while(
            ($letter_position = strpos($choosen_word, $player_letter, $offset)) !== false
        ) {
            $discovered_letters[$letter_position] = $player_letter; // Replace the underscore with the correct letter
            $offset = $letter_position + 1; // Move the position for the next search
        }
    } 
    else {
        clear(); // Clear the screen
        $attempts++; // Increment the attempt counter
        echo "Incorrect letter ❌. You have " . (MAX_ATTEMPS - $attempts) . " attempts left.";
        sleep(2); // Pause execution for 2 seconds
    }

    clear(); // Clear the screen for the next iteration

} while( $attempts < MAX_ATTEMPS && $discovered_letters != $choosen_word ); // Continue until attempts run out or the word is guessed

clear(); // Clear the screen at the end of the game

// Display the final result
if ($attempts < MAX_ATTEMPS)
    echo "Congratulations! You've guessed the word. 😃 \n\n";
else
    echo "Better luck next time! \n\n";

echo "The word is: $choosen_word\n";
echo "You discovered $discovered_letters";

echo "\n";

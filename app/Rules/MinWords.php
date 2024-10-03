<?php
    namespace App\Rules;

    use Closure;
    use Illuminate\Contracts\Validation\ValidationRule;

    class MinWords implements ValidationRule
    {
        protected $minWords;

        public function __construct($minWords = 5)
        {
            $this->minWords = $minWords;
        }

        /**
         * Run the validation rule.
         *
         * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
         */
        public function validate(string $attribute, mixed $value, Closure $fail): void
        {
            $value = trim($value); // Trim the value to remove spaces from the start and end
            $wordCount = str_word_count($value);

            if (empty($value) || $wordCount < $this->minWords) {
                $fail("The review text must be at least {$this->minWords} words.");
            }

        }

    }

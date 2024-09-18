<?php

    //in our funtion we will have to find any number pattern then check if its even using modulus.
    //we do this by splitting the username into characters. then we loop through each character looking for
// subsequent numbers. Delcaring 2 empty variables is going to store a collection of 2 values, the number pattern
// and the final username with only alphas and even numbers.
    //first we need to loop through our chracters, setting aside any numbers we come across before hitting a alphabet
    //once we hit an alphabet, we see how many numbers we have gathered. if not empty, then we begin to check if saved
    //number is even using modulus. If its even, we store the whole no in our final string.
//Then we clear the temporary stored number collection, and we begin the next iteration in the for loop.
    //funtion is not including last digits in a username.

    function filterodds($user_name){//we take the username requested from template,
        $found_no = '';  // To store any detected number pattern
        $final_username = ''; //where we will store our final username with only even numbers

        for ($i = 0; $i < strlen($user_name); $i++) {
            $char = $user_name[$i]; //so we start with the index 0 which is the first character of the username
            if (intval($char)) {//if int, then yes we add to saved nos
                $found_no .= $char;
            }
            else {//if next no is not int, then we can start checking our saved no if even
//we might have trouble in case the username ends with a digit, as we rely on a non digit being found to trigger the
                //modulus check like
                if (!empty($found_no)) {//if we gathered any numbers, we check its modulus
                    if ($found_no % 2 == 0) { //is it even
                        $final_username .= $found_no; //here we store the number if it is even
                    }//i dont need else statement as we will ignore if its odd and not save the char anywhere
                    $found_no = ''; //we clear the stored number pattern to begin the next iteration step
                }
                $final_username .= $char; //if we didnt find any number, then we store the character we were checking and continue loop
            }
        }//loop ended
        //found a workaround where if the username ends with a digit and theres no alpha to trigger the modulus check,
//        then we paste the modulus check once more
        if ($found_no) { //if theres still any digit saved after we have checked all chars, we re-run the mod
            if ($found_no % 2 == 0) {
                $final_username .= $found_no;//so now if username ends with an even no its added here
            }
        }
//        dd($final_username);
        return $final_username;

    }
?>

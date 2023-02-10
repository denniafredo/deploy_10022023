<?php

/* 
 * Ini adalah halaman helper untuk email.
 * 
 * Create by : Fendy Christianto
 */

function mask_email($email) {
    return preg_replace('/(?<=.).(?=.*?@)|(?<=@.).*(?=\.com)/u', '*', $email);
}
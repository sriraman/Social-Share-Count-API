# Social Share Count API

This Social share PHP function will help you to get the share count of the particular page in just a single line code.

# How to use?

1. Include `shareCount.function.php`

2. Call `shareCount(url, sitename)`


# Example

    <?php

    require 'shareCount.function.php';

    echo shareCount('http://github.com/','facebook'); 
    echo shareCount('http://github.com/','twitter'); 
    echo shareCount('http://github.com/','googleplus'); 
    echo shareCount('http://github.com/','linkedin'); 
    echo shareCount('http://github.com/','pinterest'); 
    echo shareCount('http://github.com/','stumbleupon'); 

    ?>

# Supported Sites

* Facebook
* Twitter
* Google Plus
* LinkedIn
* Pinterest
* StumbleUpon



<?php
function lastModifiedAt($postContent)
{
    //get the local time of the current post in seconds
    $local_timestamp = get_the_time('U');

    //get the time when the post was last modified
    $lastModifiedTime = get_the_modified_time('U');

    if ($lastModifiedTime >= $local_timestamp + 86400) {
        $modifiedDate = get_the_modified_time('F jS, Y');
        $modifiedTime = get_the_modified_time('h:i a');
        $updatedInfo = '<p class="last-updated">Last modified on ' . $modifiedDate . ' at ' . $modifiedTime . '</p>';
    }

    $updatedPostContent = $updatedInfo . $postContent;
    return $updatedPostContent;
}
add_filter('the_content', 'lastModifiedAt');

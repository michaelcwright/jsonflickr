flickr API - JumpStart Project
==============================

This API retrieves an object from the server and paginates the results.
The overall UI design was coded from scratch with some bootstrap for pagination.

Guide
======
1.index.php contains the form

2.search2.php process the form (clean up tags, executes cURL)

3.retrieves object and apply json_decode() so we can play with it in PHP

4.includes objectP.php and arrange array to our liking

5.back on search2.php to process pagination based on per page request


Next update:
===========
Moving the search bar to the top so results are centered

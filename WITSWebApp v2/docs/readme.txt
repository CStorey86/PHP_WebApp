Hosted url: https://homepages.shu.ac.uk/~b7035879/WITSWebApp%20v2/index.php

****************************************************************************************************
Admin Credentials
    username:   admin@admin.com 
    password:   adminOverlord

Standard Test User 1
    username:   test@test.com 
    password:   horseBatteryStaple

****************************************************************************************************
Frameworks/libraries used:
    - bootstrap: "css/bootstrap/bootstrap-grid.min.css"
        Only used "container" class as starting point for pages.
    - viewport: "js/viewport.js
        part of bootstrap download - not linked in any document
    - jquery: "js/jquery-3.4.1.min.js
    - myJquery.js:
	2 Short self coded functions to improve options in the create new event form.


*****************************************************************************************************

Notes for further development:

    Possibility for recurrance:
        given the following:
            - type (e..g daily/weekly etc.)
            - frequency (1,2 ... etc)
            - until (set date, or number of occurences)
        code could be added to:
            1) generate list of future start dates (as an array).
            2) create a copy of the event for each of those dates in the array
        
    Options to copy exisiting event (duplicate rows)

    Could link building to room number for SHU rooms - could include link to room booking system as well.

    Downloads - started functionality to allow downloads as csv files for admins.
    
    Further Menus on Admin Panel - for other tables in database e.g. contact links

    Calendar download links for events

    Edit content of pages e.g. about page

        







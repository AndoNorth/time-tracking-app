Project Name:
  time tracking app

Description:
  an app where users can track tasks and log how much time is taken for each

functional features:
  - create containers which store:
    - name
    - time (date, hours, minutes)
    - tags (work, play, etc...)
    - using local storage to periodically store session state
  - store containers of data in database using JSON objects (using JS fetch api to send POST requests to PHP backend)
    - save/load list states in a database
  - drag and drop containers within 3 lists (using JS events)
    - doing, todo, done
  - authentication system (using PHP, using SHA256 encryption to store passwords securely)
    - sign-up, login, logout
    - using cookies to store session information

# Toontown Launcher Patcher
Server files for handling a login via the original Toontown Online launcher. The current code is up to date with all the new PHP and SQL versions.


## Prerequisites:
* Your own registration page
* PHP5.5+ & MySQL 5.5.46+
* The *Disney's Toontown Online* launcher

| Users      | LoginAttempts |
|------------|----------------|
| ID         | ID             |
| Username   | Username       |
| Password   | IP             |
| Ranking    | Location       |
| Banned     |
| TestAccess |
| Verified   |

## Instructions:
* Create a file in your Toontown Launcher directory named "parameters.txt"
* Inside of the text document, add the following line:

```
PATCHER_BASE_URL=http://yourwebsitehere.com/launcher/current
```

**WARNING:** This is designed for people who simply want to be able to reconnect to the original Toontown Online game. It also uses one way hashing, which is highly not recommended. but serves its purpose. :^).

## Credit:
Original work done by [bradonberney](https://github.com/brandonberney)

Rework and Security fixes completed by [brownzilla](http://github.com/brownzilla)

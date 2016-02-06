# Toontown Launcher Patcher
Server files for handling a login via the original Toontown Online launcher.


## Prerequisites:
* Your own registration page
* The *Disney's Toontown Online* launcher
| users      | login_attempts |
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

**WARNING:** This is designed for people who simply want to be able to reconnect to the original Toontown Online game.

## Credit:
Original work done by [bradonberney](https://github.com/brandonberney)
Rework and Security fixes completed by [brownzilla](http://github.com/brownzilla)

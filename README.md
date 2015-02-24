# stock-proxy-app
A sample proxy for 3rd party APIs.  This one hits up YQL for current stock prices

I like stocks so I chose this as an example of how to hit up a third party service.  

Also YQL has tons of interesting data that you can use, so if you study the example and look at 
[their sample console](https://developer.yahoo.com/yql/console/) you can unlock tons of app ideas (particularly looking at the community tables).  Super-powers growing...

#Setup Description
You need to install CURL for PHP so that it can make HTTP requests.
Using an Ubuntu server (like cloud9) you can do this with the command

    sudo apt-get install php5-curl

Sometimes you need to do 

    sudo apt-get update

to get the latest libraries.

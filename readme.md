[![Codacy Badge](https://www.codacy.com/project/badge/81ac7b05c8f04eedac21e369b9aa5f6d)](https://www.codacy.com/app/pboutin/metatwitch)

## MetaTwitch

Don't forget to set the permissions on `/storage` and `/bootstrap/cache`


Database
--------

Create a new database called: metatwitch

Change you .env database config

    DB_HOST=localhost
    DB_DATABASE=metatwitch
    DB_USERNAME=yourUser
    DB_PASSWORD=yourPass


Twitch Oauth Information
------------------------

Visit: http://www.twitch.tv/settings/connections


Change you .env twitch config

    TWITCH_KEY=yourTwitchOauthID
    TWITCH_SECRET=yourTwitchOauthSecret
    TWITCH_REDIRECT_URI=http://metatwitch.local.com/login
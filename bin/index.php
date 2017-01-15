<?php
/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015, 2016, 2017  Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

session_start();

// Helpers

/**
 * Redirect a request to the start of this script
 */
function redirect_to_new()
{

    header('Location: ' . $_SERVER['PHP_SELF'] . '?action=new');
    die();
}

/**
 * @return string
 */
function get_sso_callback_url()
{

    if (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        $protocol = 'https://';
    else
        $protocol = 'http://';

    return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?action=eveonlinecallback';
}

// UI Parts
/**
 * @return string
 */
function get_header()
{

    return <<<EOF
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>New ESI Refresh Token</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <style type='text/css'>.header,body{padding-bottom:20px}.header,.jumbotron{border-bottom:1px solid #e5e5e5}body{padding-top:20px}.footer,.header,.marketing{padding-right:15px;padding-left:15px}.header h3{margin-top:0;margin-bottom:0;line-height:40px}.footer{padding-top:19px;color:#777;border-top:1px solid #e5e5e5}@media (min-width:768px){.container{max-width:730px}}.container-narrow>hr{margin:30px 0}.jumbotron{text-align:center}.jumbotron .btn{padding:14px 24px;font-size:21px}.marketing{margin:40px 0}.marketing p+h4{margin-top:28px}@media screen and (min-width:768px){.footer,.header,.marketing{padding-right:0;padding-left:0}.header{margin-bottom:30px}.jumbotron{border-bottom:0}}</style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <h3 class="text-muted">ESI Refresh Token Generator</h3>
      </div>
EOF;

}

/**
 * @return string
 */
function get_footer()
{

    return <<<EOF
    </div> <!-- /container -->
  </body>
</html>
EOF;

}

// Page contents

/**
 * Fresh, new login page
 */
function new_login()
{

    $action = $_SERVER['PHP_SELF'] . '?action=submitsecrets';
    $callback = get_sso_callback_url();

    echo get_header();
    echo <<<EOF
      <div class="jumbotron">
        <p>
          Create a new Application at the EVE Online Developers Site 
          <a href="https://developers.eveonline.com/applications/create" target="_blank">here</a>.
          Use the resultant ClientID and secret in the form below.
        </p>
        <p>
        The callback url to use is: <pre>$callback</pre>
        </p>
      </div>

      <div class="row marketing">

        <form action="$action" method="post" class="form-horizontal">
        <fieldset>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="clientid">Client ID</label>
          <div class="col-md-4">
          <input id="clientid" name="clientid" type="text" placeholder="Client ID" class="form-control input-md">
          <span class="help-block">ClientID From the EVE Online Developers Site</span>
          </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="secret">Secret</label>
          <div class="col-md-4">
            <input id="secret" name="secret" type="password" placeholder="Secret" class="form-control input-md">
            <span class="help-block">Secret From the EVE Online Developers Site</span>
          </div>
        </div>
        
        <!-- Select Multiple -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="scopes">Scopes</label>
          <div class="col-md-4">
            <select id="scopes" name="scopes[]" class="form-control" multiple="multiple">
            <!-- in the tools directory, run: -->
            <!-- php get_endpoints_and_scopes.php | grep "|" | cut -d"|" -f 3 | sort | uniq | grep -v public | awk '{ print "<option value=\"" $1 "\">" $1 "</option>"}' -->
            <!-- done :D -->
            
<option value="esi-assets.read_assets.v1">esi-assets.read_assets.v1</option>
<option value="esi-bookmarks.read_character_bookmarks.v1">esi-bookmarks.read_character_bookmarks.v1</option>
<option value="esi-calendar.read_calendar_events.v1">esi-calendar.read_calendar_events.v1</option>
<option value="esi-calendar.respond_calendar_events.v1">esi-calendar.respond_calendar_events.v1</option>
<option value="esi-characters.read_contacts.v1">esi-characters.read_contacts.v1</option>
<option value="esi-characters.write_contacts.v1">esi-characters.write_contacts.v1</option>
<option value="esi-clones.read_clones.v1">esi-clones.read_clones.v1</option>
<option value="esi-corporations.read_corporation_membership.v1">esi-corporations.read_corporation_membership.v1</option>
<option value="esi-fleets.read_fleet.v1">esi-fleets.read_fleet.v1</option>
<option value="esi-fleets.write_fleet.v1">esi-fleets.write_fleet.v1</option>
<option value="esi-killmails.read_killmails.v1">esi-killmails.read_killmails.v1</option>
<option value="esi-location.read_location.v1">esi-location.read_location.v1</option>
<option value="esi-location.read_ship_type.v1">esi-location.read_ship_type.v1</option>
<option value="esi-mail.organize_mail.v1">esi-mail.organize_mail.v1</option>
<option value="esi-mail.read_mail.v1">esi-mail.read_mail.v1</option>
<option value="esi-mail.send_mail.v1">esi-mail.send_mail.v1</option>
<option value="esi-planets.manage_planets.v1">esi-planets.manage_planets.v1</option>
<option value="esi-search.search_structures.v1">esi-search.search_structures.v1</option>
<option value="esi-skills.read_skillqueue.v1">esi-skills.read_skillqueue.v1</option>
<option value="esi-skills.read_skills.v1">esi-skills.read_skills.v1</option>
<option value="esi-ui.open_window.v1">esi-ui.open_window.v1</option>
<option value="esi-ui.write_waypoint.v1">esi-ui.write_waypoint.v1</option>
<option value="esi-universe.read_structures.v1">esi-universe.read_structures.v1</option>
<option value="esi-wallet.read_character_wallet.v1">esi-wallet.read_character_wallet.v1</option>

            </select>
          </div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="login"></label>
          <div class="col-md-4">
            <button id="login" name="login" class="btn btn-primary">Generate Login</button>
          </div>
        </div>

        </fieldset>
        </form>

      </div>
EOF;
    echo get_footer();

}

/**
 * @param $url
 */
function print_sso_url($url)
{

    echo get_header();
    echo <<<EOF
      <div class="jumbotron">
        <p>
        Your SSO Url is ready. Click it <a href="$url">here</a> to login to EVE Online.
        <pre>$url</pre>
        </p>
      </div>
EOF;
    echo get_footer();

}

/**
 * @param $access_token
 * @param $refresh_token
 */
function print_tokens($access_token, $refresh_token)
{

    echo get_header();
    echo <<<EOF
      <div class="jumbotron">
        <p>
        Your current access token is: <pre>$access_token</pre> valid for ~20 minutes
        </p>
        <p>
        Your refresh token is: <pre>$refresh_token</pre> valid until you delete the app from the Developers site.
        </p>
      </div>
EOF;
    echo get_footer();
}

// Ensure we have an action!
if (! isset($_GET['action']))
    redirect_to_new();

// Worlds most caveman router!

// Decide where to go based on the value of 'action'
switch ($_GET['action']) {

    // Display the form to create a new login.
    case 'new':
        $_SESSION['test'] = 'bob';
        new_login();
        break;

    case 'submitsecrets':
        // Ensure we got some values
        if (! isset($_REQUEST['clientid']) ||
            ! isset($_REQUEST['secret']) ||
            ! isset($_REQUEST['scopes'])
        ) {

            echo 'All fields are mandatory!<br>' . PHP_EOL;
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?action=new">Start again</a>';

            die();
        }

        $_SESSION['clientid'] = $_REQUEST['clientid'];
        $_SESSION['secret'] = $_REQUEST['secret'];
        $_SESSION['state'] = uniqid();

        // Generate the url with the requested scopes
        $url = 'https://login.eveonline.com/oauth/authorize/?response_type=code&redirect_uri=' .
            urlencode(get_sso_callback_url()) . '&client_id=' .
            $_SESSION['clientid'] . '&scope=' . implode(' ', $_REQUEST['scopes']) . ' &state=' . $_SESSION['state'];

        // Print the HTML with the login button.
        print_sso_url($url);
        break;

    case 'eveonlinecallback':
        // Verify the state.
        if ($_REQUEST['state'] != $_SESSION['state']) {

            echo 'Invalid State! You will have to start again!<br>';
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?action=new">Start again</a>';
            die();
        }

        // Clear the state value.
        $_SESSION['state'] = null;

        // Prep the authentication header.
        $headers = [
            'Authorization: Basic ' . base64_encode($_SESSION['clientid'] . ':' . $_SESSION['secret']),
            'Content-Type: application/json',
        ];

        // Seems like CCP does not mind JSON in the body. Yay.
        $fields = json_encode([
            'grant_type' => 'authorization_code',
            'code'       => $_REQUEST['code'],
        ]);

        // Start a cURL session
        $ch = curl_init('https://login.eveonline.com/oauth/token');
        curl_setopt_array($ch, [
                CURLOPT_URL             => 'https://login.eveonline.com/oauth/token',
                CURLOPT_POST            => true,
                CURLOPT_POSTFIELDS      => $fields,
                CURLOPT_HTTPHEADER      => $headers,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_USERAGENT       => 'eseye/tokengenerator',
                CURLOPT_SSL_VERIFYPEER  => true,
                CURLOPT_SSL_CIPHER_LIST => 'TLSv1',
            ]
        );

        $result = curl_exec($ch);

        $data = json_decode($result);

        print_tokens($data->access_token, $data->refresh_token);
        break;

    // If we dont know what 'action' to perform, then redirect.
    default:
        redirect_to_new();
        break;
}

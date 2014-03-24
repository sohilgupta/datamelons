<?php
/**
* Simple WordPress Twitter feed
*
*
* @param string $user user of twitter feed to retrieve.
* @param string $count number of tweets to retrive.
* 
* Inspiration for code:
* Chip Bennet's oenology theme https://github.com/chipbennett/oenology 
* catswhocode http://www.catswhocode.com/blog/snippets/grab-tweets-from-twitter-feed
* 
* @return string of formatted API data
*/

function twitter_feed($user = 'twitter', $count = '3'){
    $i = 1;
    //cache request
    $transient_key = $user . "_twitter";

    // If cached (transient) data are used, output an HTML
    // comment indicating such
    $cached = get_transient( $transient_key );

    if ( false !== $cached ) {
    return $cached .= "\n" . '<!--Returned from transient cache.-->';
    }

    // Build Twitter api url
    $apiurl = "http://api.twitter.com/1/statuses/user_timeline/{$user}.json?count={$count}";

    // Request the API data, using the constructed URL
    $remote = wp_remote_get( esc_url( $apiurl ) );

    // If the API data request results in an error, return
    // an appropriate comment
    if ( is_wp_error( $remote ) ) {
        return '<p>Twitter feed unaviable</p>';
    }

    // If the API returns a server error in response, output
    // an error message indicating the server response.
    if ( '200' != $remote['response']['code'] ) {
        return '<p>Twitter feed responded with an HTTP status code of ' . esc_html( $remote['response']['code'] ) . '.</p>';
    }

    // If the API returns a valid response, the data will be
    // json-encoded; so decode it.
    $data = json_decode( $remote['body'] );
    
    $output = '';
    
    while ($i <= $count){
        //Assign feed to $feed
        if(isset($data[$i-1])){
                $feed = $data[($i-1)]->text;
                //Find location of @ in feed
                $feed = str_pad($feed, 3, ' ', STR_PAD_LEFT);   //pad feed
                $startat = stripos($feed, '@');
                $numat = substr_count($feed, '@');
                $numhash = substr_count($feed, '#');
                $numhttp = substr_count($feed, 'http');
                $feed = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $feed);
                $feed = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $feed);
                $feed = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $feed);
                $feed = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $feed);
                $output .= "<div class='tweet'>" . $feed . "<div class='tweet_date'>" . date("M - j",strtotime($data[($i-1)]->created_at)) . "</div></div>";
        }
        $i++;        
    }
    
    set_transient( $transient_key, $output, 600 );
    
    return $output;
}

//Usage
$twitusr = of_get_option('w2f_twitr','twitter');
echo twitter_feed($user= $twitusr, $count='1');
?>
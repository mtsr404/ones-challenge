<?php
/*
 *  GitHub & Bitbucket Deployment Sample Script
 *  Originally found at
 *  http://brandonsummers.name/blog/2012/02/10/using-bitbucket-for-automated-deployments/
 *
 */

/**
* The Server Path to git repository
*/
$serverpath = '/var/www/ones-challenge';

/**
* The Secret Key
*/
$secret_key = 'challenge_ones';

/*
 *    Webhook Sample
 *        For BitBucket, use 'POST HOOK'
 *        For GitHub, use 'Webhooks'
 *    URL Format
 *        https://[Basic Auth ID]:[Basic Auth Pass]@example.com/deployments.php?key=EnterYourSecretKeyHere
 *        (https access & Basic Auth makes it a bit more secure if your server supports it)
 */
/**
* The TimeZone format used for logging.
* @link    http://php.net/manual/en/timezones.php
*/

date_default_timezone_set('Asia/Tokyo');
class Deploy {
  /**
  * A callback function to call after the deploy has finished.
  * 
  * @var callback
  */
  public $post_deploy;

  /**
  * The name of the file that will be used for logging deployments. Set to 
  * FALSE to disable logging.
  * 
  * @var string
  */
  private $_log = FALSE;
  /**
  * The timestamp format used for logging.
  * 
  * @link    http://www.php.net/manual/en/function.date.php
  * @var     string
  */
  private $_date_format = 'Y-m-d H:i:sP';
  /**
  * The name of the branch to pull from.
  * 
  * @var string
  */
  private $_branch = 'develop';
  /**
  * The name of the remote to pull from.
  * 
  * @var string
  */
  private $_remote = 'origin';
  /**
  * The directory where your website and git repository are located, can be 
  * a relative or absolute path
  * 
  * @var string
  */
  private $_directory;
  /**
  * Sets up defaults.
  * 
  * @param  string  $directory  Directory where your website is located
  * @param  array   $data       Information about the deployment
  */
  public function __construct($directory, $options = array())
  {
      // Determine the directory path
      $this->_directory = realpath($directory).DIRECTORY_SEPARATOR;
      $available_options = array('log', 'date_format', 'branch', 'remote');
      foreach ($options as $option => $value)
      {
          if (in_array($option, $available_options))
          {
              $this->{'_'.$option} = $value;
          }
      }
      $this->log('Attempting deployment...');
  }
  /**
  * Writes a message to the log file.
  * 
  * @param  string  $message  The message to write
  * @param  string  $type     The type of log message (e.g. INFO, DEBUG, ERROR, etc.)
  */
  public function log($message, $type = 'INFO')
  {
      if ($this->_log)
      {
          // Set the name of the log file
          $filename = $this->_log;
          if ( ! file_exists($filename))
          {
              // Create the log file
              file_put_contents($filename, '');
              // Allow anyone to write to log files
              chmod($filename, 0666);
          }
          // Write the message into the log file
          // Format: time --- type: message
          file_put_contents($filename, date($this->_date_format).' --- '.$type.': '.$message.PHP_EOL, FILE_APPEND);
      }
  }
  /**
  * Executes the necessary commands to deploy the website.
  */
  public function execute()
  {
      try
      {
          // Make sure we're in the right directory
          chdir($this->_directory);
          $this->log('Changing working directory... ');

	  // Composer update
	  exec('php composer.phar self-update', $output);
	  exec('php composer.phar update', $output);

	  // checkout
	  exec('git checkout '.$this->_branch, $output);

	  // Discard any changes to tracked files since our last deploy
	  exec('git reset --hard HEAD', $output);
          $this->log('Reseting repository... '.implode(' ', $output));

	  // fetch
	  exec('git fetch -a', $output);

	  // Update the local repository
          exec('git reset --hard '.$this->_remote.'/'.$this->_branch, $output);
          $this->log('Pulling in changes... '.implode(' ', $output));
		  // .git は非公開ディレクトリなので必要ない
          // Secure the .git directory
          // exec('chmod -R 2775 .git');
          // $this->log('Securing .git directory... ');

		  // ec2-userでもapacheでも修正可能にする
          // Add writable for group
          exec('chmod -R g+w '. $this->_directory);

          if (is_callable($this->post_deploy))
          {
              call_user_func($this->post_deploy, $this->_data);
          }
          $this->log('Deployment successful.');
      }
      catch (Exception $e)
      {
          $this->log($e, 'ERROR');
      }
  }
}
$deploy = new Deploy($serverpath);
/*
$deploy->post_deploy = function() use ($deploy) {
  // hit the wp-admin page to update any db changes
   exec('curl http://example.com/wp-admin/upgrade.php?step=upgrade_db');
   $deploy->log('Updating wordpress database... ');
};
*/
if ($_GET[key] === $secret_key)  {
  $deploy->execute();
}
?>

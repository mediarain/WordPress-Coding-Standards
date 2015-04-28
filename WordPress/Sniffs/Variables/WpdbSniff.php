<?php
/**
 * This sniff prohibits the use of wpdb as it is generally an indication
 * that WordPress methods are not being used appropriately.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  WordPress_Coding_Standards
 * @author    Your Name <you@domain.net>
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   SVN: $Id: coding-standard-tutorial.xml,v 1.9 2008-10-09 15:16:47 cweiske Exp $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * This sniff prohibits the use of Perl style hash comments.
 *
 * An example of a hash comment is:
 *
 * <code>
 *  # This is a hash comment, which is prohibited.
 *  $hello = 'hello';
 * </code>
 *
 * @category PHP
 * @package  WordPress_Coding_Standards
 * @author    Your Name <you@domain.net>
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class WordPress_Sniffs_Variables_WpdbSniff extends WordPress_Sniff
{


    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return array(T_VARIABLE);

    }//end register()


    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int                  $stackPtr  The position in the stack where
     *                                        the token was found.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
      $this->init( $phpcsFile );
      $tokens = $phpcsFile->getTokens();
      $token  = $tokens[ $stackPtr ];

      $search = array(); // Array of globals to watch for

      if ( T_VARIABLE === $token['code'] && '$wpdb' === $token['content'] ) {
        $error = 'Use of $wpdb is prohibited; found %s';
        $data  = array(trim($tokens[$stackPtr]['content']));
        $phpcsFile->addError($error, $stackPtr, 'Found', $data);
      }

    }//end process()


}//end class

?>

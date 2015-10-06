<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package GitServiceMove\Command\BitBucket
 */
namespace GitServiceMove\Command\BitBucket;

use GitServiceMove\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Bitbucket\API\Authentication\Basic;

/**
 * Retrieve status of BitBucket connection
 * @package GitServiceMove\Command\BitBucket
 */
abstract class Base extends AbstractCommand
{
    /**
     * Authentication listener
     * @var Basic
     */
    private $auth;

    /**
     * Initialize the command before execution
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->auth = new Basic(
            getenv('BITBUCKET_USER'),
            getenv('BITBUCKET_PASS')
        );
    }

    /**
     * Retrieve auth listener
     * @return Basic
     */
    public function getAuth()
    {
        return $this->auth;
    }
}

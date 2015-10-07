<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package GitServiceMove\Command\BitBucket
 */
namespace GitServiceMove\Command\BitBucket;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Retrieve status of BitBucket connection
 * @package GitServiceMove\Command\BitBucket
 */
class StatusCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this->setDescription('Check BitBucket connection');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new \Bitbucket\API\User();
        $user->setCredentials($this->getAuth());

        // now you can access protected endpoints as $bb_user
        $response = $user->get();
        return $response->isSuccessful()?0:self::CODE_ERROR;
    }
}

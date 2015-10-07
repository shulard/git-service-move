<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package GitServiceMove\Command\BitBucket\Repository
 */
namespace GitServiceMove\Command\BitBucket\Repository;

use GitServiceMove\Command\BitBucket\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Bitbucket\API\Repositories;
use Buzz\Message\Response;

/**
 * Retrieve status of BitBucket connection
 * @package GitServiceMove\Command\BitBucket\Repository
 */
class ListCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this->setDescription('List repositories inside the connected account');

        $this->addOption(
            'limit',
            null,
            InputOption::VALUE_OPTIONAL,
            'Limit the number of repositories retrieved to avoid infinite loop',
            100
        );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repositories = new Repositories();
        $repositories->setCredentials($this->getAuth());

        // now you can access protected endpoints as $bb_user
        $response = $repositories->all();
        if( $response->isSuccessful() ) {
            $data = $this->getAllRepoListings(
                $response->getContent(),
                $repositories,
                $input
            );

            return 0;
        }
        return self::CODE_ERROR;
    }

    /**
     * Paginate repositories listing
     * @param  string         $content Response content
     * @param  Repositories   $repos   Repositories API wrapper
     * @param  InputInterface $input   Command Input
     * @return array
     */
    private function getAllRepoListings($content, Repositories $repos, InputInterface $input) {
        $list = json_decode($content);
        $currentLength = $list->pagelen*$list->page;
        if (isset($list->next) && $currentLength < $input->getOption('limit')) {
            $listMerge = $this->getAllRepoListings(
                $repos
                    ->getClient()
                    ->setApiVersion('2.0')
                    ->request($list->next)
                    ->getContent(),
                $repos,
                $input
            );

            return array_merge($listMerge, $list->values);
        }

        return $list->values;
    }
}

<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package GitServiceMove\Command\BitBucket\Repository\Issue
 */
namespace GitServiceMove\Command\BitBucket\Repository\Issue;

use GitServiceMove\Command\BitBucket\BaseCommand;
use GitServiceMove\Command\WithResultInterface;
use GitServiceMove\Command\WithResultTrait;
use GitServiceMove\Model\Collection;
use GitServiceMove\Model\Issue;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Bitbucket\API\Repositories\Issues;
use Buzz\Message\Response;

/**
 * Retrieve status of BitBucket connection
 * @package GitServiceMove\Command\BitBucket\Repository\Issue
 */
class ListCommand extends BaseCommand implements WithResultInterface
{
    use WithResultTrait;

    protected $issues;
    protected $milestones;

    protected function configure()
    {
        parent::configure();
        $this->setDescription('List issues inside the selected repo');

        $this->addOption(
            'repository',
            'r',
            InputOption::VALUE_REQUIRED,
            'Repository slug to use for extract data'
        );

        $this->addOption(
            'limit',
            null,
            InputOption::VALUE_OPTIONAL,
            'Number of issues to retrieve',
            10
        );

        $this->addOption(
            'all',
            null,
            InputOption::VALUE_NONE,
            'Flag to tell if we need to retrieve all issues'
        );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->issues = new Issues();
        $this->issues->setCredentials($this->getAuth());

        $list = $this->retrieveList(
            $input->getOption('repository'),
            new Collection,
            $input->getOption('limit'),
            $input->getOption('all')
        );
        $this->setResult($list);
    }

    private function retrieveList($repository, Collection $results, $limit, $all = false)
    {
        $response = $this->issues->all(
            getenv('BITBUCKET_ACCOUNT'),
            $repository,
            [ 'limit' => $limit, 'start' => count($results) ]
        );
        $data = json_decode($response->getContent());
        array_walk(
            $data->issues,
            function($item) use ($results) {
                $tmp = new Issue(
                    $item->local_id,
                    $item->title,
                    $item->content,
                    new \DateTime($item->utc_created_on)
                );
                $tmp->priority = $item->priority;
                $tmp->status = $item->status;
                $tmp->milestone = $item->metadata->milestone;
                $tmp->version = $item->metadata->version;
                $tmp->comment_count = $item->comment_count;

                $results->attach($tmp);
            }
        );
        if( count($results) < $limit || ($all === true && count($results) !== $data->count) ) {
            $this->retrieveList(
                $repository,
                $results,
                $limit,
                $all
            );
        }

        return $results;
    }
}

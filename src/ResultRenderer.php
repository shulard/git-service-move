<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package GitServiceMove
 */
namespace GitServiceMove;

use Symfony\Component\Console\Output\OutputInterface;
use GitServiceMove\Command\WithResultInterface;
use Symfony\Component\Console\Helper\Table;
use GitServiceMove\Model\Collection;

/**
 * This object allow to render command result
 * @package GitServiceMove
 */
class ResultRenderer
{
    /**
     * Command which handle a result
     * @var WithResultInterface
     */
    protected $command;

    public function __construct(WithResultInterface $command)
    {
        $this->command = $command;
    }

    public function render(OutputInterface $output)
    {
        $data = $this->command->getResult();
        if( $data instanceof Collection ) {
            $this->renderCollection($data, $output);
        } elseif( is_array($data) ) {
            $this->renderArray($data, $output);
        } elseif( is_bool($data) ) {
            $this->renderBool($data, $output);
        } else {
            $this->renderDefault($data, $output);
        }
    }

    protected function renderCollection(Collection $data, OutputInterface $output)
    {
        $array = [];
        foreach( $data as $model ) {
            $array[] = $model->toArray();
        }
        $this->renderArray($array, $output);
    }

    protected function renderArray(array $data, OutputInterface $output)
    {
        $table = new Table($output);
        if( count($data) > 0 ) {
            $keys = array_keys($data[0]);
            if( $keys !== range(0, count($data) - 1) ) {
                $table->setHeaders($keys);
            }
            $table->setRows($data);
        }
        $table->render();
    }

    protected function renderBool($data, OutputInterface $output)
    {
        $output->writeln($data===true?'true':'false');
    }

    protected function renderDefault($data, OutputInterface $output)
    {
        $output->writeln(var_export($data, true));
    }
}

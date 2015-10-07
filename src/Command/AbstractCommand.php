<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package GitServiceMove\Command
 */
namespace GitServiceMove\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Global command canvas
 * @package GitServiceMove\Command
 */
class AbstractCommand extends Command
{
    const CODE_ABORTED = 100;
    const CODE_ERROR = 1;
    const CODE_OK = 0;

    /**
     * Define standard and globals options for the command line
     */
    protected function configure()
    {
        //Dynamically define command name
        $baseName = explode('\\', substr(get_called_class(), strlen(__NAMESPACE__)+1));
        array_walk($baseName, function (&$v) {
            $v = strtolower(str_replace('Command', '', $v));
        });
        $this->setName(implode(':', $baseName));
    }
}

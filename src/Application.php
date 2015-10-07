<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package GitServiceMove
 */
namespace GitServiceMove;

use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Command\Command;
use GitServiceMove\Command\WithResultInterface;

/**
 * This object is the root of all process, it embed the standard launch behaviour
 * @package GitServiceMove
 */
class Application extends SymfonyApplication
{
    public function __construct()
    {
        parent::__construct(
            Version::NAME,
            Version::REVISION
        );
    }

    public function doRunCommand(Command $command, InputInterface $input, OutputInterface $output)
    {
    	$exit = parent::doRunCommand($command, $input, $output);

    	if( $command instanceof WithResultInterface ) {
    		$renderer = new ResultRenderer($command);
    		$renderer->render($output);
    	}

    	return $exit;
    }
}

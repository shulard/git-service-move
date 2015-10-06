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
}

<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package GitServiceMove\Command
 */
namespace GitServiceMove\Command;

/**
 * Command behaviour to identify commands which gave a body
 * @package GitServiceMove\Command
 */
interface WithResultInterface
{
    /**
     * Set command result
     * @param mixed $result
     */
    public function setResult($result);

    /**
     * Get command result
     * @return mixed
     */
    public function getResult();
}

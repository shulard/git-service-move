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
 * Linked to WithResultInterface
 * @package GitServiceMove\Command
 */
trait WithResultTrait
{
	/**
	 * Command result
	 * @var mixed
	 */
	private $result;

    public function setResult($result)
    {
    	$this->result = $result;
    }

    public function getResult()
    {
    	return $this->result;
    }
}

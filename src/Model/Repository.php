<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephane HULARD <s.hulard@chstudio.fr>
 * @package GitServiceMove\Model
 */
namespace GitServiceMove\Model;

/**
 * Define how to represent a repository
 * @package GitServiceMove\Model
 */
class Repository implements ModelInterface
{
	protected $name;
	protected $account;

    public function __construct($name, $account, $scm = 'git')
    {
    	$this->name = $name;
    	$this->account = $account;
    	$this->scm = $scm;
    }

    public function toArray()
    {
    	return [
    		'name' => $this->name,
    		'account' => $this->account,
    		'scm' => $this->scm
    	];
    }
}

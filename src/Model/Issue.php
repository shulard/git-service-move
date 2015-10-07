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
 * Define how to represent a issue
 * @package GitServiceMove\Model
 */
class Issue extends AbstractModel
{
    protected $id;
	protected $title;
    protected $description;
    protected $status;
    protected $priority;
    protected $milestone;
	protected $version;

    public function __construct($id, $title, $description)
    {
    	$this->id = $id;
    	$this->title = $title;
        $this->description = $description;
    }

    public function toArray()
    {
    	return [
    		'id' => $this->id,
            'title' => $this->title,
            'priority' => $this->priority,
            'status' => $this->status,
    		'milestone' => $this->milestone
    	];
    }
}

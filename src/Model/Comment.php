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
 * Define how to represent an issue comment
 * @package GitServiceMove\Model
 */
class Comment extends AbstractModel
{
    protected $issue;
    protected $content;
    protected $created;
    protected $author;

    public function __construct(Issue $issue, \DateTime $created, $content)
    {
        $this->content = $content;
        $this->created = $created;
        $this->author = $author;
    }

    public function toArray()
    {
        return [
            'content' => $this->content,
            'created' => $this->created->format('Y-m-d\TH:i:s')
        ];
    }
}

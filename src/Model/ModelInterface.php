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
 * Model canvas
 * @package GitServiceMove\Model
 */
interface ModelInterface
{
    /**
     * Transform a model to an associative array
     * @return array
     */
    public function toArray();
}

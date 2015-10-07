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
 * Define general context for collection objects
 * @package GitServiceMove\Model
 */
class Collection extends \SplObjectStorage
{
    public function attach($object, $data = null)
    {
        if( !($object instanceof ModelInterface) ) {
            throw new \RuntimeException('Collection can only contains Model');
        }

        parent::attach($object, $data);
    }
}

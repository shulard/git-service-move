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
 * Model default implementation
 * @package GitServiceMove\Model
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * Generic accessor
     * @param  string $name Property name
     * @return mixed
     */
    public function __get($name)
    {
        if( !property_exists($this, $name) ) {
            throw new \RuntimeException('Property '.$name.' does not exists !');
        }
        return $this->$name;
    }

    /**
     * Generic setter
     * @param string $name  Property name
     * @param mixed $value  New property value
     */
    public function __set($name, $value)
    {
        if( !property_exists($this, $name) ) {
            throw new \RuntimeException('Property '.$name.' does not exists !');
        }
        $this->$name = $value;

        return $this;
    }
}

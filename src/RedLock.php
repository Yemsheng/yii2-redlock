<?php

namespace msheng\RedLock;

use RedLock\RedLock as SigneRedLock;

use yii\base\Component;

class RedLock extends Component
{
    public $servers = [];

    private $_redlock;

    private function getRedlock(){
        if(!$this->_redlock){
            $this->_redlock = new SigneRedLock($this->servers);
        }
        return $this->_redlock;
    }

    public function init()
    {
        $servers = [];
        foreach ($this->servers as $server){
            $servers[] = [$server['hostname'], $server['port'], $server['timeout']];
        }
        $this->servers = $servers;
        parent::init();
    }

    /**
     * @param $resource the resource name is an unique identifier of what you are trying to lock
     * @param $ttl  the number of milliseconds for the validity time
     * @return array|bool The returned value is false if the lock was not acquired (you may try again), otherwise an array representing the lock is returned, having three keys:
     *   Array
     *   (
     *   [validity] => 9897.3020019531
     *   [resource] => my_resource_name
     *   [token] => 53771bfa1e775
     *   )
     * validity, an integer representing the number of milliseconds the lock will be valid.
     * resource, the name of the locked resource as specified by the user.
     * token, a random token value which is used to safe reclaim the lock.
     */
    public function lock($resource, $ttl){
        $redlock = $this->getRedlock();
        return $redlock->lock($resource, $ttl);
    }

    /**
     * @param array $lock. The param that "lock" function return
     */
    public function unlock(array $lock){
        $redlock = $this->getRedlock();
        return $redlock->unlock($lock);
    }
}

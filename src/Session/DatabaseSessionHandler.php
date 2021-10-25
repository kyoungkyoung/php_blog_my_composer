<?php

namespace PhpFramework\Session;
use PhpFramework\Database\Adaptor;

class DatabaseSessionHandler implements \SessionHandlerInterface{
    public function open($sabePath, $sessionName)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($id){
        $data = current(Adaptor::getAll('select * from sessions where id=?', [$id]));
        
        if($data){
            $payload = $data->payload;
        } else {
            Adaptor::exec('insert into sessions(id) values(?)', [$id]);
        }
        return $payload ?? '';
    }

    public function write($id, $payload)
    {
        return Adaptor::exec('update sessions set payload=? where id=?', [$payload, $id]);
    }

    public function destroy($id)
    {
        return Adaptor::exec('delete from sessions where id=?', [$id]);
    }

    public function gc($maxlifetime)
    {
        if($sessions = Adaptor::getAll('select * from sessions')){
            foreach($sessions as $session){
                $timestamp = strtotime($session->createdAt);
                if(time() - $timestamp > $maxlifetime){
                    $this->destroy($session->id);
                }
            }
            return true;
        }
        return false;
    }
}
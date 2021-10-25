<?php

namespace PhpFramework\Routing;

class RequestContext{
    public $method;
    public $path;
    public $handler;
    public $middlewares;

    //생성자
    public function __construct($method, $path, $handler, $middlewares){
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }

    //routing의 핵심 logic
    public function match($url){
        // $this->path => /posts , $url => /posts
        // $this->path => /posts/{id} , $url => /posts/1

        $urlParts = explode('/', $url); //url을 /기준으로 자르기
        $urlPatternParts = explode('/', $this->path);

        if(count($urlParts) === count($urlPatternParts)){
            $urlParams = [];

            foreach($urlPatternParts as $key => $part){
                if(preg_match('/^\{.*\}/', $part)){
                    $urlParams[$key] = $part;
                } else {
                    if($urlParts[$key] !== $part){
                        return null;
                    }
                }
            }
            return count($urlParams) < 1 ? [] : array_map(fn($k) => $urlParts[$k], array_keys($urlParams));
                                                                                //key값 가져와서 그 key값을 넣어준다
        }
    }

    public function runMiddlewares(){
        foreach($this->middlewares as $middleware){
            if(! $middleware::process()){
                return false;
            }
        }
        return true;
    }
}
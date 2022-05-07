<?php


class A implements I
{
    public function __construct($adapter)
    {

    }

    public function save(){
        $this->adapter->save();
    }
}


class B extends A  implements I {

    public function save()
    {
        $this->adapter->save();
    }
}

interface I {
    public function save();
}

Class App {
    public function __construct(I $ab)
    {
        $ab->save();
    }
}

$app = new App($a);

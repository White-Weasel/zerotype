<?php 
    class pa{
        protected $a=5;
    }

    class son extends pa
    {
        public function __construct()
        {
            echo $this->a;
        }
    }

    $a = new son();

?>


<form method="POST" action="/api/user.php">
    <input type="text" name="id">
    <input type="text" name="pass">

    <input type="submit" name="action" value="update">
</form>
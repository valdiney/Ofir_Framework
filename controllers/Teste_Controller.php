<?php 
class Teste_Controller extends Controller
{
    protected $user;
    protected $view;
    protected $layout_pricipal;

    public function __construct(Array $models)
    {
        $this->user = $models['User'];
        $this->view = $this->view();
    }

    public function teste()
    {
    	/*$valdiney = $this->user->select()->where('email', '=', 'valdiney.2@hotmail.com');
    	var_dump($this->user->prepare($valdiney));
    	//var_dump($valdiney);
        
        
    	$quessia = $this->user->select()->where('email', '=', 'quessiar@gmail.com');
    	var_dump($this->user->prepare($quessia));
    	//var_dump($quessia);*/


        $timestamp = '2016-04-26 15:26:47';

        $meu_formato = Date::date_time('d/m/Y H:i', $timestamp);
        # Resultado: 26/04/2016 15:26
    }
}
<?php 
class Formate{
    public function dateFormate($data){
        return date('F j, Y, g:i, a',strtotime($data));
    }
    public function textFormate($text, $length=400){
         $text = $text. " ";
         $text = substr($text, 0, $length);
         $text = substr($text, 0, strrpos($text, ' '));
         $text= $text. " ....";
         return $text;
    }
    
    public function validate($data){
        $data=trim($data);
        $data= stripcslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title= basename($path, '.php');
        if($title=='index'){
            $title="home";
        }elseif($title='contact'){
            $title="contact";
        };
        return $title=ucfirst($title);
    }
}


?>
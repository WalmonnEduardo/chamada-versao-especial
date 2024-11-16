<?php
class Texto
{
    public static function montar_tabela(array $itens_tabela)
    {
        $quantidade = count($itens_tabela);
        $maximo = ($quantidade*2)+1;
        $itens  = array();
        for($i = 0 ; $i < $quantidade ;$i++)
        {
            $itens[] = self::removerAcentos($itens_tabela[$i]);
        }
        $j = self::contagem($itens);
        $adv = ($quantidade%10)+10;
        $j += $adv;
        $t = 0;
        for($i = 0 ; $i < $maximo ; $i++)
        {
            if($i%2==0)
            {
                $barra="=";
                while(strlen($barra) < $j)
                {
                    $barra.="=";
                }
                print $barra."\n";
            }
            else
            {
                $l = "[ ".($t+1)." -> ".$itens_tabela[$t];
                $ad = 0;
                for($a = 0 ;$a < strlen($itens_tabela[$t]); $a++)
                {
                    if (substr($itens_tabela[$t], $a, 2) == 'Á' || substr($itens_tabela[$t], $a, 2) == 'Ã' || substr($itens_tabela[$t], $a, 2) == 'Â' || substr($itens_tabela[$t], $a, 2) == 'À' || substr($itens_tabela[$t], $a, 2) == 'Ä' || substr($itens_tabela[$t], $a, 2) == 'á' || substr($itens_tabela[$t], $a, 2) == 'ã' || substr($itens_tabela[$t], $a, 2) == 'â' || substr($itens_tabela[$t], $a, 2) == 'à' || substr($itens_tabela[$t], $a, 2) == 'ä' || substr($itens_tabela[$t], $a, 2) == 'É' || substr($itens_tabela[$t], $a, 2) == 'Ẽ' || substr($itens_tabela[$t], $a, 2) == 'Ê' || substr($itens_tabela[$t], $a, 2) == 'È' || substr($itens_tabela[$t], $a, 2) == 'Ë' || substr($itens_tabela[$t], $a, 2) == 'é' || substr($itens_tabela[$t], $a, 2) == 'ẽ' || substr($itens_tabela[$t], $a, 2) == 'ê' || substr($itens_tabela[$t], $a, 2) == 'è' || substr($itens_tabela[$t], $a, 2) == 'ë' || substr($itens_tabela[$t], $a, 2) == 'Í' || substr($itens_tabela[$t], $a, 2) == 'Ĩ' || substr($itens_tabela[$t], $a, 2) == 'Î' || substr($itens_tabela[$t], $a, 2) == 'Ì' || substr($itens_tabela[$t], $a, 2) == 'Ï' || substr($itens_tabela[$t], $a, 2) == 'í' || substr($itens_tabela[$t], $a, 2) == 'ĩ' || substr($itens_tabela[$t], $a, 2) == 'î' || substr($itens_tabela[$t], $a, 2) == 'ì' || substr($itens_tabela[$t], $a, 2) == 'ï' || substr($itens_tabela[$t], $a, 2) == 'Ó' || substr($itens_tabela[$t], $a, 2) == 'Õ' || substr($itens_tabela[$t], $a, 2) == 'Ô' || substr($itens_tabela[$t], $a, 2) == 'Ò' || substr($itens_tabela[$t], $a, 2) == 'Ö' || substr($itens_tabela[$t], $a, 2) == 'ó' || substr($itens_tabela[$t], $a, 2) == 'õ' || substr($itens_tabela[$t], $a, 2) == 'ô' || substr($itens_tabela[$t], $a, 2) == 'ò' || substr($itens_tabela[$t], $a, 2) == 'ö' || substr($itens_tabela[$t], $a, 2) == 'Ú' || substr($itens_tabela[$t], $a, 2) == 'Ũ' || substr($itens_tabela[$t], $a, 2) == 'Û' || substr($itens_tabela[$t], $a, 2) == 'Ù' || substr($itens_tabela[$t], $a, 2) == 'Ü' || substr($itens_tabela[$t], $a, 2) == 'ú' || substr($itens_tabela[$t], $a, 2) == 'ũ' || substr($itens_tabela[$t], $a, 2) == 'û' || substr($itens_tabela[$t], $a, 2) == 'ù' || substr($itens_tabela[$t], $a, 2) == 'ü' || substr($itens_tabela[$t], $a, 2) == 'ç' || substr($itens_tabela[$t], $a, 2) == 'ñ' || substr($itens_tabela[$t], $a, 2) == 'Ñ') 
                    {
                        $ad ++;
                    }
                }
                while(strlen($l) < $j+$ad-1)
                {
                    $l .= " ";
                }
                $l .= "]";
                print $l."\n";
                $t++;
            }
        }
    }
    public static function contagem($itens_tabela)
    {
        $j = 0;
        foreach($itens_tabela as $item)
        {
            if(strlen($item) > $j)
            {
                $j = strlen($item);
            }
        }
        return $j;
    }
    public static function removerAcentos($string)
    {
        $acentos = array(
            'Á' => 'A', 'À' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
            'É' => 'E', 'È' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'Í' => 'I', 'Ì' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ó' => 'O', 'Ò' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O',
            'Ú' => 'U', 'Ù' => 'U', 'Û' => 'U', 'Ü' => 'U',
            'Ç' => 'C', 'Ñ' => 'N',
            'á' => 'a', 'à' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
            'ó' => 'o', 'ò' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
            'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
            'ç' => 'c', 'ñ' => 'n'
        );
    
        return strtr($string, $acentos);
    }
    public static function alinhar_topicos($topicos,int $j,$preencher)
    {
        $itens[] = self::removerAcentos($topicos);
        $j += 2;
        $l = $topicos;
        $ad = 0;
        for($a = 0 ;$a < strlen($topicos); $a++)
        {
            if (substr($topicos, $a, 2) == 'Á' || substr($topicos, $a, 2) == 'Ã' || substr($topicos, $a, 2) == 'Â' || substr($topicos, $a, 2) == 'À' || substr($topicos, $a, 2) == 'Ä' || substr($topicos, $a, 2) == 'á' || substr($topicos, $a, 2) == 'ã' || substr($topicos, $a, 2) == 'â' || substr($topicos, $a, 2) == 'à' || substr($topicos, $a, 2) == 'ä' || substr($topicos, $a, 2) == 'É' || substr($topicos, $a, 2) == 'Ẽ' || substr($topicos, $a, 2) == 'Ê' || substr($topicos, $a, 2) == 'È' || substr($topicos, $a, 2) == 'Ë' || substr($topicos, $a, 2) == 'é' || substr($topicos, $a, 2) == 'ẽ' || substr($topicos, $a, 2) == 'ê' || substr($topicos, $a, 2) == 'è' || substr($topicos, $a, 2) == 'ë' || substr($topicos, $a, 2) == 'Í' || substr($topicos, $a, 2) == 'Ĩ' || substr($topicos, $a, 2) == 'Î' || substr($topicos, $a, 2) == 'Ì' || substr($topicos, $a, 2) == 'Ï' || substr($topicos, $a, 2) == 'í' || substr($topicos, $a, 2) == 'ĩ' || substr($topicos, $a, 2) == 'î' || substr($topicos, $a, 2) == 'ì' || substr($topicos, $a, 2) == 'ï' || substr($topicos, $a, 2) == 'Ó' || substr($topicos, $a, 2) == 'Õ' || substr($topicos, $a, 2) == 'Ô' || substr($topicos, $a, 2) == 'Ò' || substr($topicos, $a, 2) == 'Ö' || substr($topicos, $a, 2) == 'ó' || substr($topicos, $a, 2) == 'õ' || substr($topicos, $a, 2) == 'ô' || substr($topicos, $a, 2) == 'ò' || substr($topicos, $a, 2) == 'ö' || substr($topicos, $a, 2) == 'Ú' || substr($topicos, $a, 2) == 'Ũ' || substr($topicos, $a, 2) == 'Û' || substr($topicos, $a, 2) == 'Ù' || substr($topicos, $a, 2) == 'Ü' || substr($topicos, $a, 2) == 'ú' || substr($topicos, $a, 2) == 'ũ' || substr($topicos, $a, 2) == 'û' || substr($topicos, $a, 2) == 'ù' || substr($topicos, $a, 2) == 'ü' || substr($topicos, $a, 2) == 'ç' || substr($topicos, $a, 2) == 'ñ' || substr($topicos, $a, 2) == 'Ñ') 
            {
                $ad ++;
            }
        }
        while(strlen($l) < $j+$ad-1)
        {
            $l .= " ";
        }
        $l .= "$preencher";
        return $l;
    }
    public static function montar_tabela_programa(array $itens_tabela)
    {
        $quantidade = count($itens_tabela);
        $maximo = ($quantidade*2)+1;
        $itens  = array();
        for($i = 0 ; $i < $quantidade ;$i++)
        {
            $itens[] = self::removerAcentos($itens_tabela[$i]);
        }
        $j = self::contagem($itens);
        $adv = ($quantidade%10)+10;
        $j += $adv+9;
        $t = 0;
        for($i = 0 ; $i < $maximo ; $i++)
        {
            if($i%2==0)
            {
                $barra="print\"=";
                while(strlen($barra) < $j)
                {
                    $barra.="=";
                }
                $linhas[] = $barra."\\n\";";
            }
            else
            {
                $l = "print\"[ ".($t+1)." -> ".$itens_tabela[$t];
                $ad = 0;
                for($a = 0 ;$a < strlen($itens_tabela[$t]); $a++)
                {
                    if (substr($itens_tabela[$t], $a, 2) == 'Á' || substr($itens_tabela[$t], $a, 2) == 'Ã' || substr($itens_tabela[$t], $a, 2) == 'Â' || substr($itens_tabela[$t], $a, 2) == 'À' || substr($itens_tabela[$t], $a, 2) == 'Ä' || substr($itens_tabela[$t], $a, 2) == 'á' || substr($itens_tabela[$t], $a, 2) == 'ã' || substr($itens_tabela[$t], $a, 2) == 'â' || substr($itens_tabela[$t], $a, 2) == 'à' || substr($itens_tabela[$t], $a, 2) == 'ä' || substr($itens_tabela[$t], $a, 2) == 'É' || substr($itens_tabela[$t], $a, 2) == 'Ẽ' || substr($itens_tabela[$t], $a, 2) == 'Ê' || substr($itens_tabela[$t], $a, 2) == 'È' || substr($itens_tabela[$t], $a, 2) == 'Ë' || substr($itens_tabela[$t], $a, 2) == 'é' || substr($itens_tabela[$t], $a, 2) == 'ẽ' || substr($itens_tabela[$t], $a, 2) == 'ê' || substr($itens_tabela[$t], $a, 2) == 'è' || substr($itens_tabela[$t], $a, 2) == 'ë' || substr($itens_tabela[$t], $a, 2) == 'Í' || substr($itens_tabela[$t], $a, 2) == 'Ĩ' || substr($itens_tabela[$t], $a, 2) == 'Î' || substr($itens_tabela[$t], $a, 2) == 'Ì' || substr($itens_tabela[$t], $a, 2) == 'Ï' || substr($itens_tabela[$t], $a, 2) == 'í' || substr($itens_tabela[$t], $a, 2) == 'ĩ' || substr($itens_tabela[$t], $a, 2) == 'î' || substr($itens_tabela[$t], $a, 2) == 'ì' || substr($itens_tabela[$t], $a, 2) == 'ï' || substr($itens_tabela[$t], $a, 2) == 'Ó' || substr($itens_tabela[$t], $a, 2) == 'Õ' || substr($itens_tabela[$t], $a, 2) == 'Ô' || substr($itens_tabela[$t], $a, 2) == 'Ò' || substr($itens_tabela[$t], $a, 2) == 'Ö' || substr($itens_tabela[$t], $a, 2) == 'ó' || substr($itens_tabela[$t], $a, 2) == 'õ' || substr($itens_tabela[$t], $a, 2) == 'ô' || substr($itens_tabela[$t], $a, 2) == 'ò' || substr($itens_tabela[$t], $a, 2) == 'ö' || substr($itens_tabela[$t], $a, 2) == 'Ú' || substr($itens_tabela[$t], $a, 2) == 'Ũ' || substr($itens_tabela[$t], $a, 2) == 'Û' || substr($itens_tabela[$t], $a, 2) == 'Ù' || substr($itens_tabela[$t], $a, 2) == 'Ü' || substr($itens_tabela[$t], $a, 2) == 'ú' || substr($itens_tabela[$t], $a, 2) == 'ũ' || substr($itens_tabela[$t], $a, 2) == 'û' || substr($itens_tabela[$t], $a, 2) == 'ù' || substr($itens_tabela[$t], $a, 2) == 'ü' || substr($itens_tabela[$t], $a, 2) == 'ç' || substr($itens_tabela[$t], $a, 2) == 'ñ' || substr($itens_tabela[$t], $a, 2) == 'Ñ') 
                    {
                        $ad ++;
                    }
                }
                while(strlen($l) < $j+$ad-1)
                {
                    $l .= " ";
                }
                $l .= "]\\n\";";
                $linhas[] = $l;
                $t++;
            }
        }
        return $linhas;
    }
    public static function alinhar_topicos_arquivo($topicos,int $j)
    {
        $itens[] = self::removerAcentos($topicos);
        $j += 2;
        $l = $topicos;
        $ad = 0;
        for($a = 0 ;$a < strlen($topicos); $a++)
        {
            if (substr($topicos, $a, 2) == 'Á' || substr($topicos, $a, 2) == 'Ã' || substr($topicos, $a, 2) == 'Â' || substr($topicos, $a, 2) == 'À' || substr($topicos, $a, 2) == 'Ä' || substr($topicos, $a, 2) == 'á' || substr($topicos, $a, 2) == 'ã' || substr($topicos, $a, 2) == 'â' || substr($topicos, $a, 2) == 'à' || substr($topicos, $a, 2) == 'ä' || substr($topicos, $a, 2) == 'É' || substr($topicos, $a, 2) == 'Ẽ' || substr($topicos, $a, 2) == 'Ê' || substr($topicos, $a, 2) == 'È' || substr($topicos, $a, 2) == 'Ë' || substr($topicos, $a, 2) == 'é' || substr($topicos, $a, 2) == 'ẽ' || substr($topicos, $a, 2) == 'ê' || substr($topicos, $a, 2) == 'è' || substr($topicos, $a, 2) == 'ë' || substr($topicos, $a, 2) == 'Í' || substr($topicos, $a, 2) == 'Ĩ' || substr($topicos, $a, 2) == 'Î' || substr($topicos, $a, 2) == 'Ì' || substr($topicos, $a, 2) == 'Ï' || substr($topicos, $a, 2) == 'í' || substr($topicos, $a, 2) == 'ĩ' || substr($topicos, $a, 2) == 'î' || substr($topicos, $a, 2) == 'ì' || substr($topicos, $a, 2) == 'ï' || substr($topicos, $a, 2) == 'Ó' || substr($topicos, $a, 2) == 'Õ' || substr($topicos, $a, 2) == 'Ô' || substr($topicos, $a, 2) == 'Ò' || substr($topicos, $a, 2) == 'Ö' || substr($topicos, $a, 2) == 'ó' || substr($topicos, $a, 2) == 'õ' || substr($topicos, $a, 2) == 'ô' || substr($topicos, $a, 2) == 'ò' || substr($topicos, $a, 2) == 'ö' || substr($topicos, $a, 2) == 'Ú' || substr($topicos, $a, 2) == 'Ũ' || substr($topicos, $a, 2) == 'Û' || substr($topicos, $a, 2) == 'Ù' || substr($topicos, $a, 2) == 'Ü' || substr($topicos, $a, 2) == 'ú' || substr($topicos, $a, 2) == 'ũ' || substr($topicos, $a, 2) == 'û' || substr($topicos, $a, 2) == 'ù' || substr($topicos, $a, 2) == 'ü' || substr($topicos, $a, 2) == 'ç' || substr($topicos, $a, 2) == 'ñ' || substr($topicos, $a, 2) == 'Ñ') 
            {
                $ad ++;
            }
        }
        while(strlen($l) < $j+$ad-1)
        {
            $l .= " ";
        }
        $l .= ":";
        return $l;
    }
    public static function alinhar_topicos_tras($topicos,int $j,$preencher)
    {
        $itens[] = self::removerAcentos($topicos);
        $j += 2;
        $l = " ";
        $ad = 0;
        for($a = 0 ;$a < strlen($topicos); $a++)
        {
            if (substr($topicos, $a, 2) == 'Á' || substr($topicos, $a, 2) == 'Ã' || substr($topicos, $a, 2) == 'Â' || substr($topicos, $a, 2) == 'À' || substr($topicos, $a, 2) == 'Ä' || substr($topicos, $a, 2) == 'á' || substr($topicos, $a, 2) == 'ã' || substr($topicos, $a, 2) == 'â' || substr($topicos, $a, 2) == 'à' || substr($topicos, $a, 2) == 'ä' || substr($topicos, $a, 2) == 'É' || substr($topicos, $a, 2) == 'Ẽ' || substr($topicos, $a, 2) == 'Ê' || substr($topicos, $a, 2) == 'È' || substr($topicos, $a, 2) == 'Ë' || substr($topicos, $a, 2) == 'é' || substr($topicos, $a, 2) == 'ẽ' || substr($topicos, $a, 2) == 'ê' || substr($topicos, $a, 2) == 'è' || substr($topicos, $a, 2) == 'ë' || substr($topicos, $a, 2) == 'Í' || substr($topicos, $a, 2) == 'Ĩ' || substr($topicos, $a, 2) == 'Î' || substr($topicos, $a, 2) == 'Ì' || substr($topicos, $a, 2) == 'Ï' || substr($topicos, $a, 2) == 'í' || substr($topicos, $a, 2) == 'ĩ' || substr($topicos, $a, 2) == 'î' || substr($topicos, $a, 2) == 'ì' || substr($topicos, $a, 2) == 'ï' || substr($topicos, $a, 2) == 'Ó' || substr($topicos, $a, 2) == 'Õ' || substr($topicos, $a, 2) == 'Ô' || substr($topicos, $a, 2) == 'Ò' || substr($topicos, $a, 2) == 'Ö' || substr($topicos, $a, 2) == 'ó' || substr($topicos, $a, 2) == 'õ' || substr($topicos, $a, 2) == 'ô' || substr($topicos, $a, 2) == 'ò' || substr($topicos, $a, 2) == 'ö' || substr($topicos, $a, 2) == 'Ú' || substr($topicos, $a, 2) == 'Ũ' || substr($topicos, $a, 2) == 'Û' || substr($topicos, $a, 2) == 'Ù' || substr($topicos, $a, 2) == 'Ü' || substr($topicos, $a, 2) == 'ú' || substr($topicos, $a, 2) == 'ũ' || substr($topicos, $a, 2) == 'û' || substr($topicos, $a, 2) == 'ù' || substr($topicos, $a, 2) == 'ü' || substr($topicos, $a, 2) == 'ç' || substr($topicos, $a, 2) == 'ñ' || substr($topicos, $a, 2) == 'Ñ') 
            {
                $ad ++;
            }
        }
        while((strlen($l)+strlen($topicos)-1) < $j+$ad-1)
        {
            $l .= " ";
        }
        $l .= "$topicos $preencher";
        return $l;
    }
    public static function espacoTab(array $itens)
    {
        $add = 0;
        foreach($itens as $item)
        {
            if(substr($item,(strlen($item)-1),1) == "{")
            {
                $nadl[] = $add;
                $add++;
            }
            else if(substr($item,(strlen($item)-1),1) == "}")
            {
                $add--;
                $nadl[] = $add;
            }
            else
            {
                $nadl[] = $add;
            }
        }
        $novo = array();
        for($i = 0 ;$i < count($itens) ; $i++)
        {
            if($nadl[$i] != 0)
            {
                for($j = 0 ; $j < $nadl[$i] ;$j++)
                {
                    if($j == 0)
                    {
                        $novo[$i] = "\t";
                    }
                    else
                    {
                        $novo[$i] .= "\t";
                    }
                }
                $novo[$i] .= $itens[$i];
            }
            else
            {
                $novo[$i] = $itens[$i];
            }
        }
        return $novo;
    }
    public static function escreva_devagar(string $mensagem)
    {
        $tamanho = strlen($mensagem);
        for($i = 0 ; $i < $tamanho ; $i++)
        {
            print substr($mensagem,$i,1);
            switch(substr($mensagem,$i,1))
            {
                case '.': usleep(600000) ;break;
                case '?': usleep(600000) ;break;
                case '!': usleep(600000) ;break;
                case ',': usleep(600000) ;break;
                case ';': usleep(700000) ;break;
                default: usleep(40000) ;break;
            }
        }
    }
}
?>

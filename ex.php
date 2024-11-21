<?php
require_once("model/Turma.php");
require_once("model/Professor.php");
require_once("model/Aluno.php");
require_once("model/Texto.php");
function menu()
{
    global $turmas;
    system("clear");
    $itens = array("Cadastrar turma","Abrir turma","Fazer chamada turma","Abrir chamada de turma","Marcar atendimento com coordenador","Editar turma","Excluir turma","Finalizar");
    Texto::montar_tabela($itens);
    $escolha = readline("Escolha: ");
    switch($escolha)
    {
        case 1:
            cadastrar_turma();
            menu();
        break;
        case 2:
            abrir();
        break;
        case 3:
            chamada();
            break;
        case 4:
            mostrar_chamada();
        break;
        case 5:
            atendimento();
            menu();
        break;
        case 6:
            editar();
        break;
        case 7:
            excluir_turma();
        break;
        case 8:
            system("clear");
            if (!file_exists(__DIR__.'/data')) {
                mkdir(__DIR__.'/data', 0777, true);
            }
            $turmas = json_encode($turmas,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents(__DIR__."/data/turmas.json",$turmas);
            die;
        break;
        default:
            menu();
        break;
            
                        
    }   
}
function cadastrar_turma()
{
    system("clear");
    global $turmas;
    $i = readline("Quantidade de alunos da turma: ");
    if(is_numeric($i))
    {
        intval($i);
        if($i > 0)
        {
            $alunos = array();
            for($j = 0 ; $j < $i ;$j++)
            {
                system("clear");
                $nome = readline("Nome do aluno ".($j+1).": ");
                $num = readline("Número de matricula do aluno ".($j+1).": ");
                if($nome != "" && $num != "" && is_numeric($num))
                {
                    $aluno = new Aluno();
                    $aluno->setNome($nome);
                    $aluno->setNumMatricula($num);
                    $alunos[] = $aluno;
                }
                else
                {
                    system("clear");
                    print "Aluno ".($j+1)." não atendeu aos requisitos então não foi adicionado!\n\nAperte enter para voltar!";
                    readline("");
                }
            }
            if(count($alunos) > 0)
            {
                do
                {
                    system("clear");
                    $nomep = readline("Nome do professor responsável pela turma: ");
                    $gmailp = readline("Email do professor responsável pela turma: ");
                    $siape = readline("Siape do professor responsável pela turma: ");
                    $disciplina = readline("Disciplina do professor responsável pela turma: ");
                }while($nomep == "" || $gmailp == "" || $siape == "");
                $professor = new Professor();
                $professor->setNome($nomep);
                $professor->setGmail($gmailp);
                $professor->setSiape($siape);
                $professor->setDisciplina($disciplina);
                do
                {
                    system("clear");
                    $nomet = readline("Nome da turma: ");
                }while($nomet ==  "");
                sort($alunos);
                $turma = new Turma();
                $turma->setNome($nomet);
                $turma->setAlunos($alunos);
                $turma->setResponsavel($professor);
                $turmas[] = $turma;
            }
            else
            {
                system("clear");
                print "Não se pode criar uma turma sem alunos!\n\nAperte enter para voltar!\n";
                readline("");
            }
        }
    }
}
function abrir()
{
    global $turmas;
    system("clear");
    if($turmas == null)
    {
        print "Não há turmas!\n\nAperte enter para voltar!";
        readline("");
        menu();
    }
    $itens = array();
    print "| Abrir turma selecionada |\n";
    for($i = 0 ; $i < count($turmas);$i++)
    {
        $itens[] = $turmas[$i]->getNome(); 
    }
    $itens[] = "Finalizar";
    Texto::montar_tabela($itens);
    $esc = readline("Escolha: ");
    if(is_numeric($esc))
    {
        if($esc > 0 && $esc <= count($turmas))
        {
            system("clear");
            print $turmas[$esc-1];
            readline("Aperte enter para voltar!");
            abrir();
        }
        else if($esc == count($turmas)+1)
        {
            menu();
        }
        else
        {
            abrir();
        }
    }
    else
    {
        abrir();
    }
}
function chamada()
{
    global $turmas;
    system("clear");
    if($turmas == null)
    {
        print "Não há turmas!\n\nAperte enter para voltar!";
        readline("");
        menu();
    }
    print "| Fazer chamada turma selecionada |\n";
    $itens = array();
    $voltar = array();
    for($i = 0 ; $i < count($turmas);$i++)
    {
        $itens[] = $turmas[$i]->getNome(); 
    }
    $itens[] = "Finalizar";
    Texto::montar_tabela($itens);
    $esc = readline("Escolha: ");
    if(is_numeric($esc))
    {
        if($esc > 0 && $esc <= count($turmas))
        {
            $esc--;
            system("clear");
            $alunoso = $turmas[$esc]->getAlunos();
            for($i = 0 ; $i < count($alunoso);$i++)
            {
                $nomes[] = $alunoso[$i]->getNome();
            }
            for($i = 0 ;$i < count($nomes);$i++)
            {
                system('clear');
                $presenca[$i] = readline($nomes[$i].":");
                if($presenca[$i] != "s" && $presenca[$i] != "f")
                {
                    $voltar[] = $i;
                }
            }
            if(count($voltar) != 0)
            {
                $rep = count($voltar);
                do
                {
                    for($i = 0 ; $i < count($nomes) ;$i++)
                    {
                        if($presenca[$i] != "s" && $presenca[$i] != "f")
                        {
                            system('clear');
                            $presenca[$i] = readline($nomes[$i].": ");
                            if($presenca[$i] == "s" || $presenca[$i] == "f")
                            {
                                unset($voltar[$i]);
                                $rep--;
                            } 
                        }
                    }
                }while($rep > 0);
            }
            $data = date('d-m-Y');
            for($i = 0 ;$i < count($nomes);$i++)
            {
                if($presenca[$i] == "s")
                {
                    $alunos = $turmas[$esc]->getAlunos();
                    $aluno = $alunos[$i];
                    $presencaso = $aluno->getPresenca(); 
                    $presencaso[$data] = "presente";
                    $aluno->setPresenca($presencaso);
                    $alunos[$i] = $aluno;
                    $turmas[$esc]->setAlunos($alunos);
                }
                else
                {
                    $alunos = $turmas[$esc]->getAlunos();
                    $aluno = $alunos[$i];
                    $presencaso = $aluno->getPresenca(); 
                    $presencaso[$data] = "faltou";
                    $aluno->setPresenca($presencaso);
                    $alunos[$i] = $aluno;
                    $turmas[$esc]->setAlunos($alunos);
                }
                $datas = $turmas[$esc]->getDiasChamada();
                if(count($datas) == 0)
                {
                    $datas[] = $data;
                }
                else
                {
                    $add = true;
                    for($j = 0 ;$j < count($datas); $j++)
                    {
                        if($datas[$j] == $data)
                        {
                            $add = false;
                            break;
                        }
                    }
                    if($add)
                    {
                        $datas[] = $data;
                    }
                }
                $turmas[$esc]->setDiasChamada($datas);
            }
            chamada();
        }
        else if($esc == count($turmas)+1)
        {
            menu();
        }
        else
        {
            chamada();
        }
    }
    else
    {
        chamada();
    }
}
function mostrar_chamada()
{
    global $turmas;
    system("clear");
    if($turmas == null)
    {
        print "Não há turmas!\n\nAperte enter para voltar!";
        readline("");
        menu();
    }
    print "| Mostrar chamada |\n\n";
    $itens = array();
    for($i = 0 ; $i < count($turmas);$i++)
    {
        $itens[] = $turmas[$i]->getNome(); 
    }
    $itens[] = "Finalizar";
    Texto::montar_tabela($itens);
    $esc = readline("Escolha: ");
    if(is_numeric($esc))
    {
        if($esc > 0 && $esc <= count($turmas))
        {
            system("clear");
            $esc--;
            $dias = $turmas[$esc]->getDiasChamada();
            if(count($dias) == 0)
            {
                print "Essa turma não chamada alunos!\n\n";
                readline("Aperte enter para voltar!");
                mostrar_chamada();
            }
            $dias[] = "Finalizar";
            print "| Dias que foram feitos a chamada da turma: ".$turmas[$esc]->getNome()." |\n";
            Texto::montar_tabela($dias);
            $escolha = readline("Escolha: ");
            if(is_numeric($escolha))
            {
                if($escolha > 0 && $escolha <= count($dias))
                {
                    $alunos = $turmas[$esc]->getAlunos();
                    if(count($alunos) == 0)
                    {
                        print "Essa turma não possui alunos!\n\n";
                        readline("Aperte enter para voltar!");
                        mostrar_chamada();
                    }
                    $dia = $dias[$escolha-1];
                    $nomes = array();
                    $presenca = array();
                    $presencas = array();
                    for($i = 0 ; $i < count($alunos) ;$i++)
                    {
                        $nomes[] = $alunos[$i]->getNome();
                        $presencas[] = $alunos[$i]->getPresenca();
                        $presenca[] = $presencas[$i][$dia];
                    }
                    $m = Texto::contagem($nomes);
                    system("clear");
                    print "| Chamada da turma: ".$turmas[$esc]->getNome()." | Dia: ".$dia." |\n\n";
                    print "Nome : Presença\n\n";
                    for($i = 0 ; $i < count($nomes);$i++)
                    {
                        print Texto::alinhar_topicos($nomes[$i],$m,": ").$presenca[$i]."\n";
                    }
                    print "\n";
                    readline("Aperte enter para voltar!");
                    mostrar_chamada();
                }
            }
            else
            {
                mostrar_chamada();
            }   
        }
        else if($esc == count($turmas)+1)
        {
            menu();
        }
        else
        {
            mostrar_chamada();
        }
    }
    else
    {
        abrir();
    }
}
function editar()
{
    global $turmas;
    system("clear");
    if($turmas == null)
    {
        print "Não há turmas!\n\nAperte enter para voltar!";
        readline("");
        menu();
    }
    print "| Selecionar turma para editar |\n";
    $itens = array();
    for($i = 0 ; $i < count($turmas);$i++)
    {
        $itens[] = $turmas[$i]->getNome(); 
    }
    $itens[] = "Finalizar";
    Texto::montar_tabela($itens);
    $esc = readline("Escolha: ");
    if(is_numeric($esc))
    {
        if($esc > 0 && $esc <= count($turmas))
        {
            $esc--;
            escolha_editar($esc);
            editar();
        }    
        else if($esc == count($turmas)+1)
        {
            menu();
        }
        else
        {
            editar();
        }
    }
    else
    {
        editar();
    }   
}
function escolha_editar(int $posicao_turmas)
{
    global $turmas;
    system("clear");
    print "| Edição da turma: |\n".$turmas[$posicao_turmas];
    $itens = array("Editar nome de aluno","Adicionar aluno","Remover aluno","Finalizar");
    Texto::montar_tabela($itens);
    $esc = readline("Escolha: ");
    switch($esc)
    {
        case 1:
            $alunos = $turmas[$posicao_turmas]->getAlunos();
            $nomes = array();
            for($i = 0 ; $i < count($alunos);$i++)
            {
                $nomes[] = $alunos[$i]->getNome();
            }
            system("clear");
            Texto::montar_tabela($nomes);
            $esc2 = readline("Escolha uma posição para editar o nome: ");
            if(is_numeric($esc2))
            {
                if($esc2 > 0 && $esc2 <= count($nomes))
                {
                    $esc2--;
                    $nome = readline("Novo nome para ".$nomes[$esc2].":");
                    if($nome != "")
                    {
                        $nomes[$esc2] = $nome;
                        for($i = 0 ; $i < count($alunos);$i++)
                        {
                            $alunos[$i]->setNome($nomes[$i]);
                            $turmas[$posicao_turmas]->setAlunos($alunos);
                            escolha_editar($posicao_turmas);
                        }
                    }
                    escolha_editar($posicao_turmas);
                }    
                else
                {
                    escolha_editar($posicao_turmas);
                }
            }
            else if($esc == count($nomes)+1)
            {
                editar();
            }
            else
            {
                escolha_editar($posicao_turmas);
            }
        break;
        case 2:
            system("clear");
            $alunos = $turmas[$posicao_turmas]->getAlunos();
            $nome = readline("Nome do aluno: ");
            $num = readline("Número de matricula do aluno: ");
            if($nome != "" && $num != "" && is_numeric($num))
            {
                $aluno = new Aluno();
                $aluno->setNome($nome);
                $aluno->setNumMatricula($num);
                $datas = $turmas[$posicao_turmas]->getDiasChamada();
                if($datas != null)
                {
                    $presencas = array();
                    for($i = 0 ; $i < count($datas); $i++)
                    {
                        $presencas[$datas[$i]] = "faltou(Não pertencia a turma)";
                    }
                    $aluno->setPresenca($presencas);
                }
                $alunos[] = $aluno;
                sort($alunos);
            }
            $turmas[$posicao_turmas]->setAlunos($alunos);
            escolha_editar($posicao_turmas);
        break;
        case 3:
            $alunos = $turmas[$posicao_turmas]->getAlunos();
            if(count($alunos) == 1)
            {
                system("clear");
                print "Não pode excluir pois só há um aluno na turma e não pode haver turma sem alunos!\n\nAperte enter para voltar!";
                readline("");
                escolha_editar($posicao_turmas);
            }
            $nomes = array();
            for($i = 0 ; $i < count($alunos);$i++)
            {
                $nomes[] = $alunos[$i]->getNome();
            }
            system("clear");
            Texto::montar_tabela($nomes);
            $esc2 = readline("Escolha uma posição para excluir: ");
            if(is_numeric($esc2))
            {
                if($esc2 > 0 && $esc2 <= count($nomes))
                {
                    $esc2--;
                    unset($alunos[$esc2]);
                    $alunos = array_values($alunos);
                    $turmas[$posicao_turmas]->setAlunos($alunos);
                    escolha_editar($posicao_turmas);
                }    
                else
                {
                    escolha_editar($posicao_turmas);
                }       
            }
            else
            {
                escolha_editar($posicao_turmas);
            }
        break;
        case 4:
            editar();
        break;
        default:
            escolha_editar($posicao_turmas);
        break;
    }
}
function excluir_turma()
{
    global $turmas;
    system("clear");
    if($turmas == null)
    {
        print "Não há turmas!\n\nAperte enter para voltar!";
        readline("");
        menu();
    }
    $itens = array();
    print "| Excluir turma selecionada |\n";
    for($i = 0 ; $i < count($turmas);$i++)
    {
        $itens[] = $turmas[$i]->getNome(); 
    }
    $itens[] = "Finalizar";
    Texto::montar_tabela($itens);
    $esc = readline("Escolha: ");
    if(is_numeric($esc))
    {
        if($esc > 0 && $esc <= count($turmas))
        {
            system("clear");
            $esc--;
            unset($turmas[$esc]);
            $turmas = array_values($turmas);
            menu();
        }    
        else if($esc == count($turmas)+1)
        {
            menu();
        }
        else
        {
            excluir_turma();
        }
    }
    else
    {
        excluir_turma();
    }   
}
function atendimento()
{
    global $turmas;
    system("clear");
    if($turmas == null)
    {
        print "Não há turmas!\n\nAperte enter para voltar!";
        readline("");
        menu();
    }
    print "| Adimento da turma |\n";
    $itens = array();
    for($i = 0 ; $i < count($turmas);$i++)
    {
        $itens[] = $turmas[$i]->getNome(); 
    }
    $itens[] = "Finalizar";
    Texto::montar_tabela($itens);
    $esc = readline("Escolha: ");
    if(is_numeric($esc))
    {
        if($esc > 0 && $esc <= count($turmas))
        {
            system("clear");
            $esc--;
            print $turmas[$esc]->getResponsavel()->getHorarioAtendimento();
            readline("");
            atendimento();
        }    
        else if($esc == count($turmas)+1)
        {
            menu();
        }
        else
        {
            atendimento();
        }   
    }
    else
    {
        atendimento();
    }
}
$pegarturmas = json_decode(file_get_contents(__DIR__."/data/turmas.json"),true);
if($pegarturmas == null)
{
    $tumas = array();
}
else
{
    $turmas = array();
    for($i = 0 ; $i < count($pegarturmas);$i++)
    {
        $alunos = $pegarturmas[$i]["alunos"];
        $responsavel = $pegarturmas[$i]["responsavel"];
        $alunos = Aluno::criarAlunos($alunos);
        $responsavel = Professor::criarProfessor($responsavel);
        $turmas[$i] = new Turma();
        $turmas[$i]->setNome($pegarturmas[$i]["nome"]);
        $turmas[$i]->setAlunos($alunos);
        $turmas[$i]->setResponsavel($responsavel);
        $turmas[$i]->setDiasChamada($pegarturmas[$i]["diasChamada"]);
    }
}
menu();
?>

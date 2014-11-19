<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of compras
 *
 * @author marcio
 */
class Carrinho extends Controller
{
    
    function checkout()
    {
  
       if (isset($_COOKIE['livros'])){
         $livros = unserialize($_COOKIE['livros']);
      }
       
       require 'application/views/_templates/header.php';
       require 'application/views/carrinho/checkout.php';
       require 'application/views/_templates/footer.php';   
    }
    
    /**
     * Excluir item que está no array no coockie de livros
     * @param int $id_livro 
     */
    public function excluirIntem($id_livro)
    { 
        if (filter_var($id_livro, FILTER_VALIDATE_INT)){
            if (isset($_COOKIE['livros'])){
                $livros = unserialize($_COOKIE['livros']);
                
                unset($livros[$id_livro]);//matando item do array que está no coockie
                //serializando array par apoder salvar no coockie
                 
                if (empty($livros)){
                    setcookie("livros", '', time()+3600, '/');
                    $this->setflash('Item excluído com sucesso', array('class' => 'alert alert-success'));
                    header('location: ' . URL . 'carrinho/checkout');
                    exit;
                }else{
                    $livros = serialize($livros);
                    setcookie("livros", $livros, time()+3600, '/');
                    $this->setflash('Ìtem excluído com sucesso!', array('class' => 'alert alert-success'));
                    header('location: ' . URL . 'carrinho/checkout');
                    exit;
                }
            }
        }

        header('location: ' . URL . 'carrinho/checkout');
        exit;
    }
    /**
     * Excluir item que está no array no coockie de livros
     * @param int $id_livro 
     */
    public function adicionarIntem($id_livro = null, $nome_livro = null, $preco_livro = null, $tipo = null)
    { 
       $livros_view = null;
       if (!empty ($id_livro) && filter_var($id_livro, FILTER_VALIDATE_INT)
               && !empty ($nome_livro) && !empty ($preco_livro) && !empty($tipo)
          )
       {
           if (isset($_COOKIE['livros'])){
             $livros = unserialize($_COOKIE['livros']);
             $id_livro = (int)$id_livro;
             $livros[$id_livro] = array('nome_livro' => $nome_livro, 'preco_livro' => $preco_livro, 'operacao' => $tipo);           
             $livros_view = $livros;
             $livros = serialize($livros);
             setcookie("livros", $livros, time()+3600, '/');           
          }else{
              $livros[$id_livro] = array('nome_livro' => $nome_livro, 'preco_livro' => $preco_livro, 'operacao' => $tipo);
              $livros_view = $livros;
              $livros = serialize($livros);
              setcookie("livros", $livros, time()+3600, '/'); 
          }
          
          $this->setflash('Item Adicionado com sucesso', array('class' => 'alert alert-success'));
          header('location: ' . URL . 'carrinho/checkout');
          return;
       }
          $this->setflash('Erro ao adicionar ítem', array('class' => 'alert alert-error'));
          header('location: ' . URL . 'carrinho/checkout');
          return;
    }
    
}
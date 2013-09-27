<?php

namespace JVPagSeguro\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

use JVPagSeguro\Service\Retorno,
    JVKart\Service\KartProduct;

class IndexController extends AbstractActionController
{
	protected $redirectError = '/carrinho';
	
	public function indexAction()
	{

	}

	public function retornoAction()
	{
		$request = $this->getRequest();
		$retorno = new Retorno();
		
		if ($request->isPost())
		{
			$post = $request->getPost()->toArray();
			$result = $retorno->varifica($post);
			
			$status = $result['status'];
			$jsonResult = \json_encode($result);
			
			// teste de recebimento do retorno
			
			
			// Seta as variaveis de retorno
			$confirm = (boolean) $result['confirm'];
			$post = $result['post'];
			$produtos = $result['produtos'];
			
			if($confirm) {
			    
			    $transacaoID = isset($post['TransacaoID']) ? $post['TransacaoID'] : '';
			    if($transacaoID=="") { exit; }
			    
			    // O post foi validado pelo PagSeguro.
			    $Referencia             = $post['Referencia']; if($Referencia=="") { $Referencia=1; }
			    $TipoPagamento          = $post['TipoPagamento'];
			    $StatusTransacao        = $post['StatusTransacao'];
			    $DataTransacao          = $post['DataTransacao'];
			    
			    /*
			    * Sintaxe mktime:
			    * mktime(horas, minutos, segundos, mes, dia, ano);
			    */
			    $DataTransacao          = date('Y-m-d H:i:s', mktime ( substr($DataTransacao,11,2), substr($DataTransacao,14,2), substr($DataTransacao,17,2), substr($DataTransacao,3,2), substr($DataTransacao,0,2), substr($DataTransacao,6,4) ));
			    
			    $CliNome                = $post['CliNome'];
			    $CliEmail               = $post['CliEmail'];
			    $CliTelefone            = $post['CliTelefone'];
			    $Anotacao               = $post['Anotacao']; if($Anotacao=="") { $Anotacao="Sem anotação"; }
			    
			    $CliEndereco            = $post['CliEndereco'];
			    $CliNumero              = $post['CliNumero'];
			    $CliComplemento         = $post['CliComplemento'];
			    $CliBairro              = $post['CliBairro'];
			    $CliCidade              = $post['CliCidade'];
			    $CliEstado              = $post['CliEstado'];
			    $CliCEP                 = $post['CliCEP'];
			    
			    $NumItens               = $post['NumItens'];
			    $Parcelas               = $post['Parcelas'];
			    
			    $Referencia             = $data['Referencia'];
			    
			    // lista dos produtos comprados para ativá-los e trocar o status de venda do pedido item
			    $listaProduto = '';
			    foreach ($produtos as $produto) {
			        $listaProduto .= "Produto {$produto['ProdID']} - {$produto['ProdDescricao']} <br />";
			    }

				// Seta estado de Financeiro OK.
				// Libera o acesso ao produto ou serviço.
				// Faz o redirect para a página de sucesso.
				$produtoService = $this->getServiceLocator()->get('admin_mapper_produtos');
				$produtoService->insert(array(
				    'status_retorno_pagseguro'=> json_encode($post), 
				    'dados_retorno_pagseguro' => $jsonResult,
				    'jsonprodutos_retorno_pagseguro' => $listaProduto
				), 'tbl_retorno_pagseguro');
				
				$this->flashMessenger()->addMessage(array('success' => 'Pagamento confirmado com sucesso'));
				return true;
			} else {
				$retorno = 'Houve um erro na confirmação dos dados, dados inválidos';
				throw new \Exception($retorno);
			}
			
			return new ViewModel();
		}
		
		exit;
	}
	
	public function pagarAction()
	{
		$serviceAuth = $this->getServiceLocator()->get('jvuser_service_auth');
		
		if (!$serviceAuth->hasIdentity()) {
			$this->flashMessenger()->addMessage(array('error' => 'Para efetuar o pagamento você precisa estar logado no site'));
			return $this->redirect()->toUrl($this->redirectError);
		}
		
		$serviceUsuario = $this->getServiceLocator()->get('jvuser_service_usuarios');
		
		$idUsuario = $serviceAuth->UserId();
		$endereco = $serviceUsuario->getEndereco(array('fk_usuario' => $idUsuario));
		$usuario = $serviceAuth->UserAuthentication();
		
		$kart = new KartProduct('kart');
		
		$itens = $kart->getItemsArray();
		
		$indice = 1;
		foreach ($itens as $item) {
			$produtos[$indice] = array(
				"itemId{$indice}" => $item->getId(),
				"itemDescription{$indice}" => $item->getDescription(),
				"itemAmount{$indice}" => number_format($item->getPrice(), 2, '.', ''),
				"itemQuantity{$indice}" => $item->getQuantity(),
				"itemWeight{$indice}" => $item->getWeight(),
			);
			
			$indice++;
		}
		
		return new ViewModel(array(
			'itens' => $produtos,
			'endereco' => $endereco,
			'usuario' => $usuario
		));
	}
	
	public function exemploRetornoAction()
	{
		
	}
}
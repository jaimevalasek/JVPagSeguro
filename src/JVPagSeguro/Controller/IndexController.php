<?php

namespace JVPagSeguro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use JVKart\Service\KartProduct;
use JVPagSeguro\Service\Retorno;

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
			
			// Seta as variaveis de retorno
			$confirm = (boolean) $result['confirm'];
			$post = $result['post'];
			$produtos = $result['produtos'];
			
			if($confirm) {
				echo "<pre>";
				exit(print_r($produtos));
				echo "</pre>";
				$this->flashMessenger()->addMessage(array('success' => 'Pagamento confirmado com sucesso'));

				// Seta estado de Financeiro OK.
				// Libera o acesso ao produto ou serviço.
				// Faz o redirect para a página de sucesso.
				
				return true;
			} else {
				$retorno = 'Houve um erro na confirmação dos dados, dados inválidos';
				throw new \Exception($retorno);
			}
			
			return new ViewModel();
		}
	}
	
	public function pagarAction()
	{
		$serviceAuth = $this->getServiceLocator()->get('user_service_auth');
		
		if (!$serviceAuth->hasIdentity()) {
			$this->flashMessenger()->addMessage(array('error' => 'Para efetuar o pagamento você precisa estar logado no site'));
			return $this->redirect()->toUrl($this->redirectError);
		}
		
		$serviceUsuario = $this->getServiceLocator()->get('user_service_usuarios');
		
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
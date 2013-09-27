<?php

namespace JVPagSeguro\Service;

use Zend\Http\Client\Adapter\Curl,
    Zend\Http\Request,
    Zend\Http\Client;

class Retorno
{
	protected $token = 'C83A6D7F719D4BCB83A0D5B5637ADBDA';
	protected $_retPagSeguroErrNo;
	protected $_retPagSeguroErrStr;
	
	public function varifica(array $post)
	{
		// prepara o post para confirmar
		$rpost = $this->prepare($post);

		// Request
		$request = new Request();
		//$request->setUri('http://localhost:9090/pagseguro-ws/checkout/NPI.jhtml');
		$request->setUri('https://pagseguro.uol.com.br/pagseguro-ws/checkout/NPI.jhtml');
		$request->setMethod('POST');
		
		$header = new \Zend\Http\Header\ContentType();
		$header->value = 'text/html; charset=iso-8859-1';
		$request->getHeaders()->addHeader($header);
		
		// Adapter Curl
		$adapter = new Curl();
		$adapter->setOptions(array(
			'curloptions' => array(
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => $rpost,
			    //CURLOPT_PROXYUSERPWD => 'usuario:senha',
			    //CURLOPT_PROXY => 'ip:port',
			    //CURLOPT_PORT => '3128',
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_HEADER => FALSE,
				CURLOPT_SSL_VERIFYPEER => FALSE,
				CURLOPT_SSL_VERIFYHOST => FALSE,
			)
		));
		
		// Client
		$client = new Client();
		$client->setAdapter($adapter);
		
		// Result
		$response = $client->dispatch($request);
		
		// Dados retornados
		$dados = $response->getMetadata();
		
		// String do resultado
		$confirmResult = $response->getContent();
			
		// Verifica se foi veio o status VERIFICADO caso sim seta boolean true
		$confirm = (strcmp($response->getContent(), 'VERIFICADO') == 0);
		
		if ($confirm)
		{
			$itens = array (
				'VendedorEmail', 'TransacaoID', 'Referencia', 'TipoFrete',
				'ValorFrete', 'Anotacao', 'DataTransacao', 'TipoPagamento',
				'StatusTransacao', 'CliNome', 'CliEmail', 'CliEndereco',
				'CliNumero', 'CliComplemento', 'CliBairro', 'CliCidade',
				'CliEstado', 'CliCEP', 'CliTelefone', 'NumItens',
			);
			
			foreach ($itens as $item)
			{
				if (!isset($post[$item])) {
					$post[$item] = '';
				}
				
				if ($item == 'ValorFrete') {
					$post[$item] = str_replace(',', '.', $post[$item]);
				}
				
				$produtos = array();
				
				for ($i=1; isset($post["ProdID_{$i}"]); $i++) {
					$produtos[] = array (
						'ProdID'          => $post["ProdID_{$i}"],
						'ProdDescricao'   => $post["ProdDescricao_{$i}"],
						'ProdValor'       => (double) (str_replace(',', '.', $post["ProdValor_{$i}"])),
						'ProdQuantidade'  => $post["ProdQuantidade_{$i}"],
						'ProdFrete'       => (double) (str_replace(',', '.', $post["ProdFrete_{$i}"])),
						'ProdExtras'      => (double) (str_replace(',', '.', $post["ProdExtras_{$i}"])),
					);
				}
			}
			
			return array('confirm' => $confirm, 'post' => $post, 'produtos' => $produtos);
		}
		
		return array('status' => $confirmResult, 'confirm' => $confirm, 'post' => $post, 'produtos' => array());
	}
	
	public function prepare(array $post, $confirm = true)
	{
		if ($confirm) {
			$post['Comando'] = 'validar';
			$post['Token'] = $this->token;
		}
		
		$retorno = array();
		foreach ($post as $key => $value) {
			if (gettype($value) !== 'string') {
				$post[$key] = '';
			}
			
			$value = urlencode(stripslashes($value));
			$retorno[] = "{$key}={$value}";
		}
		
		//return implode('&', $retorno);
		return $post;
	}
}
<?php

namespace JVPagSeguro\Model;

class Retorno
{
	protected $CliNome;
	protected $CliEmail;
	protected $CliTelefone;
	protected $Anotacao;
	
	protected $CliEndereco;
	protected $CliNumero;
	protected $CliComplemento;
	protected $CliBairro;
	protected $CliCidade;
	protected $CliEstado;
	protected $CliCep;
	
	protected $Parcelas;
	protected $NumItens;
	
	/**
	 * Irá retornar um array de produtos
	 * 
	 * @return array
	 * @var $produtos
	 */
	protected $Produtos;

	public function getCliNome()
	{
	    return $this->CliNome;
	}

	public function setCliNome($CliNome)
	{
	    $this->CliNome = $CliNome;
	}

	public function getCliEmail()
	{
	    return $this->CliEmail;
	}

	public function setCliEmail($CliEmail)
	{
	    $this->CliEmail = $CliEmail;
	}

	public function getCliTelefone()
	{
	    return $this->CliTelefone;
	}

	public function setCliTelefone($CliTelefone)
	{
	    $this->CliTelefone = $CliTelefone;
	}

	public function getAnotacao()
	{
	    return $this->Anotacao;
	}

	public function setAnotacao($Anotacao)
	{
	    $this->Anotacao = $Anotacao;
	}

	public function getCliEndereco()
	{
	    return $this->CliEndereco;
	}

	public function setCliEndereco($CliEndereco)
	{
	    $this->CliEndereco = $CliEndereco;
	}

	public function getCliNumero()
	{
	    return $this->CliNumero;
	}

	public function setCliNumero($CliNumero)
	{
	    $this->CliNumero = $CliNumero;
	}

	public function getCliComplemento()
	{
	    return $this->CliComplemento;
	}

	public function setCliComplemento($CliComplemento)
	{
	    $this->CliComplemento = $CliComplemento;
	}

	public function getCliBairro()
	{
	    return $this->CliBairro;
	}

	public function setCliBairro($CliBairro)
	{
	    $this->CliBairro = $CliBairro;
	}

	public function getCliCidade()
	{
	    return $this->CliCidade;
	}

	public function setCliCidade($CliCidade)
	{
	    $this->CliCidade = $CliCidade;
	}

	public function getCliEstado()
	{
	    return $this->CliEstado;
	}

	public function setCliEstado($CliEstado)
	{
	    $this->CliEstado = $CliEstado;
	}

	public function getCliCep()
	{
	    return $this->CliCep;
	}

	public function setCliCep($CliCep)
	{
	    $this->CliCep = $CliCep;
	}

	public function getParcelas()
	{
	    return $this->Parcelas;
	}

	public function setParcelas($Parcelas)
	{
	    $this->Parcelas = $Parcelas;
	}

	public function getNumItens()
	{
	    return $this->NumItens;
	}

	public function setNumItens($NumItens)
	{
	    $this->NumItens = $NumItens;
	}

	public function getProdutos()
	{
	    return $this->Produtos;
	}

	/**
	 * @param array $Produtos
	 * @return array
	 */
	public function setProdutos(array $Produtos)
	{
	    $this->Produtos = $Produtos;
	}
}
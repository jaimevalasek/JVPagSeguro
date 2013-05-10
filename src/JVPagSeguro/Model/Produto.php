<?php

namespace JVPagSeguro\Model;

class Produto
{
	protected $ProdID;
	protected $ProdDescricao;
	protected $ProdValor;
	protected $ProdQuantidade;
	protected $ProdPeso;

	public function getProdID()
	{
	    return $this->ProdID;
	}

	public function setProdID($ProdID)
	{
	    $this->ProdID = $ProdID;
	}

	public function getProdDescricao()
	{
	    return $this->ProdDescricao;
	}

	public function setProdDescricao($ProdDescricao)
	{
	    $this->ProdDescricao = $ProdDescricao;
	}

	public function getProdValor()
	{
	    return $this->ProdValor;
	}

	public function setProdValor($ProdValor)
	{
	    $this->ProdValor = $ProdValor;
	}

	public function getProdQuantidade()
	{
	    return $this->ProdQuantidade;
	}

	public function setProdQuantidade($ProdQuantidade)
	{
	    $this->ProdQuantidade = $ProdQuantidade;
	}

	public function getProdPeso()
	{
	    return $this->ProdPeso;
	}

	public function setProdPeso($ProdPeso)
	{
	    $this->ProdPeso = $ProdPeso;
	}
}
<?php
namespace Acme\FacturacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fb_factura")
 */
class Factura
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $rfc_e;        

	 /**
     * @ORM\Column(type="string", length=20)
     */
    protected $rfc_r;    
	
	/**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_emision;     
    
	/**
     * @ORM\Column(type="string", length=10)
     */
    protected $serie;  

	/**
     * @ORM\Column(type="integer", length=11)
     */
    protected $folio; 	
	
	/**
     * @ORM\Column(type="decimal", length=18, scale=4)
     */
    protected $total_antes_dimpuestos;
	
	/**
     * @ORM\Column(type="decimal", length=18, scale=4)
     */
    protected $i_traladados;
	
	/**
     * @ORM\Column(type="decimal", length=18, scale=4)
     */
    protected $i_retenidos;
	
	/**
     * @ORM\Column(type="decimal", length=18, scale=4)
     */
    protected $total;
	
	

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
	
	public function setId($id)
    {
        $this->id=$id;
    }

    /**
     * Set rfc_e
     *
     * @param string $rfcE
     */
    public function setRfcE($rfcE)
    {
        $this->rfc_e = $rfcE;
    }

    /**
     * Get rfc_e
     *
     * @return string 
     */
    public function getRfcE()
    {
        return $this->rfc_e;
    }

    /**
     * Set fecha_emision
     *
     * @param string $fechaEmision
     */
    public function setFechaEmision($fechaEmision)
    {
        $this->fecha_emision = $fechaEmision;
    }

    /**
     * Get fecha_emision
     *
     * @return string 
     */
    public function getFechaEmision()
    {
        return $this->fecha_emision;
    }

    /**
     * Set serie
     *
     * @param string $serie
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set folio
     *
     * @param integer $folio
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;
    }

    /**
     * Get folio
     *
     * @return integer 
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Set total_antes_dimpuestos
     *
     * @param decimal $totalAntesDimpuestos
     */
    public function setTotalAntesDimpuestos($totalAntesDimpuestos)
    {
        $this->total_antes_dimpuestos = $totalAntesDimpuestos;
    }

    /**
     * Get total_antes_dimpuestos
     *
     * @return decimal 
     */
    public function getTotalAntesDimpuestos()
    {
        return $this->total_antes_dimpuestos;
    }

    /**
     * Set i_traladados
     *
     * @param decimal $iTraladados
     */
    public function setITraladados($iTraladados)
    {
        $this->i_traladados = $iTraladados;
    }

    /**
     * Get i_traladados
     *
     * @return decimal 
     */
    public function getITraladados()
    {
        return $this->i_traladados;
    }

    /**
     * Set i_retenidos
     *
     * @param decimal $iRetenidos
     */
    public function setIRetenidos($iRetenidos)
    {
        $this->i_retenidos = $iRetenidos;
    }

    /**
     * Get i_retenidos
     *
     * @return decimal 
     */
    public function getIRetenidos()
    {
        return $this->i_retenidos;
    }

    /**
     * Set total
     *
     * @param decimal $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return decimal 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set rfc_r
     *
     * @param string $rfcR
     */
    public function setRfcR($rfcR)
    {
        $this->rfc_r = $rfcR;
    }

    /**
     * Get rfc_r
     *
     * @return string 
     */
    public function getRfcR()
    {
        return $this->rfc_r;
    }
}